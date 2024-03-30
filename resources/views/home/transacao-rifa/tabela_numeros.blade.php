@php
    $numeros_selecionados = \App\Filament\App\Resources\TransacaoRifaResource\Pages\CreateTransacaoRifa::getNumerosSelecionados($rifa->id);
    $numeros_temporarios = \App\Filament\App\Resources\TransacaoRifaResource\Pages\CreateTransacaoRifa::getNumerosTemporarios($rifa->id);


    $total_numeros = count($numeros_selecionados); // 10000
    $total_numeros_indisponiveis = count($numeros_temporarios);
    $numeros_restantes = $rifa->limite_numeros - $total_numeros - $total_numeros_indisponiveis; // 9000
@endphp

{{-- Legendas --}}
<div class="legenda">
    <div class="legenda-box">
        <div class='legenda-square disponivel'></div>
        <span class="legenda-text">Disponível [<span id="contador-disponivel">{{$numeros_restantes}}</span>]</span>
    </div>

    <div class="legenda-box">
        <div class='legenda-square reservado'></div>
        <span class="legenda-text">Reservado [<span id="contador-reservado">{{$total_numeros}}</span>]</span>
    </div>

    <div class="legenda-box">
        <div class='legenda-square indisponivel'></div>
        <span class="legenda-text">Indisponível [<span id="contador-indisponivel">{{$total_numeros_indisponiveis}}</span>]</span>
    </div>
</div>

{{-- Selecionar Números --}}
<div class="box">
    <div class="box-item col-9">
        <h2>Selecionar número</h2>
        <div class="square" id="square1">
            @for($i = 1; $i <= $rifa->limite_numeros; $i++)
                @if(in_array($i, $numeros_selecionados))
                    <div class="circle reservado">
                        <a href="#">
                            {{ $i }}
                        </a>
                    </div>
                @elseif(in_array($i, $numeros_temporarios))
                    <div class="circle indisponivel" data-value="{{$i}}">
                        <a href="#">
                            {{ $i }}
                        </a>
                    </div>
                @else
                    <div class="circle disponivel" data-value="{{$i}}">
                        <a href="#">
                            {{ $i }}
                        </a>
                    </div>
                @endif
            @endfor
        </div>
    </div>
    <div class="box-item col-3">
        <h2>Números selecionados</h2>
        <div class="square" id="square2"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.circle.disponivel').click(function() {
            var numero = $(this).text();
            var dataValue = $(this).data('value');
            var rifaId = {!! json_encode($rifa->id) !!};

            var numerosSelecionados = $('#square2').children().map(function() {
                return $(this).data('value');
            }).get();

            if (numerosSelecionados.includes(dataValue)) {
                return;
            }

            var newCircle = $('<div>').addClass('circle selecionado').text(numero).data('value', dataValue);
            $('#square2').append(newCircle);

            $(this).removeClass('circle disponivel').addClass('circle reservado');

            $('#contador-reservado').text(parseInt($('#contador-reservado').text()) + 1);
            $('#contador-disponivel').text(parseInt($('#contador-disponivel').text()) - 1);

            $('#square2').children().sort(function(a, b) {
                return parseInt($(a).data('value')) - parseInt($(b).data('value'));
            }).appendTo('#square2');

            // Obter o token CSRF
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Enviar requisição AJAX para armazenar o número selecionado
            $.ajax({
                url: '/numeros-temporarios/store',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    numero: dataValue,
                    rifa_id: rifaId
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log('Número armazenado com sucesso!');
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao armazenar número:', xhr.status);
                }
            });
        });
    });
</script>


<style>
    .box {
        display: flex;
    }

    .box-item {
        display: flex;
        flex-direction: column;
    }

    .col-9 {
        width: calc(8.3% * 8);
        margin-right: 2%;
    }

    .col-3 {
        width: calc(8.3% * 4);
    }

    .square {
        width: 100%;
        overflow-y: auto;
        height: 30vh;
        border: 1px solid rgba(228, 228, 231, 0.1);
        padding: 5px;
        margin: 7.5px 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        border-radius: 14px;
    }

    #square2 {
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
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

    .legenda {
        display: flex;
        justify-content: center;
        align-content: space-around;
        padding-bottom: 50px;
    }

    .legenda-square {
        width: 50px;
        height: 15px;
        color: #fff;
        border-radius: 2.5px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
        font-size: 14px;
    }

    .legenda-box {
        display: flex;
        align-items: center;
        margin: 5px 20px;
    }

    .legenda-text {
        margin-right: 10px; /* espaço entre o quadrado e o texto */
    }

    .disponivel {
        background-color: #32b632;
    }

    .reservado {
        background-color: #ad1616;
    }

    .indisponivel {
        background-color: #b7b7b7;
    }

    .indisponivel, .indisponivel a, .reservado, .reservado a {
        cursor: default;
    }

    .selecionado {
        background-color: #1926a6;
    }
</style>

