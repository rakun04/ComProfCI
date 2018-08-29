<?php $this->load->view("cms/include/header"); ?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

<!-- about -->

<!-- style="background:url(<?=base_url();?>assets/cms/images/about.png);background-size:cover;background-position:center;" -->
<div class="w3ls-section w3-about" id="about">
	<div class="container">
		<div class="about-main">
			<!-- <div class="col-md-6"> -->
				<!-- <img src="<?=base_url();?>assets/cms/images/man.jpeg" alt=""> -->
			<!-- </div> -->
			<div class="col-md-12 w3_agileits-ab-main">
				<div class="about-inner">
					<h3 class="agileits-title">
						<span>About Us</span>
					</h3>
					<p class="about-text-w3l">
						<?=$setting->deskripsi?>
					</p>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div class="w3ls-section w3-about" id="about">
	<div class="container">
		<div class="col-lg-12 col-md-12">
			<div class="col-md-2 col-lg-2">
				<h2 class="tittle-company">COMPANY RECORD</h2>
			</div>
			<div class="col-md-10 col-lg-10">
				<div class="col-md-3">
					<div class="text-center box-enam1">
						<i class="fa fa-check">&nbsp;</i>FINISHED PROJECTS</div>
					<div id="box-enam2" class="text-center">
						<span>
							<h3><?= $this->db->where('status',"Portopolio")->from("project")->count_all_results(); ?></h3>
						</span>
						<h4>Projects</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="text-center box-enam1">
						<i class="fa fa-lightbulb-o">&nbsp;</i>ON GOING PROJECTS</div>
					<div id="box-enam2" class="text-center">
						<span>
							<h3><?= $this->db->where('status',"Process")->from("project")->count_all_results(); ?></h3>
						</span>
						<h4>Projects</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="text-center box-enam1">
						<i class="fa fa-group">&nbsp;</i>ACTIVE EMPLOYEES</div>
					<div id="box-enam2" class="text-center">
						<span>
							<h3><?= $this->db->count_all_results("anggota"); ?></h3>
						</span>
						<h4>Employees</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="text-center box-enam1">
						<i class="fa fa-clock-o">&nbsp;</i>Product</div>
					<div id="box-enam2" class="text-center">
						<span>
							<h3><?= $this->db->count_all_results("product"); ?></h3>
						</span>
						<h4>Product</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="w3ls-section w3-visi">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="agileits-title" id="visim">
						<span>Visi</span> <span class="garis"></span>
					</h3>
				<p class="text-vision"><?=$setting->visi?></p>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="agileits-title" id="visim">
						<span>Mision</span>  <span class="garis"></span>
					</h3>
					<p class="text-vision"><?=$setting->misi?></p>
				</div>
				
			</div>
		</div>
	</div>
</div>

<!-- about-slid -->




<!-- //about-slid -->
<!-- //about -->
<!-- about-slid -->

<!-- team -->

<section class="service-section  w3ls-section" id="services">
	<div class="container">
		<div class="row">
			<div class="personel-items atop3 col-xs-12 animated">
					<h3 class="agileits-title">
						<span>TEAM</span>
					</h3>
				<?php
						$user=$this->MModel->getData("select * from anggota");
						 if($user){
							foreach ($user as $usr) { ?>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" itemscope="" itemtype="http://schema.org/Person">
					<div class="hovereffect">
						<img class="img-responsive image-team" alt="" itemprop="image" src="<?=base_url().'img/anggota/'.$usr['foto']?>">
						<div class="overlay-team">
							<h2 itemprop="name">
								<?=$usr['nama_lengkap']?>
							</h2>
							<p itemprop="jobTitle">
								<?=$usr['jabatan']?>
							</p>
						</div>
					</div>
				</div>
				<?php } }?>
			</div>
		</div>
	</div>
</section>
<!-- //team -->


<!-- testimonials -->
<!-- //Testimonials -->
<!-- footer -->
<?php $this->load->view("cms/include/footer"); ?>

<!-- //Tooltip -->
<script src="<?=base_url().'assets/cms/js/SmoothScroll.min.js'?>"></script>
<!-- flexSlider -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<script defer src="<?=base_url().'assets/cms/js/jquery.flexslider.js'?>"></script>
<script>
	$(window).load(function () {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function (slider) {
				$('body').removeClass('loading');
			}
		});
	});
</script>
<!-- //flexSlider -->
<!-- model responsive slider -->
<script src="<?=base_url().'assets/cms/js/responsiveslides.min.js'?>"></script>
<script>
	// You can also use "$(window).load(function() {"
	$(function () {
		// Slideshow 4
		$(".slider3").responsiveSlides({
			auto: false,
			pager: true,
			nav: true,
			speed: 500,
			namespace: "callbacks",
			before: function () {
				$('.events').append("<li>before event fired.</li>");
			},
			after: function () {
				$('.events').append("<li>after event fired.</li>");
			}
		});

	});
</script>
<!-- start-smooth-scrolling -->
<script src="<?=base_url().'assets/cms/js/move-top.js'?>"></script>
<script src="<?=base_url().'assets/cms/js/easing.js'?>"></script>
<script>
	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
	$(document).ready(function () {
		/*
		   var defaults = {
			   containerID: 'toTop', // fading element id
			   containerHoverID: 'toTopHover', // fading element hover id
			   scrollSpeed: 1200,
			   easingType: 'linear'
		   };
		   */

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>

<script src="<?=base_url().'assets/cms/js/SmoothScroll.min.js'?>"></script>