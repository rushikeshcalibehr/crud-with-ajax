<?php
namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email'];

    public function insert_data($data) {
        $result = $this->insert($data);

        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }
}