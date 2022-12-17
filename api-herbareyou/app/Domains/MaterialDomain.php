<?php

namespace App\Domains;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;

class MaterialDomain extends BaseDomain
{
    private $material;

    public function __construct(
        Material $material
    ) {
        $this->material = $material;
    }

    public function createMaterial(
        string $name,
        string $categoryNo
    ): Material {
        return $this->material->create([
            'name' => $name,
            'category_no' => $categoryNo,
            'sort_order' => $this->getMaxCortOrder() + 1,
        ]);
    }

    private function getMaxCortOrder(): int
    {
        $material = $this->material->orderBy('sort_order', 'desc')->first();
        if (is_null($material)) {
            return 0;
        }
        return $material->sort_order;
    }

    public function getMaterialById(int $id): ?Material
    {
        return $this->material->find($id);
    }

    public function getAllMaterials(): Collection
    {
        return $this->material->get();
    }

    public function updateMaterial(
        int $id,
        string $name,
        string $categoryNo
    ): bool {
        return $this->material
            ->find($id)
            ->update([
                'name' => $name,
                'category_no' => $categoryNo,
            ]);
    }

    public function updateSortOrder(): void
    {
        $materials = $this->material->get();
        if ($materials->count() === 0) {
            return;
        }
        foreach ($materials as $index => $material) {
            $material->sort_order = $index  + 1;
            $material->save();
        }
    }

    public function deleteMaterialById(int $id): bool
    {
        return $this->material->destroy($id);
    }
}
