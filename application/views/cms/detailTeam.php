<?php $this->load->view("cms/include/header"); ?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>
	

	<div class="about-w3slid">
			<div class="container">
				<h4><?=$detail->nama_lengkap?></h4>
                <hr>
                <div class="row">
                
                <div class="col-md-8 col-md-offset-2">
                    <center><img src="<?=base_url().'img/anggota/'.$detail->foto?>" class="img-responsive"></center>
                    <hr>
                    <table class="table table-striped ">
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
                            <th>Email</th>
                            <th>:</th>
                            <th><?=$detail->email?></th>
                        </tr>
                    </table>
                </div>
                </div>
				
			</div>
		</div>
		<!-- //about-slid -->

	<!-- about-slid -->
	<div class="about-w3slid slide2">
			<div class="container">
				<h4>Keahlian</h4>
				<p><?=$detail->keahlian?></p>
				
			</div>
		</div>
		<!-- //about-slid -->



	
	

<?php $this->load->view("cms/include/footer"); ?>