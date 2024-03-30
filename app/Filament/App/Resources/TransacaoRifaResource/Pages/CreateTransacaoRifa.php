<?php

namespace App\Filament\App\Resources\TransacaoRifaResource\Pages;

use App\Filament\App\Resources\TransacaoRifaResource;
use App\Filament\Forms\Components\PtbrMoney;
use Filament\Actions;
use Filament\Actions\Concerns\HasWizard;
use Filament\Forms\Components\Wizard;
use Filament\Resources\Pages\CreateRecord;

class CreateTransacaoRifa extends CreateRecord
{
    use HasWizard;

    protected static string $resource = TransacaoRifaResource::class;

}
