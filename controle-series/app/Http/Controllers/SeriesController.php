<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Events\SeriesDeleted;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\UpdateSeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller {
    public function __construct(private SeriesRepository $repository) {
        $this->middleware(Autenticador::class)->except('index');
    }
    
    public function index(Request $request) {
        // $series = DB::select('SELECT nome FROM series;'); // Escrevendo SQL
        // $series = Series::all();
        $series = $this->repository->getAll();
        // $series = Series::query()->orderBy('nome')->get();
        // $series = Series::with(['seasons'])->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('series.index', compact('series', 'mensagemSucesso'));
    }

    public function create() {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {
        if($request->file('cover')) {
            $coverPath = $request->file('cover')->store('series_cover', 'public');
            $request->coverPath = $coverPath;
        }
        
        // dd($request->file('cover'));
        // dd($request->coverPath);
        $serie = $this->repository->add($request);
        
        EventsSeriesCreated::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

        return to_route('series.index')->with('mensagem.sucesso', "Série '$serie->nome' adicionada com sucesso!");
    }

    public function destroy(Series $series) {
        // Passando $series como parâmetro, o laravel já identifica
        // a id passada no path e faz o select no banco.

        // Series::destroy($request->series);
        // $series->delete();
        $this->repository->delete($series);
        // $request->session()->flash('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");
        SeriesDeleted::dispatch(
            $series->id,
            $series->cover,
        );

        return to_route('series.index')->with('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");
    }

    public function update(Series $series, UpdateSeriesFormRequest $request) {
        $this->repository->update($series, $request);

        return to_route('series.index')->with('mensagem.sucesso', "Série '$series->nome' atualizada com sucesso!");
    }

    public function edit(Series $series) {
        return view('series.edit', compact('series'));
    }
}
