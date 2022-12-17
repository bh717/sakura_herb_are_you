<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EpsilonResult extends Enum
{
    public const FAILED = 0; // 購入失敗
    public const SUCCESS = 1; // 購入成功
}
