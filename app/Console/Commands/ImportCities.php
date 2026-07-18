<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\State;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:import-cities')]
#[Description('Command description')]
class ImportCities extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $states = State::with('country')->whereRelation('country', 'iso2', '=', 'UA')->get();

        $prepareCitites = [];

        foreach ($states as $state) {
            $cities = Http::timeout(30)
                ->retry(3, 500)
                ->post('https://countriesnow.space/api/v0.1/countries/cities', [
                    "country" => $state->country->name,
                    "state" => $state->name
                ])
                ->throw()
                ->json('data', []);


            foreach ($cities as $city) {
                $prepareCitites[$state->name . ":" . $city]  =  ['name' => $city, 'state_id' => $state->id];
            }
        }


        collect($prepareCitites)->chunk(500)->each(function ($chunk) {
            City::insert($chunk->toArray());
        });

        $this->info(' Cities imported.');

        return self::SUCCESS;
    }
}
