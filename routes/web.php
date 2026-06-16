<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumidorController;
use App\Http\Controllers\LeituraController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\ConfiguracaoTaxaController;

Route::get('/', fn() => redirect()->route('consumidores.index'));

Route::resource('consumidores', ConsumidorController::class)->except(['show', 'destroy']);
Route::get('/leituras/nova', [LeituraController::class, 'create'])->name('leituras.create');
Route::post('/leituras', [LeituraController::class, 'store'])->name('leituras.store');
Route::get('/faturas', [FaturaController::class, 'index'])->name('faturas.index');
Route::patch('/faturas/{fatura}/pagar', [FaturaController::class, 'marcarPago'])->name('faturas.pagar');
Route::get('/configuracao-taxa', [ConfiguracaoTaxaController::class, 'edit'])->name('configuracao.edit');
Route::put('/configuracao-taxa', [ConfiguracaoTaxaController::class, 'update'])->name('configuracao.update');