@php
    $transacoes = \App\Models\TransacaoRifa::get();

    $numeros_selecionados = [];

    foreach ($transacoes as $transacao) {
        if ($transacao->rifa_id == $rifa->id) {
            $numeros = explode(",", $transacao->numero_selecionado);
            $numeros_selecionados = array_merge($numeros_selecionados, $numeros);
        }
    }

    $total_numeros = count($numeros_selecionados);
    $numeros_restantes = $rifa->limite_numeros - $total_numeros;

    $status = $rifa->status->value;
@endphp

<div class="square">
    @for($i = 1; $i <= $rifa->limite_numeros; $i++)
        @if(in_array($i, $numeros_selecionados))
            <div class='circle numero-reservado'>
                <a href="#">
                    {{ $i }}
                </a>
            </div>
        @else
            <div class='circle numero-disponivel'>
                <a href="#">
                    {{ $i }}
                </a>
            </div>
        @endif
    @endfor
</div>

<style>
    .square {
        /*width: auto;*/
        overflow-y: auto;
        max-height: 30vh;
        border: 1px solid rgba(228, 228, 231, 0.1);
        padding: 5px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        border-radius: 14px;
    }

    .circle {
        width: 30px;
        height: 30px;
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 5px;
        font-size: 14px;
    }

    .numero-disponivel {
        background-color: #32b632;
    }

    .numero-reservado {
        background-color: #ad1616;
    }

    .numero-indisponivel {
        background-color: #79795b;
    }

    .numero-indisponivel, .numero-indisponivel a, .numero-reservado, .numero-reservado a {
        cursor: default;
    }
</style>
