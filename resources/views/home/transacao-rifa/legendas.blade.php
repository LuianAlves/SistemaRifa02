<div class="legenda">
    <div class="legenda-box">
        <div class='legenda-square numero-disponivel'></div>
        <span class="legenda-text">Disponível</span>
    </div>

    <div class="legenda-box">
        <div class='legenda-square numero-reservado'></div>
        <span class="legenda-text">Reservado</span>
    </div>

    <div class="legenda-box">
        <div class='legenda-square numero-indisponivel'></div>
        <span class="legenda-text">Indisponível Temporariamente</span>
    </div>
</div>
<style>
    .legenda {
        display: flex;
        justify-content: center;
        align-content: space-around;
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
        margin: 5px 25px;
    }

    .legenda-text {
        margin-right: 10px; /* espaço entre o quadrado e o texto */
    }
</style>
