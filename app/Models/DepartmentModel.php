<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';

    protected $returnType = 'object';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'name',
    ];
}
