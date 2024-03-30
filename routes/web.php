<?php

use App\Http\Controllers\Admin\TransacaoRifa\NumerosTemporarioController;
use App\Http\Controllers\App\IndexController;
use Illuminate\Support\Facades\Route;


//
//Route::get('/', function () {
//    return view('welcome');
//})->name('frontend.home');
//

Route::get('/', [IndexController::class, 'index'])->name('frontend.home');

Route::fallback(function () {
     return redirect('/app');
});


Route::post('/numeros-temporarios/store', [NumerosTemporarioController::class, 'store'])->name('numero-temporario.store');

/*

** Resources

    # Alterar logo
    # Alterar icons do sidebar
    # Adicionar função para adicionar item e redirecionar para index


*/
