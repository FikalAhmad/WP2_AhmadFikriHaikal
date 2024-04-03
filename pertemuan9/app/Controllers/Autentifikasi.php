<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Autentifikasi extends BaseController
{   
    protected $form_validation;
    protected $request;
    protected $ModelUser;

    public function __construct() {
        $this->form_validation = \Config\Services::validation();
        $this->request = \Config\Services::request();
        $this->ModelUser = new ModelUser();
    }
    
    public function index()
    {
        if (session()->get('email')) {
            return redirect()->to('user');
        }


        $this->form_validation->setRules([
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
        
        if (!$this->form_validation->withRequest($this->request)->run()) {
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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); 

        $user = $this->ModelUser->cekData(['email' => $email])->first();
        
        if ($user) {
            if ($user['is_active'] == 1) {
                if ($password == $user['password']) {
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

    public function blok()
    { 
        echo view('autentifikasi/blok'); 
    } 
 
    public function gagal() 
    { 
        echo view('autentifikasi/gagal'); 
    }

    public function registrasi()
    {
        if(session()->get('email')){
            redirect()->to('user');
        }

        $this->form_validation->setRules([
            'nama' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Belum Diisi!!'
                ]
            ],
            'email' => [
              'label' => 'Alamat Email',
              'rules' => 'required|trim|valid_email|is_unique[user.email]',
              'errors' => [
                  'required' => 'Email Harus Diisi!!',
                  'valid_email' => 'Email Tidak Benar!!',
                  'is_unique' => 'Email Sudah Terdaftar'
                  ]
                ],
            'password1' => [
              'label' => 'Password',
              'rules' => 'required|trim|min_length[3]|matches[password2]',
              'errors' => [
                  'required' => 'Password harus diisi',
                  'matches' => 'Password Tidak Sama',
                  'min_length' => 'Password Terlalu Pendek'
                  ]
                ],
            'password2' => [
              'label' => 'Repeat Password',
              'rules' => 'required|trim|matches[password1]',
              'errors' => [
                  'required' => 'Password harus diisi',
                  ]
                ],
            ]
        );

        if (!$this->form_validation->run()) { 
            $data['judul'] = 'Registrasi Member'; 
            echo view('templates/aute_header', $data); 
            echo view('autentifikasi/registrasi'); 
            echo view('templates/aute_footer'); 
        } else {
            $email = $this->request->getPost('email', true); 
            $data = [ 
                'nama' => $this->request->getPost('nama', true), 
                'email' => $email, 
                'image' => 'default.jpg', 
                'password' => password_hash($this->request->getPost('password1'), PASSWORD_DEFAULT), 
                'role_id' => 2, 
                'is_active' => 0, 
                'tanggal_input' => time() 
            ]; 
            $this->ModelUser->simpanData($data); //menggunakan model 
           
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!!akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>'); 
            redirect('autentifikasi');
        }
    }
}
