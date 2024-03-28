<?php

namespace App\Enums;

enum TransacaoStatusEnum: string {
    case PENDENTE = 'pendente';
    case PAGO = 'pago';
    case FALHA = 'falhou';
}
