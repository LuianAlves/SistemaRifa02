<?php

namespace App\Filament\Resources;

use App\Enums\RifaStatusTypeEnum;
use App\Filament\Forms\Components\PtbrMoney;
use App\Filament\Resources\RifaResource\Pages;
use App\Filament\Resources\RifaResource\RelationManagers;
use App\Models\Rifa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RifaResource extends Resource
{
    protected static ?string $model = Rifa::class;

    protected static ?string $navigationGroup = "Rifas";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categoria_id')
                    ->label('Categoria de Rifa')
                    ->relationship('categoriaRifa', 'nome_categoria')
                    ->required(),

                Forms\Components\TextInput::make('titulo')
                    ->label('Nome')
                    ->required()
                    ->maxLength(191),

                Forms\Components\FileUpload::make('imagem')
                    ->label('Foto da Rifa')
                    ->image()
                    ->openable() // Abrir imagem
                    ->downloadable() // Baixar imagem
                    ->directory('imagens_rifa'),

                Forms\Components\TextInput::make('status')
                    ->label('Status da Rifa')
                    ->default('aberto')
                    ->disabled(),

                PtbrMoney::make('valor')
                ->required(),

                Forms\Components\Textarea::make('descricao')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('data_inicio')
                    ->required(),

                Forms\Components\DatePicker::make('data_previsao_sorteio')
                    ->required(),

                Forms\Components\TextInput::make('limite_numeros')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categoria_id')
                    ->label('Categoria')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('titulo')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\ImageColumn::make('imagem')
                    ->circular(),

                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->money('BRL')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('limite_numeros')
                    ->label('Quantidade Números')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\TextColumn::make('data_inicio')
                    ->label('Data de Ínicio')
                    ->date()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('data_previsao_sorteio')
                    ->label('Previsão do Sorteio')
                    ->date()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn(RifaStatusTypeEnum $state): string => match ($state) {
                        RifaStatusTypeEnum::ABERTO => 'success',
                        RifaStatusTypeEnum::ANDAMENTO => 'warning',
                        RifaStatusTypeEnum::FINALIZADO => 'danger',
                    })
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->alignCenter()
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
            'index' => Pages\ListRifas::route('/'),
            'create' => Pages\CreateRifa::route('/create'),
            'edit' => Pages\EditRifa::route('/{record}/edit'),
        ];
    }

    // Badge no sidenav
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
