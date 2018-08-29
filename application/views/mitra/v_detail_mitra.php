<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Mitra
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Mitra</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
							<u><h4><?=$detail->nama_mitra?></h4></u>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="col-md-4 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								<center>
									<img src="<?=base_url().'img/mitra/'.$detail->foto_mitra?>" class="img-responsive">
								</center>
								</div>
							</div>
							</div>
							<div class="col-xs-12 col-md-8">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>Nama Mitra</td>
											<td>:</td>
											<td><?=$detail->nama_mitra?></td>
										</tr>
										<tr>
											<td>Kontak Mitra</td>
											<td>:</td>
											<td><?=$detail->kontak_mitra?></td>
										</tr>
										<tr>
											<td>Email Mitra</td>
											<td>:</td>
											<td><?=$detail->email_mitra?></td>
										</tr>
										<tr>
											<td>Alamat Mitra</td>
											<td>:</td>
											<td><?=$detail->alamat_mitra?></td>
										</tr>
										<tr>
											<td>Link</td>
											<td>:</td>
											<td><a target="_blank" href="<?=$detail->link_mitra?>">Visit</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12">
							<hr>
								<h4>Deskripsi :</h4>
								<?=$detail->deskripsi?>
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
