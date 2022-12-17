<?php

namespace App\Domains;

use App\Enums\IsDelete;
use App\Models\User;
use App\Models\UserDeliveryLocation;
use App\Models\UserResetPassword;
use Carbon\Carbon;

class UserDomain extends BaseDomain
{
    private $user;
    private $userDeliveryLocation;
    private $userResetPassword;

    public function __construct(
        User $user,
        UserDeliveryLocation $userDeliveryLocation,
        UserResetPassword $userResetPassword
    ) {
        $this->user = $user;
        $this->userDeliveryLocation = $userDeliveryLocation;
        $this->userResetPassword = $userResetPassword;
    }

    public function createUser(array $data): ?User
    {
        $data['password'] = $this->passwordHash($data['password']);
        return $this->user->create($data);
    }

    public function userPaginate(array $search = [])
    {
        $perPage = $this->getPerPage($search);
        $query = $this->user;
        return $perPage !== -1
            ? $this->getUserSearchQuery($query, $search)
                ->paginate($perPage)
            : $this->getUserSearchQuery($query, $search)
                ->get();
    }

    private function getUserSearchQuery($query, array $search)
    {
        if (isset($search['user_id'])) {
            $query = $query->where('id', $search['user_id']);
        }
        if (isset($search['order_by'])) {
            $query = $query->orderBy($search['order_by']);
        } elseif (isset($search['order_by_raw'])) {
            $query = $query->orderByRaw($search['order_by_raw']);
        } else {
            $query = $query->orderBy('id');
        }
        return $query;
    }

    public function getUserById(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function updateUserById(int $id, array $data): bool
    {
        if (!empty($data['password'])) {
            $data['password'] = $this->passwordHash($data['password']);
        }
        return $this->getUserById($id)->update($data);
    }

    public function updatePasswordById(int $id, string $password): bool
    {
        return $this->getUserById($id)->update([
            'password' => $this->passwordHash($password),
        ]);
    }

    public function deleteUserById(int $id): bool
    {
        return $this->getUserById($id)->delete();
    }

    public function canUseEmailOfCreate(string $email): bool
    {
        $userRow = $this->getUserByEmail($email);
        return is_null($userRow);
    }

    public function canUseEmailOfUpdate(int $id, string $email): bool
    {
        $userRow = $this->getUserByEmail($email);
        if (is_null($userRow)) {
            return true;
        }
        return $userRow->id === $id;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->user
            ->where('email', $email)
            ->first();
    }

    public function existsUser(int $id): bool
    {
        $userRow = $this->user->find($id);
        return !is_null($userRow);
    }

    private function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function passwordVerify(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }

    public function updateOrCreateDeliveryLocationByUserId(int $userId, array $data): void
    {
        $userDeliveryLocationRow = $this->getDeliveryLocationByUserId($userId);
        if (is_null($userDeliveryLocationRow)) {
            $this->createDeliveryLocationByUserId($userId, $data);
            return;
        }
        $this->updateDeliveryLocationByUserId($userId, $data);
    }

    private function createDeliveryLocationByUserId(int $userId, array $data): ?UserDeliveryLocation
    {
        $data['user_id'] = $userId;
        return $this->userDeliveryLocation->create($data);
    }

    private function updateDeliveryLocationByUserId(int $userId, array $data): bool
    {
        return $this->getDeliveryLocationByUserId($userId)->update($data);
    }

    public function getDeliveryLocationByUserId(int $userId): ?UserDeliveryLocation
    {
        return $this->userDeliveryLocation
            ->where('user_id', $userId)
            ->first();
    }

    public function createResetPassword(int $userId): UserResetPassword
    {
        return $this->userResetPassword->create([
            'user_id' => $userId,
            'code' => $this->getGenRandomStr(10),
            'expired_at' => (new Carbon('+1day'))->format('Y-m-d H:i:s')
        ]);
    }

    public function getResetPasswordByCode(string $code): ?UserResetPassword
    {
        return $this->userResetPassword
            ->where('code', $code)
            ->first();
    }

    public function deleteResetPasswordsByUserId(int $userId): void
    {
        $resetPasswordRows = $this->userResetPassword->where('user_id', $userId)->get();
        foreach ($resetPasswordRows as $resetPasswordRow) {
            $resetPasswordRow->is_delete = IsDelete::IS_DELETE;
            $resetPasswordRow->deleted_at = now();
            $resetPasswordRow->save();
        }
    }

    public function createDeliveryLocationByUser(User $user): UserDeliveryLocation
    {
        $columns = [
            'first_name',
            'last_name',
            'first_name_kana',
            'last_name_kana',
            'zip',
            'address1',
            'tel1',
        ];
        $userDeliveryLocation = new UserDeliveryLocation();
        $userDeliveryLocation->user_id = $user->id;
        foreach($columns as $column) {
            $userDeliveryLocation->$column = $user->$column;
        }
        $userDeliveryLocation->saveOrFail();
        return $userDeliveryLocation;
    }
}
