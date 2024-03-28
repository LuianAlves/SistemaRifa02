<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TransacaoRifaResource\Pages;
use App\Filament\App\Resources\TransacaoRifaResource\RelationManagers;
use App\Filament\Forms\Components\PtbrMoney;
use App\Models\Rifa;
use App\Models\TransacaoRifa;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransacaoRifaResource extends Resource
{
    protected static ?string $model = TransacaoRifa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $rifaId = request()->route('rifa_id');
        $rifa = Rifa::findOrFail($rifaId);

//        dd($rifa);
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Wizard::make([
                            Wizard\Step::make('Campanha')
                                ->schema([
                                    // user_id
                                    // rifa_id
                                    // titulo OK
                                    // status transacao
                                    // valor OK
                                    // descricao OK

                                    Forms\Components\TextInput::make('titulo')
                                        ->label('Campanha')
                                        ->disabled()
                                        ->required()
                                        ->default($rifa->titulo),

//                                    Forms\Components\TextInput::make('status_transacao')
//                                        ->disabled()
//                                        ->required()
//                                        ->maxLength(191)
//                                        ->default(),

                                    PtbrMoney::make('valor')
                                        ->label('Valor da Rifa')
                                        ->disabled()
                                        ->required()
                                        ->prefix('R$ ')
                                        ->default($rifa->valor),

                                    Forms\Components\Textarea::make('descricao')
                                        ->label('Descrição')
                                        ->disabled()
                                        ->rows(10)
                                        ->default($rifa->descricao),

                                ])->columns(3),

                            Wizard\Step::make('Escolher Números')
                                ->schema([
                                    // ...
                                ]),

                            Wizard\Step::make('Pagamento')
                                ->schema([
                                    // ...
                                ]),
                        ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rifa_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListTransacaoRifas::route('/'),
            'create' => Pages\CreateTransacaoRifa::route('/create/{rifa_id}'),
            'edit' => Pages\EditTransacaoRifa::route('/{record}/edit'),
        ];
    }
}

//Wizard::make([
//    Wizard\Step::make('Order')
//        ->schema([
//
//            // user_id
//            // rifa_id
//
//            Forms\Components\TextInput::make('titulo')
//                ->disabled()
//                ->required()
//                ->default($rifa->titulo),
//
//            Forms\Components\TextInput::make('status')
//                ->disabled()
//                ->required()
//                ->maxLength(191)
//                ->default($rifa->status),
//
//            Forms\Components\TextInput::make('valor')
//                ->disabled()
//                ->required()
//                ->prefix('R$ ')
//                ->default($rifa->valor),
//        ]),
//    Wizard\Step::make('Delivery')
//        ->schema([
//            Forms\Components\Textarea::make('descricao')
//                ->disabled()
//                ->rows(10)
//                ->default($rifa->descricao),
//        ]),
//    Wizard\Step::make('Billing')
//        ->schema([
//            // ...
//        ]),
//])
