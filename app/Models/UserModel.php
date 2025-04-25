<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    
}