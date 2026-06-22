<?php

namespace App\Enums;

enum OrderType: string
{
    case PICKUP = 'pickup';
    case DELIVERY = 'delivery';
    case DINE_IN = 'dine_in';
}
