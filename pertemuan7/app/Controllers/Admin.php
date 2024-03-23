<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelBuku;

// defined('BASEPATH') or exit('No direct script access allowed'); 
 
class Admin extends BaseController 
{ 
  public function index()
  {
      $ModelUser = new ModelUser();
      $ModelBuku = new ModelBuku();
      $session = \Config\Services::session();
      $data = [
        'judul' => 'Dashboard',
        'user' => $ModelUser->cekData(['email' => $session->get('email')]),
        'anggota' => $ModelUser->getUserLimit(),
        'buku' => $ModelBuku->getBuku(),

        'jumlah_anggota' => $ModelUser->getUserWhere(['role_id' => 1])->countAllResults(),
        'stok_buku' => $ModelBuku->total('stok', ['stok' => 'stok != 0']),
        'total_dipinjam' => $ModelBuku->total('dipinjam', ['dipinjam != 0']),
        'total_dibooking' => $ModelBuku->total('dibooking', ['dibooking != 0'])
      ];
      // dd($data);

      echo view('admin/header', $data); 
      echo view('admin/sidebar', $data); 
      echo view('admin/topbar', $data); 
      echo view('admin/index', $data); 
      echo view('admin/footer'); 
  } 
}