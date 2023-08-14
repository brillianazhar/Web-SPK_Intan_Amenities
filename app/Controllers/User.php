<?php

namespace App\Controllers;

use CodeIgniter\CLI\Console;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\HasilModel;

use Dompdf\Dompdf;

class User extends BaseController
{

    protected $kriteriaModel;
    protected $subKriteriaModel;
    protected $alternatifModel;
    protected $hasilModel;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->kriteriaModel = new KriteriaModel();
        $this->subKriteriaModel = new SubKriteriaModel();
        $this->alternatifModel = new AlternatifModel();
        $this->hasilModel = new HasilModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('user/index', $data);
    }

    public function data_alternatif()
    {

        $alternatif = $this->alternatifModel->getAlternatif();

        $currentPage = $this->request->getVar('page_alternatif') ? $this->request->getVar('page_alternatif') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_alternatif = $this->alternatifModel->search($keyword);
        } else {
            $data_alternatif = $this->alternatifModel;
        }

        $data = [
            'title' => 'Data Alternatif',
            'currentPage' => $currentPage,
            'alternatif' => $data_alternatif->paginate(5, 'alternatif'),
            'pager' => $this->alternatifModel->pager
        ];

        return view('user/data_alternatif', $data);
    }

    public function data_kriteria()
    {

        $kriteria = $this->kriteriaModel->getKriteria();

        $currentPage = $this->request->getVar('page_kriteria') ? $this->request->getVar('page_kriteria') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_kriteria = $this->kriteriaModel->search($keyword);
        } else {
            $data_kriteria = $this->kriteriaModel;
        }

        $data = [
            'title' => 'Data Kriteria',
            'currentPage' => $currentPage,
            'kriteria' => $data_kriteria->paginate(5, 'kriteria'),
            'pager' => $this->kriteriaModel->pager
        ];

        return view('user/data_kriteria', $data);
    }

    public function tambah_kriteria_index()
    {
        $data = [
            'title' => 'Tambah Kriteria'
        ];

        return view('user/tambah_kriteria', $data);
    }

    public function addKriteria()
    {
        // $data = [
        //     "nama_kriteria" => htmlspecialchars($this->request->getVar("namakr"), true),
        //     "jenis_kriteria" => htmlspecialchars($this->request->getVar("jeniskr"), true),
        //     "bobot" => htmlspecialchars($this->request->getVar("bobotkr"), true)
        // ];

        // $this->kriteriaModel->save($data);

        // return redirect()->route('data_kriteria');

        $bnormalisasi_before = $this->kriteriaModel->select('sum(bobot) as bobotn')->first();
        $bnormalisasi_after = $bnormalisasi_before['bobotn'] + $this->request->getVar("bobotkr");
        $bnormalisasi_total = $this->request->getVar("bobotkr") / $bnormalisasi_after;
        $data = [
            "nama_kriteria" => htmlspecialchars($this->request->getVar("namakr"), true),
            "jenis_kriteria" => htmlspecialchars($this->request->getVar("jeniskr"), true),
            "bobot" => htmlspecialchars($this->request->getVar("bobotkr"), true),
            "bobot_ternormalisasi" => $bnormalisasi_total
        ];

        $this->kriteriaModel->save($data);

        $kriteria = $this->kriteriaModel->getKriteria();

        foreach ($kriteria as $k) {
            $bobotnall_before = $this->kriteriaModel->select('sum(bobot) as bobotn')->first();
            $bobotnall_total = $k['bobot'] / $bobotnall_before['bobotn'];

            $data2 = [
                "id" => $k['id'],
                "bobot_ternormalisasi" => $bobotnall_total
            ];

            $this->kriteriaModel->save($data2);
        }

        return redirect()->route('data_kriteria');
    }

    public function edit_kriteria_index($id)
    {

        $data = [
            'title' => 'Edit Kriteria',
            'kriteria' => $this->kriteriaModel->getKriteria($id)
        ];

        return view('user/edit_kriteria', $data);
    }

    public function editKriteria($id)
    {

        $bnormalisasi_before = $this->kriteriaModel->select('sum(bobot) as bobotn')->first();
        $bnormalisasi_after = $bnormalisasi_before['bobotn'] + $this->request->getVar("bobotkr");
        $bnormalisasi_total = $this->request->getVar("bobotkr") / $bnormalisasi_after;

        $data = [
            "id" => $id,
            "nama_kriteria" => htmlspecialchars($this->request->getVar("namakr"), true),
            "jenis_kriteria" => htmlspecialchars($this->request->getVar("jeniskr"), true),
            "bobot" => htmlspecialchars($this->request->getVar("bobotkr"), true),
            "bobot_ternormalisasi" => $bnormalisasi_total
        ];

        $this->kriteriaModel->save($data);

        $kriteria = $this->kriteriaModel->getKriteria();

        foreach ($kriteria as $k) {
            $bobotnall_before = $this->kriteriaModel->select('sum(bobot) as bobotn')->first();
            $bobotnall_total = $k['bobot'] / $bobotnall_before['bobotn'];

            $data2 = [
                "id" => $k['id'],
                "bobot_ternormalisasi" => $bobotnall_total
            ];

            $this->kriteriaModel->save($data2);
        }

        $results = $this->kriteriaModel->getKriteria($id);
        $results3 = $this->hasilModel->where("id_kriteria", $id)->findAll();

        foreach ($results3 as $r) {
            $data2 = [
                "id" => $r['id'],
            ];

            if ($results['jenis_kriteria'] == "benefit") {
                $n_normal = ($r['nilai']) ** ($results['bobot_ternormalisasi']);
            } else if ($results['jenis_kriteria'] == "cost") {
                $n_normal = ($r['nilai']) ** (- ($results['bobot_ternormalisasi']));
            }
            $data2["nilai_ternormalisasi"] = $n_normal;

            $this->hasilModel->save($data2);
        }

        return redirect()->route('data_kriteria');
    }

    public function deleteKriteria($id)
    {
        $this->kriteriaModel->delete($id);
        $this->hasilModel->where('id_kriteria', $id)->delete();
        $this->subKriteriaModel->where('id_kriteria', $id)->delete();

        $kriteria = $this->kriteriaModel->getKriteria();

        foreach ($kriteria as $k) {
            $bobotnall_before = $this->kriteriaModel->select('sum(bobot) as bobotn')->first();
            $bobotnall_total = $k['bobot'] / $bobotnall_before['bobotn'];

            $data2 = [
                "id" => $k['id'],
                "bobot_ternormalisasi" => $bobotnall_total
            ];

            $this->kriteriaModel->save($data2);
        }

        return redirect()->to('/data_kriteria');
    }

    public function cekNamaKriteria()
    {
        $data = $_POST['namakr'];
        $query   = $this->db->query("SELECT * FROM kriteria WHERE nama_kriteria = '" . $data . "'");
        $results = $query->getResult();

        if (count($results) > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function cekNamaEditKriteria($id)
    {
        $data = $_POST['namakr'];
        $query   = $this->db->query("SELECT * FROM kriteria WHERE nama_kriteria = '" . $data . "'");
        $results = $query->getRowArray();
        $query2   = $this->db->query("SELECT * FROM kriteria WHERE id = $id");
        $results2 = $query2->getRowArray();

        if ($results) {
            if ($data == $results2['nama_kriteria']) {
                $valid = "true";
            } else {
                $valid = "false";
            }
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function data_sub_kriteria()
    {
        $currentPage = $this->request->getVar('page_subKriteria') ? $this->request->getVar('page_subKriteria') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $data_alternatif = $this->subKriteriaModel->getSubJoinKriteria($keyword);
        } else {
            $data_alternatif = $this->subKriteriaModel->getSubJoinKriteria();
        }

        $data = [
            'title' => "Data Sub Kriteria",
            'currentPage' => $currentPage,
            'subKriteria' => $data_alternatif->paginate(8, 'subKriteria'),
            'pager' => $this->subKriteriaModel->pager
            // 'subKriteria' => $this->subKriteriaModel->getSubJoinKriteria()
        ];
        return view("user/data_subKriteria", $data);
    }

    public function tambah_sub_kriteria_index()
    {
        $data = [
            'title' => "Tambah Sub Kriteria",
            'kriteria' => $this->kriteriaModel->findAll()
        ];
        return view("user/tambah_sub_kriteria", $data);
    }

    public function addSubKriteria()
    {
        $data = [
            "id_kriteria" => htmlspecialchars($this->request->getVar("namakr"), true),
            "nama_sub_kriteria" => htmlspecialchars($this->request->getVar("namaskr"), true),
            "value" => htmlspecialchars($this->request->getVar("nilaiskr"), true),
        ];

        $this->subKriteriaModel->save($data);

        return redirect()->route('data_sub_kriteria');
    }

    public function cekNamaSubKriteria()
    {
        $data1 = $_POST['namaskr'];
        $query   = $this->db->query("SELECT * FROM sub_kriteria WHERE nama_sub_kriteria = '" . $data1 . "'");
        $results = $query->getResultArray();

        if (count($results) > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function cekNamaEditSubKriteria($id)
    {
        $data = $_POST['namaskr'];
        $query   = $this->db->query("SELECT * FROM sub_kriteria WHERE nama_sub_kriteria = '" . $data . "'");
        $results = $query->getRowArray();
        $query2   = $this->db->query("SELECT * FROM sub_kriteria WHERE id = $id");
        $results2 = $query2->getRowArray();

        if ($results) {
            if ($data == $results2['nama_sub_kriteria']) {
                $valid = "true";
            } else {
                $valid = "false";
            }
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function edit_sub_kriteria_index($id)
    {
        $data = [
            'title' => 'Edit Sub Kriteria',
            'subKriteria' => $this->subKriteriaModel->getSubKriteria($id),
            'kriteria' => $this->kriteriaModel->findAll()
        ];

        return view('user/edit_sub_kriteria', $data);
    }

    public function editSubKriteria($id)
    {
        $data = [
            "id" => $id,
            "id_kriteria" => htmlspecialchars($this->request->getVar("namakr"), true),
            "nama_sub_kriteria" => htmlspecialchars($this->request->getVar("namaskr"), true),
            "value" => htmlspecialchars($this->request->getVar("nilaiskr"), true),
        ];

        foreach ($this->subKriteriaModel->where('id', $id)->findAll() as $sk) {
            $array = [
                'id_kriteria' => $sk['id_kriteria'],
                'nilai' => $sk['value']
            ];
            foreach ($this->hasilModel->where($array)->findAll() as $h) {
                $dataHasil = [
                    'id' => $h['id'],
                    'nilai' => htmlspecialchars($this->request->getVar("nilaiskr"), true)
                ];

                $results = $this->kriteriaModel->getKriteria($h['id_kriteria']);
                if ($results['jenis_kriteria'] == "benefit") {
                    $n_normal = ($dataHasil['nilai']) ** ($results['bobot_ternormalisasi']);
                } else if ($results['jenis_kriteria'] == "cost") {
                    $n_normal = ($dataHasil['nilai']) ** (- ($results['bobot_ternormalisasi']));
                }

                $dataHasil["nilai_ternormalisasi"] = $n_normal;
                $this->hasilModel->save($dataHasil);
            }
        }

        $this->subKriteriaModel->save($data);

        return redirect()->route('data_sub_kriteria');
    }

    public function deleteSubKriteria($id)
    {
        $this->subKriteriaModel->delete($id);

        return redirect()->to('/data_sub_kriteria');
    }

    public function tambah_alternatif_index()
    {
        $kriteria = $this->kriteriaModel->getKriteria();

        $data = [
            'title' => 'Tambah Alternatif',
            'kriteria' => $kriteria,
            'subKriteria' => $this->subKriteriaModel->findAll()
        ];

        return view('user/tambah_alternatif', $data);
    }

    public function cekNamaAlternatif()
    {
        $data = $_POST['namaalt'];
        $query   = $this->db->query("SELECT * FROM alternatif WHERE nama_alternatif = '" . $data . "'");
        $results = $query->getResult();

        if (count($results) > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function cekNamaEditAlternatif($id)
    {
        $data = $_POST['namaalt'];
        $query   = $this->db->query("SELECT * FROM alternatif WHERE nama_alternatif = '" . $data . "'");
        $results = $query->getResult();
        $query2   = $this->db->query("SELECT * FROM alternatif WHERE id = $id");
        $results2 = $query2->getRowArray();

        if ($results) {
            if ($data == $results2['nama_alternatif']) {
                $valid = "true";
            } else {
                $valid = "false";
            }
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function cekKodeAlternatif()
    {
        $data = $_POST['kodealt'];
        $query   = $this->db->query("SELECT * FROM alternatif WHERE kode_alternatif = '" . $data . "'");
        $results = $query->getResult();

        if (count($results) > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function cekKodeEditAlternatif($id)
    {
        $data = $_POST['kodealt'];
        $query   = $this->db->query("SELECT * FROM alternatif WHERE kode_alternatif = '" . $data . "'");
        $results = $query->getResult();
        $query2   = $this->db->query("SELECT * FROM alternatif WHERE id = $id");
        $results2 = $query2->getRowArray();

        if ($results) {
            if ($data == $results2['kode_alternatif']) {
                $valid = "true";
            } else {
                $valid = "false";
            }
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function addAlternatif()
    {

        $data = [
            "nama_alternatif" => htmlspecialchars($this->request->getVar("namaalt"), true),
            "kode_alternatif" => htmlspecialchars($this->request->getVar("kodealt"), true),
        ];
        $this->alternatifModel->save($data);

        $query   = $this->db->query("SELECT * FROM kriteria");
        $results = $query->getResultArray();

        $inputnama = $this->request->getVar("namaalt");
        $query2   = $this->db->query("SELECT * FROM alternatif WHERE nama_alternatif = '" . $inputnama . "'");
        $results2 = $query2->getRowArray();

        foreach ($results as $r) {
            $data2 = [
                "id_alternatif" => $results2['id'],
                "id_kriteria" => $r['id'],
                "nilai" => htmlspecialchars($this->request->getVar($r['id']), true),
            ];

            if ($r['jenis_kriteria'] == "benefit") {
                $n_normal = ($data2['nilai']) ** ($r['bobot_ternormalisasi']);
            } else if ($r['jenis_kriteria'] == "cost") {
                $n_normal = ($data2['nilai']) ** (- ($r['bobot_ternormalisasi']));
            }
            $data2["nilai_ternormalisasi"] = $n_normal;

            $this->hasilModel->save($data2);
        }

        return redirect()->route('data_alternatif');
    }

    public function edit_alternatif_index($id)
    {

        $data = [
            'title' => 'Edit Alternatif',
            'alternatif' => $this->alternatifModel->getAlternatif($id),
            'kriteria' => $this->kriteriaModel->getKriteria(),
        ];

        return view('user/edit_alternatif', $data);
    }

    public function editAlternatif($id)
    {
        $data = [
            "id" => $id,
            "nama_alternatif" => htmlspecialchars($this->request->getVar("namaalt"), true),
            "kode_alternatif" => htmlspecialchars($this->request->getVar("kodealt"), true),
        ];

        $this->alternatifModel->save($data);

        $query   = $this->db->query("SELECT * FROM kriteria");
        $results = $query->getResultArray();

        $inputnama = $this->request->getVar("namaalt");
        $query2   = $this->db->query("SELECT * FROM alternatif WHERE nama_alternatif = '" . $inputnama . "'");
        $results2 = $query2->getRowArray();

        foreach ($results as $r) {
            $query3   = $this->db->query("SELECT * FROM hasil WHERE id_alternatif = $id");
            $results3 = $query3->getResultArray();

            if ($results3) {
                $query4   = $this->db->query("SELECT * FROM hasil WHERE id_alternatif = $id AND id_kriteria = '" . $r['id'] . "'");
                $results4 = $query4->getRowArray();
                if ($results4) {
                    $data3 = [
                        "id" => $results4['id'],
                        "id_alternatif" => $results2['id'],
                        "id_kriteria" => $r['id'],
                        "nilai" => htmlspecialchars($this->request->getVar($r['id']), true),
                    ];

                    if ($r['jenis_kriteria'] == "benefit") {
                        $n_normal = ($data3['nilai']) ** ($r['bobot_ternormalisasi']);
                    } else if ($r['jenis_kriteria'] == "cost") {
                        $n_normal = ($data3['nilai']) ** (- ($r['bobot_ternormalisasi']));
                    }
                    $data3["nilai_ternormalisasi"] = $n_normal;

                    $this->hasilModel->save($data3);
                } else {
                    $data4 = [
                        "id_alternatif" => $results2['id'],
                        "id_kriteria" => $r['id'],
                        "nilai" => htmlspecialchars($this->request->getVar($r['id']), true),
                    ];

                    if ($r['jenis_kriteria'] == "benefit") {
                        $n_normal = ($data4['nilai']) ** ($r['bobot_ternormalisasi']);
                    } else if ($r['jenis_kriteria'] == "cost") {
                        $n_normal = ($data4['nilai']) ** (- ($r['bobot_ternormalisasi']));
                    }
                    $data4["nilai_ternormalisasi"] = $n_normal;

                    $this->hasilModel->save($data4);
                }
            } else {
                $data2 = [
                    "id_alternatif" => $results2['id'],
                    "id_kriteria" => $r['id'],
                    "nilai" => htmlspecialchars($this->request->getVar($r['id']), true),
                ];

                if ($r['jenis_kriteria'] == "benefit") {
                    $n_normal = ($data2['nilai']) ** ($r['bobot_ternormalisasi']);
                } else if ($r['jenis_kriteria'] == "cost") {
                    $n_normal = ($data2['nilai']) ** (- ($r['bobot_ternormalisasi']));
                }
                $data2["nilai_ternormalisasi"] = $n_normal;

                $this->hasilModel->save($data2);
            }
        }

        return redirect()->route('data_alternatif');
    }

    public function deleteAlternatif($id)
    {
        $this->alternatifModel->delete($id);

        $this->hasilModel->where('id_alternatif', $id)->delete();

        return redirect()->to('/data_alternatif');
    }

    public function hasil()
    {
        if ($this->hasilModel->findAll()) {
            foreach ($this->alternatifModel->getAlternatif() as $a) {
                $vektorS = 1;
                //Hitung Vektor S
                $id_alt = $a['id'];
                foreach ($this->kriteriaModel->getKriteria() as $k) {
                    $id_kr = $k['id'];
                    $query   = $this->db->query("SELECT * FROM hasil WHERE id_alternatif = $id_alt AND id_kriteria = $id_kr");
                    $results = $query->getRowArray();
                    if ($results) {
                        $vektorS = $vektorS * $results['nilai_ternormalisasi'];
                    } else {
                        $nmALT = $this->alternatifModel->getAlternatif($id_alt);
                        $nmKR = $this->kriteriaModel->getKriteria($id_kr);
                        $dataError = [
                            'title' => 'Hasil Error',
                            'nama_alternatif' => $nmALT['nama_alternatif'],
                            'nama_kriteria' => $nmKR['nama_kriteria']
                        ];
                        return view("user/gagalHasilDetail", $dataError);
                    }
                }
                $dataVektorS = [
                    "id" => $a['id'],
                    "vektor_s" => $vektorS
                ];
                $this->alternatifModel->save($dataVektorS);
            }

            foreach ($this->alternatifModel->findAll() as $a2) {
                //Hitung Vektor V
                $query2   = $this->db->query("SELECT SUM(vektor_s) as totalVektorS FROM alternatif");
                $results2 = $query2->getRowArray();
                if ($results2) {
                    $vektorV = $a2['vektor_s'] / $results2['totalVektorS'];
                    $dataVektorV = [
                        "id" => $a2['id'],
                        "vektor_v" => $vektorV
                    ];
                    $this->alternatifModel->save($dataVektorV);
                } else {
                    $dataGagal = [
                        'title' => 'Hasil Error',
                        'dataGagal' => "Periksa kembali data kriteria dan data alternatif"
                    ];
                    return view('user/gagalHasil', $dataGagal);
                }
            }

            $topVektorV = $this->alternatifModel->selectMax('vektor_v')->first();
            $data = [
                'title' => 'Hasil',
                'kriteria' => $this->kriteriaModel->findAll(),
                'hasil' => $this->hasilModel->findAll(),
                'alternatif' => $this->alternatifModel->findAll(),
                'rangking' => $this->alternatifModel->orderBy('vektor_v', 'DESC')->findAll(),
                'top' => $this->alternatifModel->where('vektor_v', $topVektorV['vektor_v'])->first()
            ];
            return view('user/hasil_index', $data);
        } else {
            if (!$this->kriteriaModel->findAll()) {
                $dataGagal = [
                    'title' => 'Hasil Error',
                    'dataGagal' => "Kriteria Masih Kosong, Mohon input kriteria terlebih dahulu pada menu Data Kriteria"
                ];
                return view('user/gagalHasil', $dataGagal);
            } else if (!$this->alternatifModel->findAll()) {
                $dataGagal = [
                    'title' => 'Hasil Error',
                    'dataGagal' => "Alternatif Masih Kosong, Mohon input alternatif terlebih dahulu pada menu Data Alternatif"
                ];
                return view('user/gagalHasil', $dataGagal);
            } else {
                $dataGagal = [
                    'title' => 'Hasil Error',
                    'dataGagal' => "Periksa kembali data kriteria dan data alternatif"
                ];
                return view('user/gagalHasil', $dataGagal);
            }
        }
    }

    public function exportPDF()
    {
        $topVektorV = $this->alternatifModel->selectMax('vektor_v')->first();
        $data = [
            'title' => 'Hasil',
            'kriteria' => $this->kriteriaModel->findAll(),
            'hasil' => $this->hasilModel->findAll(),
            'alternatif' => $this->alternatifModel->findAll(),
            'rangking' => $this->alternatifModel->orderBy('vektor_v', 'DESC')->findAll(),
            'top' => $this->alternatifModel->where('vektor_v', $topVektorV['vektor_v'])->first()
        ];
        $view = view('user/hasil_exportPDF', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("laporan_pemasok_spon", ["Attachment" => false]);
        exit(0);
    }

    public function exportPDF2()
    {
        $topVektorV = $this->alternatifModel->selectMax('vektor_v')->first();
        $data = [
            'title' => 'Hasil',
            'kriteria' => $this->kriteriaModel->findAll(),
            'hasil' => $this->hasilModel->findAll(),
            'alternatif' => $this->alternatifModel->findAll(),
            'rangking' => $this->alternatifModel->orderBy('vektor_v', 'DESC')->findAll(),
            'top' => $this->alternatifModel->where('vektor_v', $topVektorV['vektor_v'])->first()
        ];
        return view('user/hasil_exportPDF', $data);
    }
}
