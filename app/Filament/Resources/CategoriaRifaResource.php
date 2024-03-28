<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaRifaResource\Pages;
use App\Filament\Resources\CategoriaRifaResource\RelationManagers;
use App\Models\CategoriaRifa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoriaRifaResource extends Resource
{
    protected static ?string $model = CategoriaRifa::class;

    protected static ?string $navigationGroup = "Rifas";

    protected static ?string $modelLabel = "Categoria";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_categoria')
                    ->label('Categoria de Rifa')
                    ->required()
                    ->maxLength(75),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_categoria')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoriaRifas::route('/'),
            'create' => Pages\CreateCategoriaRifa::route('/create'),
            'edit' => Pages\EditCategoriaRifa::route('/{record}/edit'),
        ];
    }

    // Badge no sidenav
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
