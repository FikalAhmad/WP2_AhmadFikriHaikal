<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Mahasiswa</title>
  <link rel="stylesheet" href="<?php echo 
base_url() ?>assets/css/dlemas.css">
</head>
<body>
  <div class="container">
    <h1>FORM INPUT DATA SISWA Di-Lemas</h1>
    <table> 
        <tr> 
            <th>Nama Siswa</th> 
            <th>:</th> 
            <td> 
                <?= $namasiswa; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>NIS</td> 
            <td>:</td> 
            <td> 
                <?= $nis; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Kelas</td> 
            <td>:</td> 
            <td> 
                <?= $kelas; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Tanggal Lahir</td> 
            <td>:</td> 
            <td> 
                <?= $tanggallahir; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Tempat Lahir</td> 
            <td>:</td> 
            <td> 
                <?= $tempatlahir; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Alamat</td> 
            <td>:</td> 
            <td> 
                <?= $alamat; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Jenis Kelamin</td> 
            <td>:</td> 
            <td> 
                <?= $jeniskelamin; ?> 
            </td> 
        </tr> 
        <tr> 
            <td>Agama</td> 
            <td>:</td> 
            <td> 
                <?= $agama; ?> 
            </td> 
        </tr> 
        <tr> 
        <td colspan="3" align="center"> 
            <a href="<?= base_url(); ?>">Kembali</a>
        </td> 
      </tr> 
    </table> 
  </div>
</body>
</html>