<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>

		
		<div class="w3ls-section w3-footer" id="footer" style="background:url('<?=base_url().'assets/cms/images/bg-fix.png'?>') no-repeat;background-size: cover;background-position:center;">
		<div class="container">
				<div class="row">
					<div class="container">
					<img src="<?=base_url().'assets/cms/images/tcb.png'?>" width="200px" alt=""><br>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="ft-panel">
							<div class="head-ft-panel">
								<i class="fa fa-map-marker"></i> Address
							</div>
							<hr class="hr-color">
							<div class="body-ft-panel">
								<?=$setting->alamat?>
							</div>
							<a class="btn btn-primary btn-sm" data-toggle="modal" href='#map'>Map it</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="ft-panel">
							<div class="head-ft-panel">
								<i class="fa fa-address-book"></i> Get In Touch
							</div>
							<hr class="hr-color">
							<div class="body-ft-panel">
								<p><i class="fa fa-clock-o"></i> <?=$setting->jam_kerja?></p>
								<p><i class="fa fa-envelope"></i> <?=$setting->email?></p>
								<p><i class="fa fa-phone"></i> <?=$setting->telepon?> / <?=$setting->fax?>(fax)</p>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="ft-panel">
							<div class="head-ft-panel">
								<i class="fa fa-info-circle"></i> Information Links
							</div>
							<hr class="hr-color">
							<div class="body-ft-panel">
								<ul>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="ft-panel">
							<div class="head-ft-panel">
								<i class="fa fa-group"></i> Support
							</div>
							<hr class="hr-color">
							<div class="body-ft-panel">
							<ul>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
									<li><a href="http://"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					</div>
				</div>
				<div class="modal fade" id="map">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.6339013182987!2d107.61740291436742!3d-6.934284894989952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e887161ff37b%3A0xd2022ea1b54061e0!2sTali+Cahaya+Buana!5e0!3m2!1sid!2sid!4v1534982307449" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
				
		</div>				  
	</div>
	<!-- //footer -->
	<!-- Tooltip -->
	<div class="tooltip-content">
		<div class="modal fade features-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Visi dan Misi</h4>
					</div>
					<div class="modal-body">
						<div class="panel panel-primary">
							<div class="panel-heading bg-red">Visi</div>
							<div class="panel-body">
								<?=$setting->visi?>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">Misi</div>
							<div class="panel-body">
								<?=$setting->misi?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Tooltip -->
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
	<script src="<?=base_url().'assets/dropify/dropify.min.js'?>"></script>
	<script src="<?=base_url().'assets/swt/sweetalert.min.js'?>"></script>

	<script src="<?=base_url().'assets/cms/js/SmoothScroll.min.js'?>"></script>
	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?=base_url().'assets/cms/js/bootstrap.js'?>"></script>
</body>

</html>