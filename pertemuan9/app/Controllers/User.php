<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBuku;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $form_validation;
    protected $request;
    protected $ModelUser;
    protected $ModelBuku;

    public function __construct() {
        $this->form_validation = \Config\Services::validation();
        $this->request = \Config\Services::request();
        $this->ModelUser = new ModelUser();
        $this->ModelBuku = new ModelBuku();
    }

    public function index()
    {
        $data['judul'] = 'Profil Saya'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        
        echo view('admin/header', $data); 
        echo view('admin/sidebar', $data); 
        echo view('admin/topbar', $data); 
        echo view('user/index', $data); 
        echo view('admin/footer');
    }
    
    public function anggota() 
    { 
        $data['judul'] = 'Data Anggota'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        $this->ModelUser->where('role_id', 1); 
        $data['anggota'] = $this->ModelUser->findAll(); 
 
        echo view('admin/header', $data); 
        echo view('admin/sidebar', $data); 
        echo view('admin/topbar', $data); 
        echo view('user/anggota', $data); 
        echo view('admin/footer'); 
    }
    
    public function ubahProfil() 
    { 
        $data['judul'] = 'Ubah Profil'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        
        $this->form_validation->setRules([
            'image' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[image]',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[image,100]',
                    'max_dims[image,1024,768]',
                ],
            ],
            ]
            );
        if (!$this->form_validation->run()) { 
            echo view('admin/header', $data); 
            echo view('admin/sidebar', $data); 
            echo view('admin/topbar', $data); 
            echo view('user/ubah-profile', $data); 
            echo view('admin/footer'); 
        } else { 
            $nama = $this->request->getPost('nama');
            // Check if there's a file uploaded
            $imageFile = $this->request->getFile('image');
            
            if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                // Perform the upload
                if ($imageFile->move(FCPATH . 'assets/img/profile/')) {
                    $gambar_baru = $imageFile->getName();
                    $this->ModelUser->update($data['user']['id'], ['image' => $gambar_baru]);
                }
            }

            $this->ModelUser->update($data['user']['id'], ['nama' => $nama]);

            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
            return redirect()->to('user');
        } 

    } 
}
