<?php

namespace App\Enums;

enum RifaStatusTypeEnum: string
{
    case ABERTO = 'aberto';
    case ANDAMENTO = 'andamento';
    case FINALIZADO = 'finalizado';
}
