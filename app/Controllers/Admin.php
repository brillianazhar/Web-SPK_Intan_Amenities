<?php

namespace App\Controllers;

use CodeIgniter\CLI\Console;

use App\Models\UserModel;

class Admin extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {


        $user = $this->userModel->getUser();

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_user = $this->userModel->search($keyword);
        } else {
            $data_user = $this->userModel;
        }

        $data = [
            'title' => 'User Management',
            'currentPage' => $currentPage,
            'user' => $data_user->where('role_id', 2)->paginate(5, 'user'),
            'pager' => $this->userModel->pager
        ];

        return view('admin/index', $data);
    }

    public function confirmUser($id)
    {
        $data = [
            'id' => $id,
            'is_active' => 1
        ];

        $this->userModel->save($data);
        return redirect()->to('/user_management');
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user_management');
    }
}
