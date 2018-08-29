<?php $this->load->view("cms/include/header"); ?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

<section class="service-section  w3ls-section" id="services">
			<div class="container">

			
		<div class="container">

			<div class="service-grids agile">
				<div class="service-grid agileits_w3layouts ">
				<?php if($data){
			foreach ($data as $i) { ?>
					<div class="col-md-3">
					<div class="panel panel-default">
						<img src="<?=base_url().'img/anggota/'.$i['foto']?>" class="img-rounded img-responsive">
						<div class="panel-heading">
							<?=$i['nama_lengkap']?>
						</div>
						<div class="panel-footer">
							<?=$i['jabatan']?>
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
