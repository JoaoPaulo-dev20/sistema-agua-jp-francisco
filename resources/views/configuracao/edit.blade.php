@extends('layouts.app')
@section('content')
<h3>Configuração de Taxa</h3>
<form method="POST" action="{{ route('configuracao.update') }}">
    @csrf @method('PUT')
    <div class="mb-3"><label>Taxa fixa (R$)</label><input type="number" step="0.01" name="taxa_fixa" value="{{ $config->taxa_fixa }}" class="form-control" required></div>
    <div class="mb-3"><label>Valor por m³ excedente (R$)</label><input type="number" step="0.01" name="valor_excedente" value="{{ $config->valor_excedente }}" class="form-control" required></div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection