<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Rifa;

class IndexController extends Controller
{
    public function index()
    {
        $rifas = Rifa::get();

        return view('home.index', compact('rifas'));
    }

    public function view($rifa_id)
    {
        return view('filament.app.resources.transacao-rifa-resource.pages.transacao-rifa');
    }
}
