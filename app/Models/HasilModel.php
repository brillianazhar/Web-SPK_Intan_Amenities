<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $allowedFields = ['id_alternatif', 'id_kriteria', 'nilai', 'nilai_ternormalisasi'];

    public function getHasil($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'asc')->findAll();
        }

        return $this->where(['id_alternatif' => $id])->findAll();
    }

    public function joinAlternatif()
    {
        $builder = $this->table('hasil');
        $builder->select('*');
        $builder->join('alternatif', 'alternatif.id = hasil.id_alternatif');
        $query = $builder->findAll();

        return $query;
    }
}
