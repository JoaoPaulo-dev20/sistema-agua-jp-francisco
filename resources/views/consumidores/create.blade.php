@extends('layouts.app')
@section('content')
<h3>Novo Consumidor</h3>
<form method="POST" action="{{ route('consumidores.store') }}">
    @csrf
    <div class="mb-3"><label>Nome</label><input name="nome" class="form-control" required></div>
    <div class="mb-3"><label>Endereço</label><input name="endereco" class="form-control" required></div>
    <div class="mb-3"><label>Número do Medidor</label><input name="numero_medidor" class="form-control" required></div>
    <div class="mb-3"><label>Telefone (com DDD)</label><input name="telefone" class="form-control" placeholder="85999999999" required></div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection