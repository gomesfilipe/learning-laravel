<?php

namespace App\Repositories;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\UpdateSeriesFormRequest;

class EloquentSeriesRepository implements SeriesRepository
{
  public function add(SeriesFormRequest $request): Series {
    return DB::transaction(function () use ($request, &$serie) {
      // $nomeSerie = $request->nome;

      // DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]); // Escrevendo SQL

      // $serie = new Serie();
      // $serie->nome = $nomeSerie;
      // $serie->save();

      // $serie = Series::create($request->all());
      
      $atributes = ['nome' => $request->nome];

      if($request->coverPath) {
        $atributes['cover'] = $request->coverPath;
      }
      
      $serie = Series::create($atributes);

      // $serie = Series::create([
      //   'nome' => $request->nome,
      //   'cover' => $request->coverPath,
      // ]);
      // $request->session()->flash('mensagem.sucesso', "Série '$serie->nome' adicionada com sucesso!");
      
      $seasons = [];
      for($i = 1; $i <= $request->seasonsQty; $i++) {
          $seasons[] = [
              'series_id' => $serie->id,
              'number' => $i,
          ];

      }
      
      Season::insert($seasons);
      
      $episodes = [];
      foreach($serie->seasons as $season) {
          for($j = 1; $j <= $request->episodesPerSeason; $j++) {
              $episodes[] = [
                  'season_id' => $season->id,
                  'number' => $j,
              ];
          }
      }
      
      Episode::insert($episodes);
      return $serie;
    }, 5); // 5 tentativas para deadlock
  }

  public function getAll() {
    return DB::transaction(function () {
        return Series::all();
    }, 5);
  }

  public function delete(Series $series) {
    return DB::transaction(function () use ($series){
        return $series->delete();
    }, 5);
  }

  public function update(Series $series, UpdateSeriesFormRequest $request) {
    return DB::transaction(function () use ($series, $request) {
        $series->fill($request->all());
        return $series->save();
    }, 5);
  }
}
