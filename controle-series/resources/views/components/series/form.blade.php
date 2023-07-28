<form action="{{ $action }}" method="post">
  @csrf

  @if ($update)
  @method('PUT')
  @endif
  <div class="mb-3">
    <label for="nome" class="form-label">Nome:</label>
    <input 
      autofocus
      type="text" 
      id="nome" 
      name="nome" 
      class="form-control"
      @isset($nome) value="{{ $nome }}"@endisset
    >
  </div>

  @if (!$update)
  <div class="mb-3">
    <label for="seasonsQty" class="form-label">Número de Temporadas:</label>
    <input 
      type="text" 
      id="seasonQty" 
      name="seasonQty" 
      class="form-control"
      value="{{ old('seasonsQty') }}"
    >
  </div>
  <div class="mb-3">
    <label for="episodesPerSeason" class="form-label">Episódios por Temporada:</label>
    <input 
      type="text" 
      id="episodesPerSeason" 
      name="episodesPerSeason" 
      class="form-control"
      value="{{ old('episodesPerSeason') }}"
    >
  </div>
  @endif

  <button type="submit" class="btn btn-primary">
    @if ($update)
      Editar
    @else
      Adicionar
    @endif
  </button>
</form>
