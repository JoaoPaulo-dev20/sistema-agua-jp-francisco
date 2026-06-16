@extends('layouts.app')
@section('content')
<h3>Editar Consumidor</h3>
<form method="POST" action="{{ route('consumidores.update', $consumidor) }}">
    @csrf @method('PUT')
    <div class="mb-3"><label>Nome</label><input name="nome" value="{{ $consumidor->nome }}" class="form-control" required></div>
    <div class="mb-3"><label>Endereço</label><input name="endereco" value="{{ $consumidor->endereco }}" class="form-control" required></div>
    <div class="mb-3"><label>Número do Medidor</label><input name="numero_medidor" value="{{ $consumidor->numero_medidor }}" class="form-control" required></div>
    <div class="mb-3"><label>Telefone</label><input name="telefone" value="{{ $consumidor->telefone }}" class="form-control" required></div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection