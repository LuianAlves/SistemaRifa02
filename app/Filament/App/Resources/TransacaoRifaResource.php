<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TransacaoRifaResource\Pages;
use App\Filament\App\Resources\TransacaoRifaResource\RelationManagers;
use App\Filament\Forms\Components\PtbrMoney;
use App\Models\Rifa;
use App\Models\TransacaoRifa;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class TransacaoRifaResource extends Resource
{
    protected static ?string $model = TransacaoRifa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
//        $rifaId = ;
//        $rifa = Rifa::findOrFail($rifaId);

//        dd($rifa);
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Wizard::make([
                            Step::make('Campanha')
                                ->schema([
                                    // user_id
                                    // rifa_id
                                    // titulo OK
                                    // status transacao
                                    // valor OK
                                    // descricao OK

                                    TextInput::make('titulo')
                                        ->label('Campanha')
                                        ->disabled()
                                        ->required(),
//                                        ->default($rifa->titulo),

//                                    TextInput::make('status_transacao')
//                                        ->disabled()
//                                        ->required()
//                                        ->maxLength(191)
//                                        ->default(),

                                    PtbrMoney::make('valor')
                                        ->label('Valor da Rifa')
                                        ->disabled()
                                        ->required()
                                        ->prefix('R$ '),
//                                        ->default($rifa->valor),

                                    Textarea::make('descricao')
                                        ->label('Descrição')
                                        ->disabled()
                                        ->rows(10),
//                                        ->default($rifa->descricao),

//                                    Section::make()
//                                        ->schema([
//                                            ViewField::make('transacao')
//                                                ->label('Campanha')
//                                                ->view('home.transacao-rifa.transacao')
//                                        ])
                                    Section::make()
                                        ->schema([
                                            Placeholder::make('sale_resume')
                                                ->label('Selecionar Número')
                                                ->content(function ($get) {
                                                    return new HtmlString(
                                                        view('home.transacao-rifa.transacao', ['rifa' => Rifa::where('id', request()->route('rifa_id'))->first()])->render()
                                                    );
                                                }),
                                        ])
                                ])->columns(3),

                            Step::make('Escolher Números')
                                ->schema([
                                    // ...
                                ]),

                            Step::make('Pagamento')
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
