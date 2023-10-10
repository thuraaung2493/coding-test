<?php

namespace App\Validation;

use App\Models\UserModel;

class CustomRules
{
    public function validateUser(string $str = null, string $fields, array $data): bool
    {
        $model = \model(UserModel::class);

        $user = $model->where('email', $data['email'])
            ->first();

        if (!$user) return false;

        return password_verify($data['password'], $user->password);
    }
}
