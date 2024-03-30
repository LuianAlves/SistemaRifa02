<?php

namespace App\Filament\Resources\CategoriaRifaResource\Pages;

use App\Filament\Resources\CategoriaRifaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoriaRifa extends CreateRecord
{
    protected static string $resource = CategoriaRifaResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
