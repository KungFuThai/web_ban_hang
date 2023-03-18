<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusEnum extends Enum
{
    public const PENDING = 1;
    public const ACCEPT = 2;
    public const CANCEL = 3;
}
