<?php

namespace App\Filament\App\Resources\TransacaoRifaResource\Pages;

use App\Filament\App\Resources\TransacaoRifaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransacaoRifas extends ListRecords
{
    protected static string $resource = TransacaoRifaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
