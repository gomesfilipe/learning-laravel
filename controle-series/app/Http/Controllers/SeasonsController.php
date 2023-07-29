<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Repositories\SeasonsRepository;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function __construct(private SeasonsRepository $repository) {

    }
    
    public function index(Series $series) {
        // $seasons = $series->seasons()->with('episodes')->get();
        $seasons = $this->repository->getAll($series);
        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);
    }
}
