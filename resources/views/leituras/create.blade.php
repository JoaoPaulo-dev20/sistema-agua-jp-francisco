@extends('layouts.app')
@section('content')
<h3>Registrar Leitura</h3>
<form method="POST" action="{{ route('leituras.store') }}">
    @csrf
    <div class="mb-3">
        <label>Consumidor</label>
        <select name="consumidor_id" class="form-control" required>
            <option value="">Selecione</option>
            @foreach($consumidores as $c)
                <option value="{{ $c->id }}">{{ $c->nome }} ({{ $c->numero_medidor }})</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col mb-3"><label>Mês</label><input type="number" name="mes_referencia" min="1" max="12" class="form-control" required></div>
        <div class="col mb-3"><label>Ano</label><input type="number" name="ano_referencia" class="form-control" required></div>
    </div>
    <div class="mb-3"><label>Leitura atual (m³)</label><input type="number" step="0.01" name="leitura_atual" class="form-control" required></div>
    <button class="btn btn-success">Registrar</button>
</form>
@endsection