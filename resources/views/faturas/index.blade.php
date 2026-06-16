@extends('layouts.app')
@section('content')
<h3>Faturas</h3>
<table class="table table-bordered">
    <thead><tr><th>Consumidor</th><th>Mês/Ano</th><th>Consumo</th><th>Valor</th><th>Status</th><th></th></tr></thead>
    <tbody>
    @foreach($faturas as $f)
        <tr>
            <td>{{ $f->consumidor->nome }}</td>
            <td>{{ $f->leitura->mes_referencia }}/{{ $f->leitura->ano_referencia }}</td>
            <td>{{ $f->leitura->consumo_m3 }} m³</td>
            <td>R$ {{ number_format($f->valor_total, 2, ',', '.') }}</td>
            <td>
                @if($f->status === 'pago')
                    <span class="badge bg-success">Pago</span>
                @else
                    <span class="badge bg-warning">Pendente</span>
                @endif
            </td>
            <td>
                @if($f->status === 'pendente')
                <form method="POST" action="{{ route('faturas.pagar', $f) }}" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-primary">Marcar como pago</button>
                </form>
                @endif
                @php
                    $msg = "Olá, {$f->consumidor->nome}! Segue o consumo de {$f->leitura->mes_referencia}/{$f->leitura->ano_referencia}:\n"
                        . "Medidor: {$f->consumidor->numero_medidor}\n"
                        . "Leitura anterior: {$f->leitura->leitura_anterior} m³ → Leitura atual: {$f->leitura->leitura_atual} m³\n"
                        . "Consumo: {$f->leitura->consumo_m3} m³ (" . ($f->leitura->consumo_m3 * 1000) . " litros)\n"
                        . "Valor da fatura: R$ " . number_format($f->valor_total, 2, ',', '.') . "\n"
                        . "Att, Associação Comunitária";
                    $tel = preg_replace('/\D/', '', $f->consumidor->telefone);
                @endphp
                <a class="btn btn-sm btn-success" target="_blank" href="https://wa.me/55{{ $tel }}?text={{ urlencode($msg) }}">WhatsApp</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection