<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelBuku;

class Buku extends BaseController
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
        $data['judul'] = 'Data Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        $data['buku'] = $this->ModelBuku->getBuku();
        $data['kategori'] = $this->ModelBuku->getKategori(); 
        // dd($data['kategori']);
        
        $this->form_validation->setRules([
            'judul_buku' => [
              'label' => 'Judul Buku',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Judul Buku Harus Diisi',
                  'min_length' => 'Judul Buku Terlalu Pendek'
                  ]
                ],
            'id_kategori' => [
              'label' => 'Kategori',
              'rules' => 'required',
              'errors' => [
                  'required' => 'Nama Pengarang Harus Diisi'
                  ]
                ],
            'pengarang' => [
              'label' => 'Nama Pengarang',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Nama Pengarang Harus Diisi',
                  'min_length' => 'Nama Pengarang Terlalu Pendek'  
                  ]
                ],
            'penerbit' => [
              'label' => 'Nama Penerbit',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Nama Penerbit Harus Diisi',
                  'min_length' => 'Nama Penerbit Terlalu Pendek'
                  ]
                ],
            'tahun' => [
              'label' => 'Tahun Terbit',
              'rules' => 'required|min_length[3]|max_length[4]|numeric',
              'errors' => [
                    'required' => 'Tahun terbit harus diisi', 
                    'min_length' => 'Tahun terbit terlalu pendek', 
                    'max_length' => 'Tahun terbit terlalu panjang', 
                    'numeric' => 'Hanya boleh diisi angka'
                  ]
                ],
            'isbn' => [
                'label' => 'Nomor ISBN',
                'rules' => 'required|min_length[3]|numeric',
                'errors' => [
                    'required' => 'Nama ISBN harus diisi', 
                    'min_length' => 'Nama ISBN terlalu pendek', 
                    'numeric' => 'Yang anda masukan bukan angka'
                    ]
                ],
            'stok' => [
              'label' => 'Stok',
              'rules' => 'required|numeric',
              'errors' => [
                    'required' => 'Stok harus diisi', 
                    'numeric' => 'Yang anda masukan bukan angka'
                  ]
                ],
            ]
        ); 
 
        if (!$this->form_validation->run()) { 
            echo view('admin/header', $data); 
            echo view('admin/sidebar', $data); 
            echo view('admin/topbar', $data); 
            echo view('buku/index', $data); 
            echo view('admin/footer'); 
        } else {
            $imageFile = $this->request->getFile('image');
            if($imageFile->move(FCPATH . 'assets/img/upload')){
                $image = $imageFile->getName();
            }
            
            $data = [ 
                'judul_buku' => $this->request->getPost('judul_buku', true), 
                'id_kategori' => $this->request->getPost('id_kategori', true), 
                'pengarang' => $this->request->getPost('pengarang', true), 
                'penerbit' => $this->request->getPost('penerbit', true), 
                'tahun_terbit' => $this->request->getPost('tahun', true), 
                'isbn' => $this->request->getPost('isbn', true), 
                'stok' => $this->request->getPost('stok', true),
                'dipinjam' => 0, 
                'dibooking' => 0, 
                'image' => $image
            ]; 
 
            $this->ModelBuku->simpanBuku($data); 
            redirect()->to('buku'); 
        } 
    }
     
    public function kategori() 
    { 
        $data['judul'] = 'Kategori Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        $data['kategori'] = $this->ModelBuku->getKategori(); 
 
        $this->form_validation->setRule('kategori', 'Kategori', 'required', [ 
            'required' => 'Judul Buku harus diisi' 
        ]); 
 
        if (!$this->form_validation->run()) { 
            echo view('admin/header', $data); 
            echo view('admin/sidebar', $data); 
            echo view('admin/topbar', $data); 
            echo view('buku/kategori', $data); 
            echo view('admin/footer'); 
        } else { 
            $data = [
                'kategori' => $this->request->getPost('kategori') 
            ]; 
            
            $this->ModelBuku->simpanKategori($data); 
            redirect()->to('buku/kategori'); 
        } 
    } 
    
    public function hapusKategori() 
    { 
        $where = ['id' => service('uri')->getSegment(3)]; 
        $this->ModelBuku->hapusKategori($where); 
        redirect()->to('buku/kategori'); 
    }

    public function ubahBuku() 
    {   
        $data['judul'] = 'Ubah Data Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => session()->get('email')])->first(); 
        $data['buku'] = $this->ModelBuku->bukuWhere(['id' => $this->request->uri->getSegment(3)]);
        $kategori = $this->ModelBuku->joinKategoriBuku(['buku.id' => $this->request->uri->getSegment(3)]); 
        foreach ($kategori as $k) { 
            $data['id'] = $k['id_kategori']; 
            $data['k'] = $k['nama_kategori']; 
        } 
        $data['kategori'] = $this->ModelBuku->getKategori(); 
        
        $this->form_validation->setRules([
            'judul_buku' => [
              'label' => 'Judul Buku',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Judul Buku Harus Diisi',
                  'min_length' => 'Judul Buku Terlalu Pendek'
                  ]
                ],
            'id_kategori' => [
              'label' => 'Kategori',
              'rules' => 'required',
              'errors' => [
                  'required' => 'Nama Pengarang Harus Diisi'
                  ]
                ],
            'pengarang' => [
              'label' => 'Nama Pengarang',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Nama Pengarang Harus Diisi',
                  'min_length' => 'Nama Pengarang Terlalu Pendek'  
                  ]
                ],
            'penerbit' => [
              'label' => 'Nama Penerbit',
              'rules' => 'required|min_length[3]',
              'errors' => [
                  'required' => 'Nama Penerbit Harus Diisi',
                  'min_length' => 'Nama Penerbit Terlalu Pendek'
                  ]
                ],
            'tahun' => [
              'label' => 'Tahun Terbit',
              'rules' => 'required|min_length[3]|max_length[4]|numeric',
              'errors' => [
                    'required' => 'Tahun terbit harus diisi', 
                    'min_length' => 'Tahun terbit terlalu pendek', 
                    'max_length' => 'Tahun terbit terlalu panjang', 
                    'numeric' => 'Hanya boleh diisi angka'
                  ]
                ],
            'isbn' => [
                'label' => 'Nomor ISBN',
                'rules' => 'required|min_length[3]|numeric',
                'errors' => [
                    'required' => 'Nama ISBN harus diisi', 
                    'min_length' => 'Nama ISBN terlalu pendek', 
                    'numeric' => 'Yang anda masukan bukan angka'
                    ]
                ],
            'stok' => [
              'label' => 'Stok',
              'rules' => 'required|numeric',
              'errors' => [
                    'required' => 'Stok harus diisi', 
                    'numeric' => 'Yang anda masukan bukan angka'
                  ]
                ],
            ]
        ); 
         
                if (!$this->form_validation->run()) { 
                    echo view('admin/header', $data); 
                    echo view('admin/sidebar', $data); 
                    echo view('admin/topbar', $data); 
                    echo view('buku/ubah_buku', $data); 
                    echo view('admin/footer'); 
                } else { 
                    $imageFile = $this->request->getFile('image');
                    if ($imageFile->move(FCPATH . 'assets/img/upload/')) { 
                        $image = $imageFile->getName();
                    }
                    
                    $data = [ 
                        'judul_buku' => $this->request->getPost('judul_buku', true), 
                        'id_kategori' => $this->request->getPost('id_kategori', true), 
                        'pengarang' => $this->request->getPost('pengarang', true), 
                        'penerbit' => $this->request->getPost('penerbit', true), 
                        'tahun_terbit' => $this->request->getPost('tahun', true),
                        'isbn' => $this->request->getPost('isbn', true), 
                        'stok' => $this->request->getPost('stok', true), 
                        'image' => $image
                    ]; 
 
            $this->ModelBuku->updateBuku($data, ['id' => $this->request->getPost('id')]); 
            redirect()->to('buku'); 
        } 
    }

    public function hapusBuku() 
    { 
        $where = ['id' => $this->request->uri->getSegment(3)]; 
        $this->ModelBuku->hapusBuku($where); 
        redirect()->to('buku'); 
    }

}
