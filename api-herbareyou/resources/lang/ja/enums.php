<?php

// 使いかた
// __('enums')[OrderStatus::class][1]

return [
    App\Enums\OrderStatus::class => [
        App\Enums\OrderStatus::TEMP_PURCHASE => '仮購入', //
        App\Enums\OrderStatus::WAITING_SEND => '発送待ち', // 1
        App\Enums\OrderStatus::SENT => '発送済み', // 2
        App\Enums\OrderStatus::COMPLETE => '完了', // 3
        App\Enums\OrderStatus::FAILED => '購入失敗', // 8
        App\Enums\OrderStatus::CANCEL => 'キャンセル', // 9
    ],
    App\Enums\IsPublic::class => [
        App\Enums\IsPublic::IS_NOT_PUBLIC => '非公開',
        App\Enums\IsPublic::IS_PUBLIC => '公開',
    ],
    // App\Enums\Prefecture::class => [
    //     App\Enums\Prefecture::HOKKAIDO => '北海道',
    //     App\Enums\Prefecture::AOMORI => '青森県',
    //     App\Enums\Prefecture::IWATE => '岩手県',
    //     App\Enums\Prefecture::MIYAGI => '宮城県',
    //     App\Enums\Prefecture::AKITA => '秋田県',
    //     App\Enums\Prefecture::YAMAGATA => '山形県',
    //     App\Enums\Prefecture::FUKUSHIMA => '福島県',
    //     App\Enums\Prefecture::IBARAKI => '茨城県',
    //     App\Enums\Prefecture::TOCHIGI => '栃木県',
    //     App\Enums\Prefecture::GUNMA => '群馬県',
    //     App\Enums\Prefecture::SAITAMA => '埼玉県',
    //     App\Enums\Prefecture::CHIBA => '千葉県',
    //     App\Enums\Prefecture::TOKYO => '東京都',
    //     App\Enums\Prefecture::KANAGAWA => '神奈川県',
    //     App\Enums\Prefecture::NIIGATA => '新潟県',
    //     App\Enums\Prefecture::TOYAMA => '富山県',
    //     App\Enums\Prefecture::ISHIKAWA => '石川県',
    //     App\Enums\Prefecture::FUKUI => '福井県',
    //     App\Enums\Prefecture::YAMANASHI => '山梨県',
    //     App\Enums\Prefecture::NAGANO => '長野県',
    //     App\Enums\Prefecture::GIFU => '岐阜県',
    //     App\Enums\Prefecture::SHIZUOKA => '静岡県',
    //     App\Enums\Prefecture::AICHI => '愛知県',
    //     App\Enums\Prefecture::MIE => '三重県',
    //     App\Enums\Prefecture::SHIGA => '滋賀県',
    //     App\Enums\Prefecture::KYOTO => '京都県',
    //     App\Enums\Prefecture::OSAKA => '大阪府',
    //     App\Enums\Prefecture::HYOGO => '兵庫県',
    //     App\Enums\Prefecture::NARA => '奈良県',
    //     App\Enums\Prefecture::WAKAYAMA => '和歌山県',
    //     App\Enums\Prefecture::TOTTORI => '鳥取県',
    //     App\Enums\Prefecture::SHIMANE => '島根県',
    //     App\Enums\Prefecture::OKAYAMA => '岡山県',
    //     App\Enums\Prefecture::HIROSHIMA => '広島県',
    //     App\Enums\Prefecture::YAMAGUCHI => '山口県',
    //     App\Enums\Prefecture::TOKUSHIMA => '徳島県',
    //     App\Enums\Prefecture::KAGAWA => '香川県',
    //     App\Enums\Prefecture::EHIME => '愛媛県',
    //     App\Enums\Prefecture::KOCHI => '高知県',
    //     App\Enums\Prefecture::FUKUOKA => '福岡県',
    //     App\Enums\Prefecture::SAGA => '佐賀県',
    //     App\Enums\Prefecture::NAGASAKI => '長崎県',
    //     App\Enums\Prefecture::KUMAMOTO => '熊本県',
    //     App\Enums\Prefecture::OITA => '大分県',
    //     App\Enums\Prefecture::MIYAZAKI => '宮崎県',
    //     App\Enums\Prefecture::KAGOSHIMA => '鹿児島県',
    //     App\Enums\Prefecture::OKINAWA => '沖縄県',
    // ],
];
