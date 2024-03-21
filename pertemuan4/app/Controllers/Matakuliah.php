<?php 

namespace App\Controllers;

class Matakuliah extends BaseController
{ 
 
    public function index() 
    { 
      return view("view-form-matakuliah");
    } 
 
    public function cetak() 
    { 
        $form_validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $error = $form_validation->getErrors();

        $form_validation->setRules([
          'kode' => [
            'label' => 'Kode Matakuliah',
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Kode matakuliah Harus diisi',
                'min_length' => 'Kode terlalu pendek'
            ]
          ],
          'nama' => [
            'label' => 'Nama Matakuliah',
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama matakuliah Harus diisi',
                'min_length' => 'Nama terlalu pendek'
            ]
          ],
        ]
      );
        if(!$form_validation->withRequest($request)->run()){
          echo view('view-form-matakuliah', $error);
        } else {
          $data = [ 
              'kode' => $request->getPost('kode'), 
              'nama' => $request->getPost('nama'), 
              'sks' => $request->getPost('sks') 
          ]; 
          echo view('view-data-matakuliah', $data); 
        }
    } 
}