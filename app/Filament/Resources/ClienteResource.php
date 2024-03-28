<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationGroup = "Usuários";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Select::make('user_id')
//                    ->label('Usuário')
//                    ->searchable()
//                    ->relationship('user', 'name')
//                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label("Nome Completo")
                    ->required()
                    ->maxLength(191),

                Forms\Components\TextInput::make('cpf')
                    ->label('CPF')
                    ->required()
                    ->maxLength(191),

                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required()
                    ->maxLength(191),

                Forms\Components\TextInput::make('telefone')
                    ->label('Telefone')
                    ->tel()
                    ->required()
                    ->maxLength(191),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Usuário")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("E-mail")
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->label("Contato")
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cpf')
                    ->label("CPF")
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Criado em")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("Atualizado em")
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }

    // Badge no sidenav
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
