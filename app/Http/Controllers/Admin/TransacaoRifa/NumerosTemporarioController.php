<?php

namespace App\Http\Controllers\Admin\TransacaoRifa;

use App\Http\Controllers\Controller;
use App\Models\NumerosTemporarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumerosTemporarioController extends Controller
{
    public function store(Request $request)
    {


        $numeroTemporario = NumerosTemporarios::create([
           'user_id' => Auth::user()->id,
           'rifa_id' => $request->rifa_id,
           'numero_selecionado' => $request->numero,
           'created_at' => Carbon::now()->format('d-m-y')
        ]);


//        numero = $request->input('numero');
//
//        Numero::create(['numero' => $numero]);
//
        return response()->json(['message' => 'Número armazenado com sucesso'], 200);
    }
}
