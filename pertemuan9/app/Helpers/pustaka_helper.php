<?php
  function cek_login()
  {
    $session = session();

    if (!$session->get('email')) {
      $session->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!!</div>');
      return redirect()->to('autentifikasi');
    } else {
      $role_id = $session->get('role_id');
    }
  }
?>