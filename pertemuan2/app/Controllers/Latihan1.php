<?php
namespace App\Controllers;

class Latihan1 extends BaseController
{
  public function index() 
    { 
        echo "Selamat Datang.. Selamat belajar Web Programming"; 
    } 
    
    public function penjumlahan($n1, $n2) 
    { 
        $modellatihan1 = new \App\Models\Model_Latihan1();
        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $modellatihan1->jumlah($n1, $n2); 
        echo view('view-latihan1', $data);
    }
}