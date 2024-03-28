<?php

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


//Route::get('/app/transacao-rifas/create/{rifa_id}', [IndexController::class, 'view'])->name('filament.pages.app.transacao-rifa.create-id');

/*

** Resources

    # Alterar logo
    # Alterar icons do sidebar
    # Adicionar função para adicionar item e redirecionar para index


*/
