<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EpsilonState extends Enum
{
    public const INCOMPLETE = 0; // 決済未完了
    public const SALES = 1; // 課金済み
    public const CAPTURE = 5; // 仮売上
    public const CANCEL = 9; // キャンセル
}
