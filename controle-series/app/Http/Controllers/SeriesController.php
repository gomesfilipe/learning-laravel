<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller {
    public function index(Request $request) {
        // $series = DB::select('SELECT nome FROM series;'); // Escrevendo SQL
        $series = Series::all();
        // $series = Series::query()->orderBy('nome')->get();
        // $series = Series::with(['seasons'])->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');


        return view('series.index', compact('series', 'mensagemSucesso'));
    }

    public function create() {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {
        // $nomeSerie = $request->nome;

        // DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]); // Escrevendo SQL

        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();

        $serie = Series::create($request->all());
        // $request->session()->flash('mensagem.sucesso', "Série '$serie->nome' adicionada com sucesso!");
        
        $seasons = [];
        for($i = 1; $i <= $request->seasonQty; $i++) {
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

        return to_route('series.index')->with('mensagem.sucesso', "Série '$serie->nome' adicionada com sucesso!");
    }

    public function destroy(Series $series) {
        // Passando $series como parâmetro, o laravel já identifica
        // a id passada no path e faz o select no banco.

        // Series::destroy($request->series);
        $series->delete();
        // $request->session()->flash('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");


        return to_route('series.index')->with('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");
    }

    public function update(Series $series, SeriesFormRequest $request) {
        // $series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '$series->nome' atualizada com sucesso!");
    }

    public function edit(Series $series) {
        return view('series.edit', compact('series'));
    }
}
