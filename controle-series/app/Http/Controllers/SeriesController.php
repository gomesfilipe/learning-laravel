<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller {
    public function index() {
        // $series = DB::select('SELECT nome FROM series;'); // Escrevendo SQL
        // $series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();
    
        return view('series.index', compact('series'));
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $nomeSerie = $request->input('nome');

        // DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]); // Escrevendo SQL

        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        return redirect('/series');
    }
}
