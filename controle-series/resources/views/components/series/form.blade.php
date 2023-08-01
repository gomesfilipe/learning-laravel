<form action="{{ $action }}" method="post" @if (!$update) enctype="multipart/form-data" @endif>
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
      id="seasonsQty" 
      name="seasonsQty" 
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
  <div class="row mb-3">
    <div class="col-12">
      <label for="cover" class="form-label">Capa</label>
      <input 
        type="file" 
        id="cover"
        name="cover" 
        class="form-control"
        accept="image/gif, image/jpeg, image/png"
      >
    </div>
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
