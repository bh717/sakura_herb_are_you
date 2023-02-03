<?php

namespace App\Models;

use App\Enums\IsPublic;
use App\Enums\IsProductStatus;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialProduct extends BaseModel
{
    use SoftDeletes;

    public const IS_PUBLIC = IsPublic::class;
    public const IS_PRODUCT_STATUS = IsProductStatus::class;

    protected $table = 'trialproducts';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];

    protected $appends = [
    ];

    // カテゴリ
    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\TrialProductCategory', 'product_category_id');
    }

    // キーワード
    public function keywords(): HasMany
    {
        return $this->hasMany('App\Models\TrialProductKeyword');
    }

    // 材料
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Material', 'trialproduct_material')
            ->orderBy('sort_order');
    }

    // 値段
    public function prices(): HasMany
    {
        return $this->hasMany('App\Models\TrialProductPrice')
            ->orderBy('sort_order');
    }

    // 人気
    public function popularation(): HasMany
    {
        return $this->hasMany('App\Models\ProductPopularation');
    }

    // おすすめ
    public function recommendations(): HasMany
    {
        return $this->hasMany('App\Models\ProductRecommendation')
            ->orderBy('sort_order');
    }

    // 症状
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Symptom', 'trialproduct_symptom')
            ->orderBy('sort_order');
    }

    // 味
    public function tastes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Taste', 'trialproduct_taste')
            ->orderBy('sort_order');
    }

    public function flavors(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Flavor', 'trialproduct_flavor')
            ->orderBy('sort_order');
    }



    // ファイル
    public function uploadFiles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\UploadFile', 'trialproduct_upload_file');
    }

    public static function getRecommendationProducts(int $kind): Collection
    {
        return Product::with(['uploadFiles'])
            ->join('trialproduct_recommendations', 'trialproduct_recommendations.trial_product_id', 'trialproducts.id')
            ->where('kind', $kind)
            ->select(['trialproducts.*'])
            ->get();
    }
}