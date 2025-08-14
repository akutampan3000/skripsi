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

    public function getUserByUsernameOrEmail($identifier)
    {
        return $this->where('email', $identifier)
                    ->orWhere('username', $identifier)
                    ->first();
    }

    public function getTotalUsers()
    {
        return $this->countAll();
    }

    public function updateUser($id, $data)
    {
        // Hash password if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Remove password from data if not provided
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }

    public function isEmailExistsForOtherUser($email, $userId)
    {
        return $this->where('email', $email)
                    ->where('id !=', $userId)
                    ->first() !== null;
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }
}