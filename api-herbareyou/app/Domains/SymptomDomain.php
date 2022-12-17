<?php

namespace App\Domains;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Collection;

class SymptomDomain extends BaseDomain
{
    private $symptom;

    public function __construct(
        Symptom $symptom
    ) {
        $this->symptom = $symptom;
    }

    public function createSymptom(
        string $name,
        string $categoryNo
    ): Symptom {
        return $this->symptom->create([
            'name' => $name,
            'category_no' => $categoryNo,
            'sort_order' => $this->getMaxCortOrder() + 1,
        ]);
    }

    private function getMaxCortOrder(): int
    {
        $symptom = $this->symptom->orderBy('sort_order', 'desc')->first();
        if (is_null($symptom)) {
            return 0;
        }
        return $symptom->sort_order;
    }

    public function getSymptomById(int $id): ?Symptom
    {
        return $this->symptom->find($id);
    }

    public function getAllSymptoms(): Collection
    {
        return $this->symptom->get();
    }

    public function updateSymptom(
        int $id,
        string $name,
        string $categoryNo
    ): bool {
        return $this->symptom
            ->find($id)
            ->update([
                'name' => $name,
                'category_no' => $categoryNo,
            ]);
    }

    public function updateSortOrder(): void
    {
        $symptoms = $this->symptom->get();
        if ($symptoms->count() === 0) {
            return;
        }
        foreach ($symptoms as $index => $symptom) {
            $symptom->sort_order = $index  + 1;
            $symptom->save();
        }
    }

    public function deleteSymptomById(int $id): bool
    {
        return $this->symptom->destroy($id);
    }
}
