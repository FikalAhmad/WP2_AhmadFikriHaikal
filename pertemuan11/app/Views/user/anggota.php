<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
  <div class="table-responsive table-bordered col-sm-12 ml-auto mr-auto mt-2"> 
      <div class="page-header"> 
        <span class="fas fa-users text-primary mt-2 "> Data Anggota</span> 
        <a class="text-danger" href="<?php echo base_url('user/data_user'); ?>"><i class="fas fa-search mt-2 float-right"> Tampilkan</i></a> 
      </div> 
      <table class="table mt-3"> 
        <thead> 
          <tr>
          <th>#</th> 
            <th>Nama Anggota</th> 
            <th>Email</th> 
            <th>Role ID</th> 
            <th>Aktif</th> 
            <th>Member Sejak</th> 
          </tr> 
        </thead> 
        <tbody>
          <?php 
          $i = 1; 
          foreach ($anggota as $a): ?> 
            <tr> 
              <td><?= $i++; ?></td> 
              <td><?= $a['nama']; ?></td> 
              <td><?= $a['email']; ?></td> 
              <td><?= $a['role_id']; ?></td> 
              <td><?= $a['is_active']; ?></td> 
              <td><?= date('Y', $a['tanggal_input']); ?></td> 
            </tr> 
          <?php endforeach; ?> 
        </tbody> 
      </table> 
    </div>
  </div>
</div>