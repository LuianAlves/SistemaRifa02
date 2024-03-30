<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Rifa;
use App\Models\TransacaoRifa;

class IndexController extends Controller
{
    public function index()
    {
        $rifas = Rifa::get();

        $transacoes = TransacaoRifa::get();

        return view('home.index', compact('rifas', 'transacoes'));
    }

    public function view($rifa_id)
    {
        return view('filament.app.resources.transacao-rifa-resource.pages.transacao-rifa');
    }
}
