<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\UpdateSeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
  public function __construct(private SeriesRepository $repository) {
    // $this->middleware(Autenticador::class)->except('index');
  }
  public function index(Request $request) {
    $query = Series::query();

    if($request->has('nome')) {
      $query->where('nome', $request->nome);
      // return $this->repository->getAll();
    }

    // return Series::where('nome', $request->nome)->get();
    return $query->paginate(5);
  }

  public function store(SeriesFormRequest $request) {
    if($request->file('cover')) {
      $coverPath = $this->upload($request)->content();
      $request->coverPath = str_replace('"', '', str_replace('\\', '', $coverPath));
    }
    
    return response()->json($this->repository->add($request), 201);
  }
  
  public function upload(SeriesFormRequest $request) {
    if($request->hasFile('cover')) {
      $coverPath = $request->file('cover')->store('series_cover', 'public');
      return response()->json($coverPath, 201);
    } 

    return response()->json('Error', 400);
  }

  public function show(int $series) {
    $seriesModel = Series::with('seasons.episodes')->find($series);

    if($seriesModel === null) {
      return response()->json(['message' => 'Series not found'], 404);
    }
    // Para funcionar o argumento $series deve ser int
    // $series = Series::whereId($series)->with('seasons.episodes')->first(); // Com temporadas e episódios
    return response()->json($seriesModel, 200); // apenas dados da série
  }

  public function update(Series $series, UpdateSeriesFormRequest $request) {
    $this->repository->update($series, $request);
    return response()->json($series, 200);
  }

  public function destroy(Series $series) {
    $this->repository->delete($series);
    return response()->noContent();
  }
}
