<?php

return [
    'delivery_charge' => env('DELIVERY_CHARGE', 350),
    'delivery_charge_border' => env('DELIVERY_CHARGE_BORDER', 5000),
    'total_delivery_charge_include_tax_rate' => (float) env('TOTAL_DELIVERY_CHARGE_INCLUDE_TAX_RATE', 0.1), // 送料の税率
    'fee_include_tax_rate' => (float) env('FEE_INCLUDE_TAX_RATE', 0.1), // 決済手数料の税率
    'fee' => (int) env('FEE', 0), // 決済手数料
    'product_tax_rate' => (float) env('PRODUCT_TAX_RATE', 0.08),

    'coupon_usable_amount' => (int) env('COUPON_USABLE_AMOUNT', 2000),
];
