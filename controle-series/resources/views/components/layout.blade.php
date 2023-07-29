<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
      
      @auth <!-- Se estiver logado, exibe botão de logout -->
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn btn-link">
          Sair
        </button>
      </form>
      @endauth

      @guest <!-- Se não estiver logado, exibe botão de login -->
      <a href="{{ route('login') }}">Entrar</a>
      @endguest
    </div>
  </nav>


  <div class="container">
    <h1>{{ $title }}</h1>

    @isset($mensagemSucesso)
      <div class="alert alert-success">
        {{ $mensagemSucesso }}
      </div>
    @endisset

    @if ($errors->any()) 
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{ $slot }}
  </div>
</body>
</html>
