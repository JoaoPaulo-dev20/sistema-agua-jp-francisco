<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoTaxa;
use Illuminate\Http\Request;

class ConfiguracaoTaxaController extends Controller
{
    public function edit()
    {
        $config = ConfiguracaoTaxa::first() ?? ConfiguracaoTaxa::create(['taxa_fixa' => 25, 'valor_excedente' => 2]);
        return view('configuracao.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'taxa_fixa' => 'required|numeric|min:0',
            'valor_excedente' => 'required|numeric|min:0',
        ]);

        ConfiguracaoTaxa::first()->update($data);

        return redirect()->route('configuracao.edit')->with('success', 'Configuração atualizada.');
    }
}