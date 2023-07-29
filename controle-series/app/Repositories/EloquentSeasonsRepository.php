<?php

namespace App\Repositories;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class EloquentSeasonsRepository implements SeasonsRepository
{  
  public function getAll(Series $series) {
    return DB::transaction(function () use ($series) {
        return $series->seasons()->with('episodes')->get();;
    }, 5);
  }
}
