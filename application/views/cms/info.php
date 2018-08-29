<?php $this->load->view("cms/include/header"); ?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

<section class="service-section  w3ls-section" id="services">
			<div class="container">

			
		<div class="container">

			<div class="service-grids agile">
				<div class="service-grid agileits_w3layouts ">
				<?php if($data){
			foreach ($data as $i) { ?>
					<div class="col-md-4">
					<div class="panel panel-default">
						<img src="<?=base_url().'img/info/'.$i['img']?>" class="img-rounded img-responsive">
						<div class="panel-heading">
							<?=$i['tgl_input']?>
						</div>
						<div class="panel-body">
							<h4><?=$i['judul_info']?></h4>
							<p><?=substr($i['deskripsi'],0,200)?>...</p>
						</div>
						<div class="panel-footer">
							<a href="<?=base_url().'Welcome/detInfo/'.$i['id_info']?>">baca lebih lanjut...</a>
						</div>
					</div>
				</div>
			<?php } }?>

					<div class="clearfix"></div>
					<hr>
					<?=$page?>

				</div>
			</div>
		</div>

	</section>

<?php $this->load->view("cms/include/footer"); ?>
