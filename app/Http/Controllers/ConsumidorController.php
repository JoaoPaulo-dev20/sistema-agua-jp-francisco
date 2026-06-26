<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use App\Models\LogAcesso;
use Illuminate\Http\Request;

class ConsumidorController extends Controller
{
    public function index()
    {
        $consumidores = Consumidor::orderBy('nome')->get();
        return view('consumidores.index', compact('consumidores'));
    }

    public function create()
    {
        return view('consumidores.create');
    }

    public function show(Consumidor $consumidor)
    {
        LogAcesso::create([
            'user_id' => auth()->id(),
            'consumidor_id' => $consumidor->id,
            'acao' => 'visualizou dados do consumidor',
        ]);

        $logs = LogAcesso::with('user')
            ->where('consumidor_id', $consumidor->id)
            ->latest()
            ->get();

        return view('consumidores.show', compact('consumidor', 'logs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero_medidor' => 'required|string|unique:consumidores,numero_medidor',
            'telefone' => 'required|string|max:20',
        ]);

        Consumidor::create($data);

        return redirect()->route('consumidores.index')->with('success', 'Consumidor cadastrado com sucesso.');
    }

    public function edit(Consumidor $consumidor)
    {
        LogAcesso::create([
            'user_id' => auth()->id(),
            'consumidor_id' => $consumidor->id,
            'acao' => 'visualizou dados do consumidor',
        ]);

        return view('consumidores.edit', compact('consumidor'));
    }

    public function update(Request $request, Consumidor $consumidor)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero_medidor' => 'required|string|unique:consumidores,numero_medidor,' . $consumidor->id,
            'telefone' => 'required|string|max:20',
        ]);

        $consumidor->update($data);

        return redirect()->route('consumidores.index')->with('success', 'Consumidor atualizado com sucesso.');
    }
}