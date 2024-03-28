<?php

namespace App\Filament\App\Resources\TransacaoRifaResource\Pages;

use App\Filament\App\Resources\TransacaoRifaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransacaoRifa extends EditRecord
{
    protected static string $resource = TransacaoRifaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
