<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class EmployeeModel extends Model
{
    use ModelTrait;

    protected $table = 'employees';

    protected $returnType = 'object';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'name',
        'dob',
        'gender',
        'email',
        'phone_number',
        'hire_date',
        'department_id',
    ];

    public function bulkInsert($data)
    {
        return $this->db->table($this->table)->insertBatch($data);
    }
}
