<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail User
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">User</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
							Detail User
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="table-responsive">
              <table id="tabel" class="table table-striped table-hover">
                <tbody>
									<tr>
										<th colspan="3">
											<center>
											<img src="<?=base_url().'img/anggota/'.$detail->foto?>" class="img-respomsive">
											</center>
										</th>
									</tr>
									<tr>
										<th>ID Anggota</th>
										<th>:</th>
										<th><?=$detail->id_anggota?></th>
									</tr>
									<tr>
										<th>Nama Lengkap</th>
										<th>:</th>
										<th><?=$detail->nama_lengkap?></th>
									</tr>
									<tr>
										<th>Jenis Kelamin</th>
										<th>:</th>
										<th><?=$detail->jenis_kelamin?></th>
									</tr>
									<tr>
										<th>Jabatan</th>
										<th>:</th>
										<th><?=$detail->jabatan?></th>
									</tr>
									<tr>
										<th>Keahlian</th>
										<th>:</th>
										<th><?=$detail->keahlian?></th>
									</tr>
									<tr>
										<th>Email</th>
										<th>:</th>
										<th><?=$detail->email?></th>
									</tr>
									<tr>
										<th>No HP	</th>
										<th>:</th>
										<th><?=$detail->contact?></th>
									</tr>
                </tbody>
              </table>
						</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>


<?php $this->load->view('include/footer'); ?>
