<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends BaseModel
{
    use Notifiable;
    use SoftDeletes;

    public const ORDER_STATUS = OrderStatus::class;

    protected $table = 'orders';
    protected $guarded = [
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [
        'delivered_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getDeliveredAtAttribute(): ?string
    {
        if (is_null($this->attributes["delivered_at"])) {
            return null;
        }
        return $this->asDateTime($this->attributes["delivered_at"])->format('Y-m-d H:i:s');
    }

    // 注文詳細
    public function details(): HasMany
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productPrice(): BelongsTo
    {
        return $this->belongsTo(ProductPrice::class);
    }

    // 注文詳細
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    // 仮購入
    public function tempPurchaseStatus(): string
    {
        return $this->status === OrderStatus::TEMP_PURCHASE;
    }

    // 発送待ち
    public function waitingSendStatus(): string
    {
        return $this->status === OrderStatus::WAITING_SEND;
    }

    // 発送済み
    public function sentStatus(): string
    {
        return $this->status === OrderStatus::SENT;
    }

    // 完了
    public function completeStatus(): string
    {
        return $this->status === OrderStatus::COMPLETE;
    }

    // 購入失敗
    public function failedStatus(): string
    {
        return $this->status === OrderStatus::FAILED;
    }

    // キャンセル
    public function cancelStatus(): string
    {
        return $this->status === OrderStatus::CANCEL;
    }

    public function scopeWhereAfterMail($query)
    {
        return $query->where('send_date_time', '<', (new Carbon())->subDays(config('consts.AFTER_MAIL_SUB_DAYS')))
            ->where('status', OrderStatus::SENT);
    }

    public function updateToAfterMail(): void
    {
        $this->status = OrderStatus::COMPLETE;
        $this->saveOrFail();
    }

    // 送料
    public static function totalDeliveryCharge(
        int $totalProductPrice
    ): int {
        if ($totalProductPrice >= config('order.delivery_charge_border')) {
            return 0;
        }
        return config('order.delivery_charge');
    }

    // 送料内税
    public static function totalDeliveryChargeIncludeTax(
        int $totalDeliveryCharge
    ): int {
        return floor(
            $totalDeliveryCharge * (1 - (1 / (1 + config('order.total_delivery_charge_include_tax_rate'))))
        );
    }

    // 決済手数料内税
    public static function feeIncludeTax(): int
    {
        return floor(
            config('order.FEE') * (1 - (1 / (1 + config('order.fee_include_tax_rate'))))
        );
    }

    // 商品内税
    public static function productIncludeTax(
        int $price
    ): int {
        return floor(
            $price * (1 - (1 / (1 + config('order.product_tax_rate'))))
        );
    }
}
