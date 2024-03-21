<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Data Siswa</title>
  <link rel="stylesheet" href="<?php echo 
base_url() ?>assets/css/dlemas.css">
</head>
<body>
  <div class="container">
    <h1>FORM INPUT DATA SISWA Di-Lemas</h1> 
    <form action="<?= base_url('cetak'); ?>" method="post">
    <table>
        <tr> 
            <th>Nama Siswa</th> 
            <th>:</th> 
            <td> 
                <input type="text" name="namasiswa" id="namasiswa"> 
            </td> 
        </tr> 
        <tr> 
            <th>NIS</th> 
            <td>:</td> 
            <td> 
                <input type="text" name="nis" id="nis"> 
            </td> 
        </tr> 
        <tr> 
            <th>Kelas</th> 
            <td>:</td> 
            <td> 
                <input type="text" name="kelas" id="kelas"> 
            </td> 
        </tr> 
        <tr> 
            <th>Tanggal Lahir</th> 
            <td>:</td> 
            <td> 
                <input type="text" name="tanggallahir" id="tanggallahir"> 
            </td> 
        </tr> 
        <tr> 
            <th>Tempat Lahir</th> 
            <td>:</td> 
            <td> 
                <input type="text" name="tempatlahir" id="tempatlahir"> 
            </td> 
        </tr> 
        <tr> 
            <th>Alamat</th> 
            <td>:</td> 
            <td> 
                <input type="text" name="alamat" id="alamat"> 
            </td> 
        </tr> 
        <tr> 
            <th>Jenis Kelamin</th> 
            <td>:</td> 
            <td> 
                <input type="radio" id="jk1" name="jeniskelamin" value="Laki-Laki">
                <label for="html">Laki-Laki</label>
                <input type="radio" id="jk2" name="jeniskelamin" value="Perempuan">
                <label for="html">Perempuan</label>
            </td> 
        </tr> 
        <tr> 
            <th>Agama</th> 
            <td>:</td> 
            <td> 
                <select name="agama" id="agama"> 
                    <option value="Islam">Islam</option> 
                    <option value="Kristen">Kristen</option> 
                    <option value="Katolik">Katolik</option> 
                    <option value="Budha">Budha</option> 
                    <option value="Hindu">Hindu</option> 
                    <option value="Protestan">Protestan</option> 
                    <option value="Konghucu">Khonghucu</option> 
                </select> 
            </td> 
        </tr> 
        <tr> 
            <td colspan="3" align="center"> 
                <input type="submit" value="Submit"> 
            </td> 
        </tr> 
      </table>
    </form>
  </div>
</body>
</html>


















<!-- <center>
    <form action="<?= base_url('matakuliah/cetak'); ?>" method="post"> 
       
    </form>
  </center> -->