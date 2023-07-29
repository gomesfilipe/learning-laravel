<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
  public function index(Season $season) {
    // dd($season->series);
    return view('episodes.index', [
      'episodes' => $season->episodes,
      'series' => $season->series,
      'season' => $season,
      'mensagemSucesso' => session('mensagem.sucesso'),
    ]);
  }

  public function update(Request $request, Season $season) {
    $watchedEpisodes = $request->episodes;

    $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
      $episode->watched = in_array($episode->id, $watchedEpisodes);
    });

    $season->push();

    return to_route('episodes.index', $season->id)->with('mensagem.sucesso', 'Episódios marcados como assistidos!');
  }
}
