<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $allowedFields = ['kode_alternatif', 'nama_alternatif', 'vektor_s', 'vektor_v'];

    public function getAlternatif($id = false)
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
        return $this->table('alternatif')->like('kode_alternatif', $keyword)->orLike('nama_alternatif', $keyword);
    }
}
