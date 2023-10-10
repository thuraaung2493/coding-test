<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $returnType = 'object';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'name',
        'email',
        'password',
    ];
}
