<?php 

namespace App\Controllers;

class DataSiswa extends BaseController
{ 
 
    public function index() 
    { 
      return view("dlemas-form");
    } 
 
    public function cetak() 
    { 
        $form_validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $form_validation->setRule('namasiswa', 'Nama Siswa','required|min_length[3]', [
          'required'=>'Nama Siswa Harus Diisi',
          'min_length'=>'Kode terlalu pendek'
        ]);
        // $form_validation->setRule('nama', 'Nama Matakuliah','required|min_length[3]', [
        //   'required'=>'Nama Matakuliah Harus Diisi',
        //   'min_length'=>'Nama terlalu pendek'
        // ]);
        if($form_validation->withRequest($request)->run() != true){
          echo view('dlemas-form');
        } else {
          $data = [ 
              'namasiswa' => $this->request->getPost('namasiswa'), 
              'nis' => $this->request->getPost('nis'), 
              'kelas' => $this->request->getPost('kelas'),
              'tanggallahir' => $this->request->getPost('tanggallahir'),
              'tempatlahir' => $this->request->getPost('tempatlahir'),
              'alamat' => $this->request->getPost('alamat'),
              'jeniskelamin' => $this->request->getPost('jeniskelamin'),
              'agama' => $this->request->getPost('agama')
          ]; 
          echo view('dlemas-data', $data); 
        }
    } 
}