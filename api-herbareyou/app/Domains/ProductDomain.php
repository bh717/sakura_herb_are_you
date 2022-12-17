<?php

namespace App\Domains;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\ProductRecommendation;
use App\Models\UploadFile;
use Illuminate\Database\Eloquent\Collection;

class ProductDomain extends BaseDomain
{
    private $product;
    private $productPrice;
    private $uploadFile;
    private $productRecommendation;

    public function __construct(
        Product $product,
        ProductPrice $productPrice,
        ProductCategory $productCategory,
        UploadFile $uploadFile,
        ProductRecommendation $productRecommendation
    )
    {
        $this->product = $product;
        $this->productPrice = $productPrice;
        $this->productCategory = $productCategory;
        $this->uploadFile = $uploadFile;
        $this->productRecommendation = $productRecommendation;
    }

    public function createProduct(array $data): Product
    {
        $newProduct = $this->product->create($this->getProductData($data));
        $newProduct->tastes()->sync($data['taste_ids']);
        $newProduct->materials()->sync($data['material_ids']);
        $newProduct->symptoms()->sync($data['symptom_ids']);
        if ($data['keyword_csv'] !== null) {
            $inSertData = [];
            foreach (explode(',', $data['keyword_csv']) as $key => $value) {
                $inSertData[] = [
                    'keyword' => $value,
                ];
            }
            $newProduct->keywords()->createMany($inSertData);
        }

        // foreach ($data['upload_file_hashs'] as $item) {
        //     $uploadFileIds = $this->uploadFile
        //         ->where('hash', $item)
        //         ->pluck('id')
        //         ->toArray();
        // }

        // $newProduct->uploadFiles()->sync($uploadFileIds);    

        $fileId_array = [];

        foreach ($data['upload_file_hashs'] as $item) {
            $uploadFileIds = $this->uploadFile
                ->where('hash', $item)
                ->pluck('id')
                ->first();

            array_push($fileId_array, $uploadFileIds);
        }

        $newProduct->uploadFiles()->sync($fileId_array);

        $this->updateOrCreatePrice($newProduct->id, $data['prices']);
        return $newProduct;
    }

    public function getProductById(int $id): ? Product
    {
        return $this->product->find($id);
    }

    public function updateProductById(int $productId, array $data): bool
    {
        $product = $this->getProductById($productId);
        $isSuccess = $product->update($this->getProductData($data));
        if (!$isSuccess) {
            return false;
        }
        $product->tastes()->sync($data['taste_ids']);
        $product->materials()->sync($data['material_ids']);
        $product->symptoms()->sync($data['symptom_ids']);
        $product->keywords()->delete();
        if ($data['keyword_csv'] !== null) {
            $inSertData = [];
            foreach (explode(',', $data['keyword_csv']) as $key => $value) {
                $inSertData[] = [
                    'keyword' => $value,
                ];
            }
            $product->keywords()->createMany($inSertData);
        }

        // $uploadFileIds = $this->uploadFile
        //     ->where('hash', $data['upload_file_hashs'])
        //     ->pluck('id')
        //     ->toArray();
        // $product->uploadFiles()->sync($uploadFileIds);

        $fileId_array = [];

        foreach ($data['upload_file_hashs'] as $item) {
            $uploadFileIds = $this->uploadFile
                ->where('hash', $item)
                ->pluck('id')
                ->first();

            array_push($fileId_array, $uploadFileIds);
        }

        $product->uploadFiles()->sync($fileId_array);
        
        $this->updateOrCreatePrice($productId, $data['prices']);
        return true;
    }

    private function updateOrCreatePrice(int $productId, array $priceData): void
    {
        ProductPrice::where('product_id', $productId)
            ->whereNotIn('id', collect($priceData)->pluck('id')->toArray())
            ->delete();
        $priceData = collect($priceData)->sortBy('sort_order')->toArray();
        foreach ($priceData as $index => $price) {
            if (isset($price['id'])) {
                $this->updatePrice($price['id'], $price['capacity'], $price['price'], $index);
            } else {
                $this->createPrice($productId, $price['capacity'], $price['price'], $index);
            }
        }
    }

    private function createPrice(int $producId, string $capacity, int $price, int $sortOrder): ProductPrice
    {
        return $this->productPrice
            ->create([
                'product_id' => $producId,
                'capacity' => $capacity,
                'price' => $price,
                'sort_order' => $sortOrder,
                'include_tax' => Order::productIncludeTax($price),
            ]);
    }

    private function updatePrice(int $id, string $capacity, int $price, int $sortOrder): bool
    {
        $productPrice = $this->productPrice->find($id);
        $productPrice->capacity = $capacity;
        $productPrice->price = $price;
        $productPrice->sort_order = $sortOrder;
        $productPrice->include_tax = Order::productIncludeTax($price);
        return $productPrice->saveOrFail();
    }

    private function getProductData(array $data): array
    {
        return [
            'product_category_id' => $data['product_category_id'],
            'product_no' => $data['product_no'],
            'name1' => $data['name1'],
            'name2' => $data['name2'],
            'description' => $data['description'],
            'is_public' => $data['is_public'],
            'capacity' => $data['capacity'],
        ];
    }

    public function deleteProductById(int $id): bool
    {
        return $this->getProductById($id)->delete();
    }

    private function getProductSearchQuery($query, array $search)
    {
        $query = $query->select(['products.*']);
        if (isset($search['taste_ids'])) {
            $searchIds = explode(',', $search['taste_ids']);
            $query = $query->whereHas('tastes', function ($query) use ($searchIds) {
                $query->whereIn('tastes.id', $searchIds);
            });
        }
        if (isset($search['material_ids'])) {
            $searchIds = explode(',', $search['material_ids']);
            $query = $query->whereHas('materials', function ($query) use ($searchIds) {
                $query->whereIn('materials.id', $searchIds);
            });
        }
        if (isset($search['symptom_ids'])) {
            $searchIds = explode(',', $search['symptom_ids']);
            $query = $query->whereHas('symptoms', function ($query) use ($searchIds) {
                $query->whereIn('symptoms.id', $searchIds);
            });
        }
        if (isset($search['is_public'])) {
            $query = $query->where('is_public', $search['is_public']);
        }
        if (isset($search['not_product_ids'])) {
            $query = $query->whereNotIn('products.id', explode(',', $search['not_product_ids']));
        }
        if (isset($search['is_recommendation']) && $search['is_recommendation'] === '1') {
            $query = $query->leftJoin('product_recommendations', function ($join) {
                $join->on('product_recommendations.product_id', 'products.id');
            })
                ->orderBy('product_recommendations.id');
        }
        if (isset($search['recommendation_kind'])) {
            $kind = $search['recommendation_kind'];
            $query = $query->join('product_recommendations', function ($join) use ($kind) {
                $join->on('product_recommendations.product_id', 'products.id')
                    ->where('product_recommendations.kind', $kind);
            });
            if (!isset($search['order_by'])) {
                $query->orderBy('product_recommendations.id');
            }
        }
        // 人気順
        if (isset($search['order_by']) && $search['order_by'] === 'popularity_asc') {
            $query = $query->leftJoin('product_popularations', function ($join) {
                $join->on('product_popularations.product_id', 'products.id');
            })
                ->orderBy('product_popularations.id');
            // 値段順
        } elseif (isset($search['order_by']) && $search['order_by'] === 'price_asc') {
            $query = $query->join('product_prices', function ($join) {
                $join->on('product_prices.product_id', 'products.id');
            });
            $minProductPrices = ProductPrice::getMinPracticeId();
            $minProductPriceIds = collect($minProductPrices)->pluck('id')->toArray();
            $query = $query
                ->whereIn('product_prices.id', $minProductPriceIds)
                ->orderBy('product_prices.price');
            // id順
        } elseif (isset($search['order_by']) && $search['order_by'] === 'product_id_asc') {
            $query = $query->orderBy('products.id');
            // product_no順
        } elseif (isset($search['order_by']) && $search['order_by'] === 'product_no') {
            $query = $query->orderBy('products.product_no');
            // id順
        } else {
            $query = $query->orderBy('products.id');
        }
        return $query;
    }

    public function productPaginate(array $search = [])
    {
        $perPage = $this->getPerPage($search);
        $query = $this->product;
        return $perPage !== -1
            ? $this->getProductSearchQuery($query, $search)
                ->paginate($perPage)
            : $this->getProductSearchQuery($query, $search)
                ->get();
    }

    public function productExists(int $id): bool
    {
        return $this->getProductById($id) !== null;
    }

    public function getProductPriceByProductPriceId(int $productPriceId): ? ProductPrice
    {
        return $this->productPrice->find($productPriceId);
    }

    public function createCategory(
        string $name,
        string $seriesName
    ): ProductCategory
    {
        return $this->productCategory->create([
            'name' => $name,
            'series_name' => $seriesName,
            'sort_order' => $this->getMaxCortOrder() + 1,
        ]);
    }

    private function getMaxCortOrder(): int
    {
        $productCategory = $this->productCategory->orderBy('sort_order', 'desc')->first();
        if (is_null($productCategory)) {
            return 0;
        }
        return $productCategory->sort_order;
    }

    public function getCategoryById(int $id): ? ProductCategory
    {
        return $this->productCategory->find($id);
    }

    public function getAllCategorys(): Collection
    {
        return $this->productCategory->get();
    }

    public function updateCategory(
        int $id,
        string $name,
        string $seriesName
    ): bool
    {
        return $this->productCategory
            ->find($id)
            ->update([
                'name' => $name,
                'series_name' => $seriesName,
            ]);
    }

    public function updateSortOrder(): void
    {
        $categories = $this->productCategory->get();
        if ($categories->count() === 0) {
            return;
        }
        foreach ($categories as $index => $category) {
            $category->sort_order = $index + 1;
            $category->save();
        }
    }

    public function deleteCategoryById(int $id): bool
    {
        return $this->productCategory->destroy($id);
    }

    public function createRecommendation(array $productIds, int $kind): void
    {
        $this->productRecommendation
            ->where('kind', $kind)
            ->forceDelete();
        if (count($productIds) === 0) {
            return;
        }
        foreach ($productIds as $index => $productId) {
            $productRecommendation = new ProductRecommendation();
            $productRecommendation->product_id = $productId;
            $productRecommendation->sort_order = $index;
            $productRecommendation->kind = $kind;
            $productRecommendation->saveOrFail();
        }
    }

    public function getAllProductRecommendations(int $kind): Collection
    {
        return $this->productRecommendation
            ->where('kind', $kind)
            ->get();
    }
}