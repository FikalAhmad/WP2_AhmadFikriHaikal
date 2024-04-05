<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelBuku;
 
class Admin extends BaseController 
{   
  protected $ModelUser;
  protected $ModelBuku;

  public function __construct() {
    $this->ModelUser = new ModelUser();
    $this->ModelBuku = new ModelBuku();
  }
  
  public function index()
  {
    $data = [
      'judul' => 'Dashboard',
      'user' => $this->ModelUser->cekData(['email' => session()->get('email')])->first(),
      'anggota' => $this->ModelUser->getUserLimit(),
      'buku' => $this->ModelBuku->getBuku(),

      'jumlah_anggota' => $this->ModelUser->getUserWhere(['role_id' => 1])->countAllResults(),
      'stok_buku' => $this->ModelBuku->total('stok', 'stok != 0'),
      'total_dipinjam' => $this->ModelBuku->total('dipinjam', 'dipinjam != 0'),
      'total_dibooking' => $this->ModelBuku->total('dibooking', 'dibooking != 0')
    ];

    echo view('admin/header', $data); 
    echo view('admin/sidebar', $data); 
    echo view('admin/topbar', $data); 
    echo view('admin/index', $data); 
    echo view('admin/footer'); 
  } 
}