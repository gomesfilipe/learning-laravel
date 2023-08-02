<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(int $series) {
        $seriesModel = Series::find($series);
        
        if($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $seriesModel->episodes;
    }

    public function patch(int $episode, Request $request) {
        $episodeModel = Episode::find($episode);
        
        if($episodeModel === null) {
            return response()->json(['message' => 'Episode not found'], 404);
        }
        
        $episodeModel->watched = $request->watched;
        $episodeModel->save();

        return $episodeModel;
    }
}
