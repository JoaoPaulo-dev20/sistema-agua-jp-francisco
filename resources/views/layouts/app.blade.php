<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Água</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('leituras.create') }}">💧 Água</a>
        <div class="navbar-nav me-auto">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link text-white" href="{{ route('consumidores.index') }}">Consumidores</a>
                    <a class="nav-link text-white" href="{{ route('faturas.index') }}">Faturas</a>
                    <a class="nav-link text-white" href="{{ route('configuracao.edit') }}">Configuração</a>
                @endif
                <a class="nav-link text-white" href="{{ route('leituras.create') }}">Registrar Leitura</a>
            @endauth
        </div>
        @auth
        <div class="navbar-nav">
            <span class="nav-link text-white opacity-75">
                {{ auth()->user()->name }}
                <span class="badge bg-light text-dark ms-1">{{ auth()->user()->role }}</span>
            </span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light ms-2">Sair</button>
            </form>
        </div>
        @endauth
    </div>
</nav>
<div class="container mt-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>