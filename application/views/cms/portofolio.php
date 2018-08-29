<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>PT Tali Cahaya Buana</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Invest Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Custom Theme files -->
	<link href="<?=base_url().'assets/cms/css/bootstrap.css'?>" type="text/css" rel="stylesheet" media="all">
	<link href="<?=base_url().'assets/cms/css/style.css'?>" type="text/css" rel="stylesheet" media="all">
	<link href="<?=base_url().'assets/cms/css/font-awesome.css'?>" rel="stylesheet">
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="<?=base_url().'assets/cms/css/flexslider.css'?>" type="text/css" media="screen" />
	<!-- //Custom Theme files -->
	<!-- js -->
	<script src="<?=base_url().'assets/cms/js/jquery-2.2.3.min.js'?>"></script>
	<!-- //js -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Jacques+Francois+Shadow" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Anton|Roboto+Condensed|Roboto+Mono|Roboto+Slab" rel="stylesheet">

	<!-- //web-fonts -->
</head>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

<body>
	<!-- banner-info -->
	<div class="w3-header-bg-product">
		<div class="nav-info">
			<div class="container-fluid">
				<div class="nav-contact">
					<ul>
						<li>
							<a href="">
								<i class="fa fa-phone"></i> <?=$setting->telepon?></a>
						</li>
						<li>
							<a href="">
								<i class="fa fa-envelope"></i> <?=$setting->email?></a>
						</li>
						<!-- <li style="float:right;">
								<a href="">Register&nbsp;&nbsp;
									<i class="fa fa-key"></i>
								</a>
							</li>
							<li style="float:right; padding-right:0px;">
								<a href="">Sign In |</a>
							</li> -->
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="w3header">
				<!--header-->
				<nav class="navbar navbar-default navbar-fixed-top">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">
							<img src="<?=base_url().'assets/cms/images/tcb.png'?>" width="60px" alt="">
						</a>
					</div>
					<!-- navbar-header -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right block-menu">
							<li>
								<a href="<?=base_url().'Welcome'?>" class="three-d">Home
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Home</span>
										<span class="back">Home</span>
									</span>
								</a>
							</li>
							<li>
								<a href="<?=base_url().'Welcome/about'?>" class="three-d">About
									<span aria-hidden="true" class="three-d-box">
										<span class="front">About</span>
										<span class="back">About</span>
								</a>
							</li>
							<li>
								<a href="<?=base_url().'Welcome/portofolio'?>" class="three-d">Product
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Product</span>
										<span class="back">Product</span>
								</a>
							</li>
							<li>
								<a href="<?=base_url().'Welcome/info'?>" class="three-d">Information
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Information</span>
										<span class="back">Information</span>
								</a>
							</li>
							<li>
								<a href="<?=base_url().'Welcome/contact'?>" class="three-d">Reach US
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Reach US</span>
										<span class="back">Reach US</span>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

	<section class="w3ls-section w3-product-all" id="product-all">
		<div class="container">
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="card">
								<a class="img-card" href="#">
									<img src="<?=base_url().'assets/cms/images/harnes.png'?>"/>
								</a>
								<br />
								<div class="card-content">
									<h4 class="card-title">
										<a href="#">
											HARNESS
										</a>
									</h4>
									<div class="">
										Lorem ipsum dolor sit amet consectetur adipisicing.
									</div>
								</div>
								<div class="card-read-more">
									<a class="btn btn-detail-prdct btn-block" href="#">
										VIEW DETAILS
									</a>
								</div>
							</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="card">
								<a class="img-card" href="#">
									<img src="<?=base_url().'assets/cms/images/harnes.png'?>"/>
								</a>
								<br />
								<div class="card-content">
									<h4 class="card-title">
										<a href="#">
											HARNESS
										</a>
									</h4>
									<div class="">
										Lorem ipsum dolor sit amet consectetur adipisicing.
									</div>
								</div>
								<div class="card-read-more">
									<a class="btn btn-detail-prdct btn-block" pd-popup-open="popupNew" href='#'>
										VIEW DETAILS
									</a>
								</div>
							</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="card">
								<a class="img-card" href="#">
									<img src="<?=base_url().'assets/cms/images/harnes.png'?>"/>
								</a>
								<br />
								<div class="card-content">
									<h4 class="card-title">
										<a href="#">
											HARNESS
										</a>
									</h4>
									<div class="">
										Lorem ipsum dolor sit amet consectetur adipisicing.
									</div>
								</div>
								<div class="card-read-more">
									<a class="btn btn-detail-prdct btn-block" href="#">
										VIEW DETAILS
									</a>
								</div>
							</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="card">
								<a class="img-card" href="#">
									<img src="<?=base_url().'assets/cms/images/harnes.png'?>"/>
								</a>
								<br />
								<div class="card-content">
									<h4 class="card-title">
										<a href="#">
											HARNESS
										</a>
									</h4>
									<div class="">
										Lorem ipsum dolor sit amet consectetur adipisicing.
									</div>
								</div>
								<div class="card-read-more">
									<a class="btn btn-detail-prdct btn-block" href="#">
										VIEW DETAILS
									</a>
								</div>
							</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$page?>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view("cms/include/footer"); ?>