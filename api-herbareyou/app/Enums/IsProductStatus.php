<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class IsProductStatus extends Enum
{
    public const IS_SOLD_OUT = 2;
    public const IS_RECOMMMEND = 3;
    public const IS_PRODUCT_STATUS = 1;
    public const IS_NORMAL = 0;
}
