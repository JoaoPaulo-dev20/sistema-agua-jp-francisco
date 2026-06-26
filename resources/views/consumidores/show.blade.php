@extends('layouts.app')
@section('content')
<h3>Detalhes do Consumidor</h3>
<div class="mb-3">
    <strong>Nome:</strong> {{ $consumidor->nome }}<br>
    <strong>Endereço:</strong> {{ $consumidor->endereco }}<br>
    <strong>Número do medidor:</strong> {{ $consumidor->numero_medidor }}<br>
    <strong>Telefone:</strong> {{ $consumidor->telefone }}<br>
    @if($consumidor->deleted_at)
        <span class="badge bg-danger">Inativo</span>
    @endif
</div>
<a href="{{ route('consumidores.edit', $consumidor) }}" class="btn btn-secondary mb-4">Editar</a>
<a href="{{ route('consumidores.index') }}" class="btn btn-light mb-4">Voltar</a>

<h5>Histórico de acesso</h5>
@if($logs->isEmpty())
    <p>Nenhum acesso registrado ainda.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Quando</th>
            <th>Quem</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $log->user->name ?? 'Usuário removido' }}</td>
            <td>{{ $log->acao }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
