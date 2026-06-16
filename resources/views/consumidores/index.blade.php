@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Consumidores</h3>
    <a href="{{ route('consumidores.create') }}" class="btn btn-primary">Novo Consumidor</a>
</div>
<table class="table table-bordered">
    <thead><tr><th>Nome</th><th>Endereço</th><th>Medidor</th><th>Telefone</th><th></th></tr></thead>
    <tbody>
    @foreach($consumidores as $c)
        <tr>
            <td>{{ $c->nome }}</td><td>{{ $c->endereco }}</td><td>{{ $c->numero_medidor }}</td><td>{{ $c->telefone }}</td>
            <td><a href="{{ route('consumidores.edit', $c) }}" class="btn btn-sm btn-secondary">Editar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection