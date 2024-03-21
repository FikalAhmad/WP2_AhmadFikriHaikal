<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Autentifikasi extends BaseController
{
    public function index()
    {
        // Check if user is already logged in
        if (session()->get('email')) {
            return redirect()->to('user');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data['judul'] = 'Login';
            $data['user'] = '';

            return view('templates/aute_header', $data) . view('autentifikasi/login') . view('templates/aute_footer');
        } else {
            return $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password') ?? "";

        $modelUser = new ModelUser();
        $user = $modelUser->where('email', $email)->first();
        $user_password = implode($user['password']);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user_password)) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    session()->set($data);

                    if ($user['role_id'] == 1) {
                        return redirect()->to('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            session()->setFlashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');
                        }
                        return redirect()->to('user');
                    }
                } else {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    return redirect()->to('autentifikasi');
                }
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                return redirect()->to('autentifikasi');
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            return redirect()->to('autentifikasi');
        }
    }
}
