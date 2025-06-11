<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'is_admin'];
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }
        
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getTotalUsers()
    {
        return $this->countAll();
    }
}