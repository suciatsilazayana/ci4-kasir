<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $userModel;
    private $session;

    public function index()
    {
        return view('v_login');
    }

    public function __construct()
    {
        $this->userModel = new \App\Models\m_user();
        $this->session = \Config\Services::session();
    }

    public function register()
    {
        return view('v_register');
    }
    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function insert_user()
    {
        $user = $this->request->getPost('username');
        $no_hp = $this->request->getPost('no_hp');
        $pass = $this->request->getPost('pass');
        $level = $this->request->getPost('level');

        //enkripsi password
        $data = ([
            'nama_user' => $user,
            'no_hp' => $no_hp,
            'password' =>  $this->hash_password($pass),
            'level' => $level,
        ]);

        $tambah = $this->userModel->insert($data);

        //jika data berhasil diinput
        if ($tambah) {
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/register'));
        }
    }
    public function save_register()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}Wajib diisi'
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}Wajib diisi'
                ]
            ]
        ])) {
            //jika valid
        } else {
            //jika tidak valid
            session()->set_flashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home/register'));
        }
    }

    public function auth()
    {
        $user = $this->request->getPost('username');
        $pass = $this->request->getPost('pass');

        $cek_data = $this->userModel->where('nama_user', $user)->first();

        //jika data ditemukan
        if ($cek_data) {

            //seleksi jenis level
            if ($cek_data->level == 1) {
                //menuju ke halaman admin
                return view("admin/halaman_admin");
            } else {
                //menuju ke halaman kasir
                return view("kasir/halaman_kasir");
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return view('v_login');
    }

    public function halaman_tambahuser()
    {
        return view("admin/halaman_tambahuser");
    }


    public function add_user()
    {
        $user = $this->request->getPost('username');
        $no_hp = $this->request->getPost('no_hp');
        $pass = $this->request->getPost('pass');

        //enkripsi password
        $data = ([
            'nama_user' => $user,
            'no_hp' => $no_hp,
            'password' =>  $this->hash_password($pass),
        ]);

        $tambah = $this->userModel->insert($data);

        //jika data berhasil diinput
        if ($tambah) {
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/halamanadmin'));
        }
    }
}
