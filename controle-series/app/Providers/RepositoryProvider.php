<?php

namespace App\Providers;

use App\Repositories\EloquentSeasonsRepository;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeasonsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        // Linkando interface a uma instância específica de SeriesRepository
        SeriesRepository::class => EloquentSeriesRepository::class,
        SeasonsRepository::class => EloquentSeasonsRepository::class,
    ];
}
