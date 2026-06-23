<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumidorController;
use App\Http\Controllers\LeituraController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\ConfiguracaoTaxaController;
use App\Http\Middleware\CheckAdmin;

// Redireciona raiz para login se não autenticado
Route::get('/', fn() => redirect()->route('consumidores.index'));

// Rotas protegidas por autenticação (qualquer perfil)
Route::middleware(['auth'])->group(function () {

    // Leiturista e admin — registrar leitura
    Route::get('/leituras/nova', [LeituraController::class, 'create'])->name('leituras.create');
    Route::post('/leituras', [LeituraController::class, 'store'])->name('leituras.store');

    // Somente admin
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('consumidores', ConsumidorController::class)->except(['show', 'destroy']);
        Route::get('/faturas', [FaturaController::class, 'index'])->name('faturas.index');
        Route::patch('/faturas/{fatura}/pagar', [FaturaController::class, 'marcarPago'])->name('faturas.pagar');
        Route::get('/configuracao-taxa', [ConfiguracaoTaxaController::class, 'edit'])->name('configuracao.edit');
        Route::put('/configuracao-taxa', [ConfiguracaoTaxaController::class, 'update'])->name('configuracao.update');
    });
});

require __DIR__.'/auth.php';