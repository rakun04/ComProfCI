<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Client
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Client</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
							Detail Cient
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nama Client</th>
										<th>:</th>
										<th><?=$detail->nama_client?></th>
									</tr>
									<tr>
										<th>Tanggal Input</th>
										<th>:</th>
										<th><?=$detail->tanggal?></th>
									</tr>
									<tr>
										<th>Email</th>
										<th>:</th>
										<th><?=$detail->email?></th>
									</tr>
									<tr>
										<th>Tanggapan</th>
										<th>:</th>
										<th><?=$detail->say?></th>
									</tr>
								</thead>
							</table>
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
