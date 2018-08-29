<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Karir
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Karir</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
				<?=$detail->email?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<iframe width='1000' height='600' src='<?=base_url().'img/karir/'.$detail->upload_cv?>' frameborder='0' allowfullscreen></iframe>
			<object data="<?=base_url().'img/karir/'.$detail->upload_cv?>" type="application/x-pdf" title="SamplePdf" width="500" height="720">
				<a href="<?=base_url().'img/karir/'.$detail->upload_cv?>">shree</a> 
			</object>	
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
