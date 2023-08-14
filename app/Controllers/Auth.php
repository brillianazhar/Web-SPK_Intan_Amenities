<?php

namespace App\Controllers;

use CodeIgniter\CLI\Console;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $validation;
    protected $db;
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
    }

    // public function index()
    // {
    //     helper(['url', 'form']);

    //     $rules = [
    //         'email' => [
    //             'label'  => 'email',
    //             'rules'  => 'required',
    //             'errors' => [
    //                 'required' => 'All accounts must have email provided',
    //             ]
    //         ],
    //         'password' => [
    //             'label'  => 'password',
    //             'rules'  => 'required',
    //             'errors' => [
    //                 'required' => 'All accounts must have password provided',
    //             ]
    //         ]
    //     ];

    //     $data = [
    //         'title' => 'Amenities',
    //         'validation' => $this->validation
    //     ];

    //     if ($this->request->is('post')) {
    //         if (!$this->validate($rules)) {
    //             return view('auth/login', $data);
    //         } else {
    //             echo "asdasd";
    //         }
    //     } else {
    //         return view('auth/login', $data);
    //     }
    // }

    public function index()
    {
        $data = [
            'title' => 'Amenities',
        ];

        return view('auth/login', $data);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getVar("email");
            $password = $this->request->getVar("password");

            $user = $this->db->query("SELECT * FROM user WHERE email = '" . $email . "'")->getRowArray();

            if ($user) {
                if ($user['is_active'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        session()->set($data);
                        if ($user['role_id'] == 1) {
                            return redirect()->route('user_management');
                        } else {
                            return redirect()->route('user');
                        }
                    } else {
                        session()->setFlashdata('message', '<div class="alert alert-danger" role="alert"> Wrong password </div>');
                        return redirect()->route('/');
                    }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger" role="alert"> Sorry ! This email is not avtivated </div>');
                    return redirect()->route('/');
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert"> Sorry ! This email is not registered </div>');
                return redirect()->route('/');
            }
        }
    }

    public function signup()
    {

        $data = [
            "name" => htmlspecialchars($this->request->getVar("sgusername"), true),
            "email" => htmlspecialchars($this->request->getVar("sgemail"), true),
            "image" => 'default.jpg',
            "password" => password_hash($this->request->getVar("sgpassword1"), PASSWORD_DEFAULT),
            "role_id" => 2,
            "is_active" => 1,
            "date_created" => time()
        ];

        $this->userModel->save($data);

        session()->setFlashdata('message', '<div class="alert alert-success" role="alert"> Congratulations! your account has been created </div>');
        return redirect()->route('/');
    }

    public function cekEmail()
    {
        $data = $_POST['sgemail'];
        $query   = $this->db->query("SELECT * FROM user WHERE email = '" . $data . "'");
        $results = $query->getResult();

        if (count($results) > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
    }

    public function logout()
    {
        session()->remove('email');
        session()->remove('role_id');
        session_destroy();
        return redirect()->route('/');
    }
}
