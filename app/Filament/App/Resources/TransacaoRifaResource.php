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
                            Step::make('Selecionar Número')
                                ->schema([
                                    Section::make()
                                        ->schema([
                                            Placeholder::make('Legendas')
                                                ->label('')
                                                ->content(function ($get) {
                                                    return new HtmlString(
                                                        view('home.transacao-rifa.legendas')->render()
                                                    );
                                                }),

                                            Placeholder::make('numeros_rifa')
                                                ->label('Selecionar Número')
                                                ->content(function ($get) {
                                                    return new HtmlString(
                                                        view('home.transacao-rifa.tabela_numeros', ['rifa' => Rifa::where('id', request()->route('rifa_id'))->first()])->render()
                                                    );
                                                }),
                                        ])
                                ])->columns(3),

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
