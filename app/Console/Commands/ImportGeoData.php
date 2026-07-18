<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:import-geo-data')]
#[Description('Command description')]
class ImportGeoData extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Importing countries & states...');
        $this->call('app:import-locations');

        $this->info('Importing cities...');
        $this->call('app:import-cities');
    }
}
