<?php

namespace App\Domains;

use App\Models\Taste;
use Illuminate\Database\Eloquent\Collection;

class TasteDomain extends BaseDomain
{
    private $taste;

    public function __construct(
        Taste $taste
    ) {
        $this->taste = $taste;
    }

    public function createTaste(
        string $name,
        string $categoryNo
    ): Taste {
        return $this->taste->create([
            'name' => $name,
            'category_no' => $categoryNo,
            'sort_order' => $this->getMaxCortOrder() + 1,
        ]);
    }

    private function getMaxCortOrder(): int
    {
        $taste = $this->taste->orderBy('sort_order', 'desc')->first();
        if (is_null($taste)) {
            return 0;
        }
        return $taste->sort_order;
    }

    public function getTasteById(int $id): ?Taste
    {
        return $this->taste->find($id);
    }

    public function getAllTastes(): Collection
    {
        return $this->taste->get();
    }

    public function updateTaste(
        int $id,
        string $name,
        string $categoryNo
    ): bool {
        return $this->taste
            ->find($id)
            ->update([
                'name' => $name,
                'category_no' => $categoryNo,
            ]);
    }

    public function updateSortOrder(): void
    {
        $tastes = $this->taste->get();
        if ($tastes->count() === 0) {
            return;
        }
        foreach ($tastes as $index => $taste) {
            $taste->sort_order = $index  + 1;
            $taste->save();
        }
    }

    public function deleteTasteById(int $id): bool
    {
        return $this->taste->destroy($id);
    }
}
