<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(int $series) {
        $seriesModel = Series::find($series);
        
        if($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }
        
        return $seriesModel->seasons;
    }
}
