<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\PanelTypeEnum;
use App\Mail\NovoClienteMail;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ClienteObserver
{
    public function created(Cliente $cliente): void
    {
        $password = Str::random(8);

        $user = User::create([
            'name' => $cliente->name,
            'email' => $cliente->email,
            'panel' => PanelTypeEnum::APP,
            'password' => bcrypt($password)
        ]);

        $cliente->user_id = $user->id;
        $cliente->saveQuietly();

//        dd($password);

        Mail::to($cliente->email)->send(new NovoClienteMail($cliente, $password));
    }
}
