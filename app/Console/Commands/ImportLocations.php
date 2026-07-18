<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\State;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:import-locations')]
#[Description('Command description')]
class ImportLocations extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countriesWithStates = Http::timeout(30)
            ->retry(3, 500)
            ->get('https://countriesnow.space/api/v0.1/countries/states')
            ->throw()
            ->json('data', []);

        $stateRows = [];

        foreach ($countriesWithStates as $country) {
            $countryModel = Country::updateOrCreate(
                ['iso2' => strtoupper($country['iso2'])],
                [
                    'name' => $country['name'],
                    'iso3' => isset($country['iso3'])
                        ? strtoupper($country['iso3'])
                        : null,
                ],
            );

            foreach ($country['states'] ?? [] as $stateData) {
                $name = trim($stateData['name']);

                if ($name === '') {
                    continue;
                }

                $key = $countryModel->id . ':' . mb_strtolower($name);

                $stateRows[$key] = [
                    'country_id' => $countryModel->id,
                    'name' => $name,
                    'code' => $stateData['state_code'] ?? null,
                ];
            }
        }

       $stateRows = array_values($stateRows);

        foreach (array_chunk($stateRows, 1000) as $chunk) {
            State::query()->upsert(
                $chunk,
                ['country_id', 'name'],
                ['code', 'updated_at'],
            );
        }

        $this->info(count($countriesWithStates) . ' countries imported.');

        return self::SUCCESS;
    }
};
