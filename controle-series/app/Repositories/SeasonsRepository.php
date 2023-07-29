<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

interface SeasonsRepository
{
  public function getAll(Series $series);
}
