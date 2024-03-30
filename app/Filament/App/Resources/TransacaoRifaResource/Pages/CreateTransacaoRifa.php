<?php

namespace App\Filament\App\Resources\TransacaoRifaResource\Pages;

use App\Filament\App\Resources\TransacaoRifaResource;
use App\Models\NumerosTemporarios;
use App\Models\Rifa;
use App\Models\TransacaoRifa;
use Filament\Actions\Concerns\HasWizard;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\HtmlString;

class CreateTransacaoRifa extends CreateRecord
{
    use HasWizard;

    protected static string $resource = TransacaoRifaResource::class;

    public function form(Form $form): Form
    {
        $rifaId = request()->route('rifa_id');
        $rifa = Rifa::find($rifaId);

        return $form->schema([
            Section::make()
                ->schema([
                    Wizard::make([
                        Step::make('Selecionar Número')
                            ->schema([
                                Section::make()->schema([
                                    Placeholder::make('numeros_rifa')
                                        ->label('')
                                        ->content(self::getNumeros($rifa)),
                                ]),
                            ])
                            ->columns(3),

                        Step::make('Pagamento')
                            ->schema([
                                //
                            ]),
                    ]),
                ])->columnSpanFull()
        ]);
    }

    public static function getNumerosSelecionados($rifaId)
    {
        $transacoes = TransacaoRifa::where('rifa_id', $rifaId)->get();
        $numeros_selecionados = [];

        foreach ($transacoes as $transacao) {
            if (isset($transacao->numero_selecionado)) {
                $numeros = explode(',', $transacao->numero_selecionado);
                $numeros_selecionados = array_merge($numeros_selecionados, $numeros);
            }
        }

        return array_unique($numeros_selecionados);
    }

    public static function getNumerosTemporarios($rifaId)
    {
        $temps = NumerosTemporarios::where('rifa_id', $rifaId)->get();

        $numeros_temporarios = [];
        foreach ($temps as $temp) {
            $numeros_temporarios[] = $temp->numero_selecionado;
        }

        return $numeros_temporarios;
    }

    public static function getNumeros($rifa)
    {
        return new HtmlString(view('home.transacao-rifa.tabela_numeros', ['rifa' => $rifa])->render());
    }
}
