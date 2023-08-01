<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\UpdateSeriesFormRequest;
use App\Models\Series;

interface SeriesRepository
{
  public function add(SeriesFormRequest $request): Series;

  public function getAll();

  public function delete(Series $series);

  public function update(Series $series, UpdateSeriesFormRequest $request);
}
