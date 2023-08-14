<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = 'true';
    protected $allowedFields = ['name', 'email', 'image', 'password', 'role_id', 'is_active', 'date_created'];
    protected $createdField = 'date_created';
    protected $updatedField = 'date_updated';
    protected $dateFormat = 'int';

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->where('role_id', 2)->orderBy('id', 'desc')->findAll();
        }

        return $this->where('id' == $id)->first();
    }

    public function search($keyword)
    {
        // $builder = $this->table('kriteria');
        // $builder->like('nama_kriteria', $keyword);
        // return $builder;
        return $this->table('alternatif')->like('name', $keyword)->orLike('email', $keyword);
    }
}
