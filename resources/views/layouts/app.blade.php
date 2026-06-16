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
        <a class="navbar-brand" href="{{ route('consumidores.index') }}">💧 Água</a>
        <div class="navbar-nav">
            <a class="nav-link text-white" href="{{ route('consumidores.index') }}">Consumidores</a>
            <a class="nav-link text-white" href="{{ route('leituras.create') }}">Registrar Leitura</a>
            <a class="nav-link text-white" href="{{ route('faturas.index') }}">Faturas</a>
            <a class="nav-link text-white" href="{{ route('configuracao.edit') }}">Configuração</a>
        </div>
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