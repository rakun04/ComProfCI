<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Info
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Info</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
							<h4><?=$detail->judul_info?> [<small><?=$detail->tgl_input?></small>]</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="panel panel-default">
								<div class="panel-heading">
								<center>
									<img src="<?=base_url().'img/info/'.$detail->img?>" class="img-responsive">
								</center>
								</div>
							</div>
							<?=$detail->deskripsi?>
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
