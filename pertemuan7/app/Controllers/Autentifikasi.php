<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Autentifikasi extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        // Check if user is already logged in
        if ($session->get('email')) {
            return redirect()->to('admin');
        }

        $form_validation = \Config\Services::validation();

        $form_validation->setRules([
            'email' => [
              'label' => 'Alamat Email',
              'rules' => 'required|valid_email',
              'errors' => [
                  'required' => 'Email Harus Diisi!!',
                  'valid_email' => 'Email Tidak Benar!!'
                  ]
                ],
            'password' => [
              'label' => 'Password',
              'rules' => 'required|trim',
              'errors' => [
                  'required' => 'Password harus diisi'
                  ]
                ],
                ]
        );
        
        if (!$form_validation->withRequest($this->request)->run()) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            
            echo view('templates/aute_header', $data);
            echo view('autentifikasi/login');
            echo view('templates/aute_footer');
            
        } else {
            return $this->_login();
        }
    }

    private function _login()
    {
        $session = \Config\Services::session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); 

        $modelUser = new ModelUser();
        $user = $modelUser->cekData($email);
        
        if ($user) {
            if ($user['is_active'] == 1) {
                if ($password == $user['password']) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $session->set($data);

                    if ($user['role_id'] == 1) {
                        return redirect()->to('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $session->setFlashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');
                        }
                        return redirect()->to('user');
                    }
                } else {
                    $session->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    return redirect()->to('autentifikasi');
                }
            } else {
                $session->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                return redirect()->to('autentifikasi');
            }
        } else {
            $session->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            return redirect()->to('autentifikasi');
        }
    }
}
