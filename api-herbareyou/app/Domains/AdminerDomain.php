<?php

namespace App\Domains;

use App\Models\Adminer;

class AdminerDomain extends BaseDomain
{
    private $adminer;

    public function __construct(
        Adminer $adminer
    ) {
        $this->adminer = $adminer;
    }

    // public function createAdminer(array $data): ?Adminer
    // {
    //     $data['password'] = $this->passwordHash($data['password']);
    //     if(!$adminer = $this->adminer->create($data)) return NULL;
    //     return $adminer;
    // }

    public function getAdminerbyId(int $id): ?Adminer
    {
        return $this->adminer->find($id);
    }

    public function getAdminerbyEmail(string $email): ?Adminer
    {
        return $this->adminer
            ->where('email', $email)
            ->first();
    }

    // private function passwordHash(string $password): string
    // {
    //     return password_hash($password, PASSWORD_DEFAULT);
    // }

    public function passwordVerify(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }
}
