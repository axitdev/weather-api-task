<?php

namespace App\Console\Commands\Cities;

use App\Jobs\Cities\CreateNewCityTask;
use Illuminate\Console\Command;

class CreateNewCityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:new {cities*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new cities and get there lan and lon from external API Data Provider';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $citiesNames = array_unique(
            $this->argument('cities')
        );

        foreach ($citiesNames as $cityName)
        {
            CreateNewCityTask::dispatch($cityName);
        }

        return 0;
    }
}
