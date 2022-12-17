<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    public const TEMP_PURCHASE = 0; // 仮購入
    public const WAITING_SEND = 1; // 発送待ち
    public const SENT = 2; // 発送済み
    public const COMPLETE = 3; // 完了
    public const FAILED = 8; // 購入失敗
    public const CANCEL = 9; // キャンセル
}
