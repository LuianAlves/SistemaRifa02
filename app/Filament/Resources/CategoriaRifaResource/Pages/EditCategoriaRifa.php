<?php

namespace App\Filament\Resources\CategoriaRifaResource\Pages;

use App\Filament\Resources\CategoriaRifaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoriaRifa extends EditRecord
{
    protected static string $resource = CategoriaRifaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
