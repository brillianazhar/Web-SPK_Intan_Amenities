<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $allowedFields = ['nama_kriteria', 'jenis_kriteria', 'bobot', 'bobot_ternormalisasi'];

    public function getKriteria($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'asc')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        // $builder = $this->table('kriteria');
        // $builder->like('nama_kriteria', $keyword);
        // return $builder;
        return $this->table('kriteria')->like('nama_kriteria', $keyword)->orLike('jenis_kriteria', $keyword);
    }
}
