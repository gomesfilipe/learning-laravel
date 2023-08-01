<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
  @auth
  <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
  @endauth

  <ul class="list-group">
    @foreach ($series as $serie)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <img 
            src="{{ asset('storage/' . $serie->cover) }}" 
            width="100px"
            class="img-thumbnail me-3"
            alt="Thumbnail da Série {!! $serie->nome !!}"
          >
        
          @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
            {{ $serie->nome }}
          @auth </a>  @endauth
        </div>
        
        @auth
        <span class="d-flex">
          <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>

          <form action="{{ route('series.destroy', $serie->id) }}", method="post" class="ms-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Deletar</button>
          </form>
        </span>
        @endauth
      </li>
    @endforeach
  </ul>
</x-layout>
