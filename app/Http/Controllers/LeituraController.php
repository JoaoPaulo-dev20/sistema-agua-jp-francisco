<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use App\Models\Leitura;
use App\Models\Fatura;
use App\Models\ConfiguracaoTaxa;
use Illuminate\Http\Request;

class LeituraController extends Controller
{
    public function create()
    {
        $consumidores = Consumidor::orderBy('nome')->get();
        return view('leituras.create', compact('consumidores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'consumidor_id' => 'required|exists:consumidores,id',
            'mes_referencia' => 'required|integer|min:1|max:12',
            'ano_referencia' => 'required|integer|min:2000',
            'leitura_atual' => 'required|numeric|min:0',
        ]);

        $jaExiste = Leitura::where('consumidor_id', $data['consumidor_id'])
            ->where('mes_referencia', $data['mes_referencia'])
            ->where('ano_referencia', $data['ano_referencia'])
            ->exists();

        if ($jaExiste) {
            return back()->withErrors(['leitura' => 'Já existe leitura registrada para este consumidor neste mês/ano.'])->withInput();
        }

        $ultimaLeitura = Leitura::where('consumidor_id', $data['consumidor_id'])
            ->orderByDesc('ano_referencia')
            ->orderByDesc('mes_referencia')
            ->first();

        $leituraAnterior = $ultimaLeitura ? $ultimaLeitura->leitura_atual : 0;

        if ($data['leitura_atual'] < $leituraAnterior) {
            return back()->withErrors(['leitura_atual' => 'A leitura atual não pode ser menor que a anterior (' . $leituraAnterior . ' m³).'])->withInput();
        }

        $consumo = $data['leitura_atual'] - $leituraAnterior;

        $leitura = Leitura::create([
            'consumidor_id' => $data['consumidor_id'],
            'mes_referencia' => $data['mes_referencia'],
            'ano_referencia' => $data['ano_referencia'],
            'leitura_anterior' => $leituraAnterior,
            'leitura_atual' => $data['leitura_atual'],
            'consumo_m3' => $consumo,
        ]);

        $config = ConfiguracaoTaxa::first() ?? ConfiguracaoTaxa::create(['taxa_fixa' => 25, 'valor_excedente' => 2]);

        $valorTotal = $config->taxa_fixa;
        if ($consumo > 10) {
            $valorTotal += ($consumo - 10) * $config->valor_excedente;
        }

        Fatura::create([
            'leitura_id' => $leitura->id,
            'consumidor_id' => $leitura->consumidor_id,
            'valor_total' => $valorTotal,
            'status' => 'pendente',
        ]);

        return redirect()->route('faturas.index')->with('success', 'Leitura registrada. Valor da fatura: R$ ' . number_format($valorTotal, 2, ',', '.'));
    }
}