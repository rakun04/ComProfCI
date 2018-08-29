<?php $this->load->view("cms/include/header"); ?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>
	
<div class="testimonials w3ls-section">
    <div class="container">
        <h3 class="agileits-title">
                <span><?=$detail->nama_servis?></span>
                <hr>
        </h3>
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xs-12">
                <img src="<?=base_url().'img/servis/'.$detail->img_servis?>" class="img-responsive">
            </div>
            <div class="col-md-8 col-lg-8 col-xs-12">
                <p align="justify"><?=$detail->deskripsi?></p>
            </div>
        </div>
        
    </div>
</div>

<?php $this->load->view("cms/include/footer"); ?>