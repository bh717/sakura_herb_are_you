<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductRecommendationKind extends Enum
{
    public const HEALING = 1; // HEALING(具体的な症状・不調に)
    public const INSPIRATION = 2; // INSPIRATION(前向きな今日に)
    public const MAINTENANCE = 3; // MAINTENANCE(なんとなくのもやもやに)
    public const SEASONAL_RECOMMENDATIONS = 4; // 今月のおすすめハーブティー
}
