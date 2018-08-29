<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Project
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Project</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
							<u><h4><?=$detail->nama_project?> [<small>Dibuat Pada : <?=$detail->dibuat_pada?></small>]</h4></u>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="col-md-4 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								<center>
									<img src="<?=base_url().'img/project/'.$detail->foto_project?>" class="img-responsive">
								</center>
								</div>
							</div>
							</div>
							<div class="col-xs-12 col-md-8">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>Client</td>
											<td>:</td>
											<td><?=$detail->client?></td>
										</tr>
										<tr>
											<td>Link</td>
											<td>:</td>
											<td><a href="<?=$detail->link?>"><?=$detail->link?></a></td>
										</tr>
										<tr>
											<td>Kategori</td>
											<td>:</td>
											<td><?=$detail->status?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12">
							<hr>
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
