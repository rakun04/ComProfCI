<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Pengeluaran
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Pengeluaran</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
							<u><h4>Detail pengeluaran</h4></u>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="col-md-4 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								<center>
									<img src="<?=base_url().'img/pengeluaran/'.$detail->img_struk?>" class="img-responsive">
								</center>
								</div>
							</div>
							</div>
							<div class="col-md-8 col-xs-12">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>Jumlah</td>
											<td>:</td>
											<td><?=$detail->jumlah?></td>
										</tr>
										<tr>
											<td>Deskripsi</td>
											<td>:</td>
											<td><?=$detail->deskripsi?></td>
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
