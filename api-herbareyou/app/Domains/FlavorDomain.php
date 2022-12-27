<?php

namespace App\Domains;

use App\Models\Flavor;
use Illuminate\Database\Eloquent\Collection;

class FlavorDomain extends BaseDomain
{
    private $flavor;

    public function __construct(
        Flavor $flavor
    ) {
        $this->flavor = $flavor;
    }

    public function createFlavor(
        string $name,
        string $categoryNo
    ): Flavor {
        return $this->flavor->create([
            'name' => $name,
            'category_no' => $categoryNo,
            'sort_order' => $this->getMaxCortOrder() + 1,
        ]);
    }

    private function getMaxCortOrder(): int
    {
        $flavor = $this->flavor->orderBy('sort_order', 'desc')->first();
        if (is_null($flavor)) {
            return 0;
        }
        return $flavor->sort_order;
    }

    public function getFlavorById(int $id): ?Flavor
    {
        return $this->flavor->find($id);
    }

    public function getAllFlavors(): Collection
    {
        return $this->flavor->get();
    }

    public function updateFlavor(
        int $id,
        string $name,
        string $categoryNo
    ): bool {
        return $this->flavor
            ->find($id)
            ->update([
                'name' => $name,
                'category_no' => $categoryNo,
            ]);
    }

    public function updateSortOrder(): void
    {
        $flavors = $this->flavor->get();
        if ($flavors->count() === 0) {
            return;
        }
        foreach ($flavors as $index => $flavor) {
            $flavor->sort_order = $index  + 1;
            $flavor->save();
        }
    }

    public function deleteFlavorById(int $id): bool
    {
        return $this->flavor->destroy($id);
    }
}
