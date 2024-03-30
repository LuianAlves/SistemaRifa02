@php
    $transacao = \App\Models\TransacaoRifa::where('rifa_id', $rifa->rifa_id)->get();


@endphp

<div class="square">
    @for($i = 1; $i <= $rifa->limite_numeros; $i++)
        <div class='circle numero-indisponivel'>
            <a href="#">
                {{ $i }}
            </a>
        </div>
    @endfor

</div>

<style>
    .square {
        width: auto;
        height: 100%;
        overflow-y: auto;
        max-height: 320px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
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
        background-color: #9f9f9f;
    }

    .numero-indisponivel, .numero-indisponivel a {
        cursor: not-allowed;
    }
</style>
