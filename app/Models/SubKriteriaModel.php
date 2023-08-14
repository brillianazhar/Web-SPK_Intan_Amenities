<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table = 'sub_kriteria';
    protected $allowedFields = ['id_kriteria', 'nama_sub_kriteria', 'value'];

    public function getSubKriteria($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'asc')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getSubJoinKriteria($keyword = false)
    {
        if ($keyword == false) {
            $builder = $this->table('sub_kriteria');
            $builder->select('kriteria.nama_kriteria, sub_kriteria.*');
            $builder->join('kriteria', 'kriteria.id = id_kriteria');
        } else {
            $builder = $this->table('sub_kriteria');
            $builder->select('kriteria.nama_kriteria, sub_kriteria.*');
            $builder->join('kriteria', 'kriteria.id = id_kriteria');
            $builder->like('nama_sub_kriteria', $keyword);
            $builder->orLike('value', $keyword);
        }

        return $builder;
    }

    // public function search($keyword)
    // {
    //     $builder = $this->table('sub_kriteria');
    //     $builder->select('kriteria.nama_kriteria, sub_kriteria.*');
    //     $builder->join('kriteria', 'kriteria.id = id_kriteria');
    //     $builder->like('nama_sub_kriteria', $keyword);
    //     $builder->orLike('value', $keyword);

    //     return $builder;
    // }

    // public function search($keyword)
    // {
    //     // $builder = $this->table('kriteria');
    //     // $builder->like('nama_kriteria', $keyword);
    //     // return $builder;
    //     return $this->table('kriteria')->like('nama_kriteria', $keyword)->orLike('jenis_kriteria', $keyword);
    // }
}
