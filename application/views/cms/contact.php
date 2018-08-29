<?php $this->load->view("cms/include/header")?>
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'");?>
	<!-- contact -->
	<div class="contact-main w3ls-section" id="contact">
		<div class="container">
			<h3 class="agileits-title">
				<span>contact us</span>
			</h3>
			
			<div class="col-md-4 contact-leftgrid">
				<div class="contact-g1">
					<h6>Get In Touch</h6>
					<ul class="address-contact">
						<li>
							<span class="fa fa-phone" aria-hidden="true"></span>
							<?=$setting->telepon?>
						</li>
						<li>
							<span class="fa fa-phone" aria-hidden="true"></span>
							<?=$setting->fax?> (fax)
						</li>
						<li>
							<span class="fa fa-home" aria-hidden="true"></span>
							Work at : <?=$setting->jam_kerja?>
						</li>
						<li>
							<span class="fa fa-envelope" aria-hidden="true"></span>
							<a href="mailto:<?=$setting->email?>"> <?=$setting->email?></a>
						</li>
						<li>
							<span class="fa fa-map-marker" aria-hidden="true"></span>
							<?=$setting->alamat?>

						</li>
					</ul>

				</div>
				<div class="contact-g2">
					<h6>Follow us</h6>
					<div class="address-grid">

						<ul class="social-icons3">

							<li>
								<a href="#" class="s-iconfacebook">
									<span class="fa fa-facebook" aria-hidden="true"></span>
								</a>
							</li>
							<li>
								<a href="#" class="s-icontwitter">
									<span class="fa fa-twitter" aria-hidden="true"></span>
								</a>
							</li>
							<li>
								<a href="#" class="s-icondribbble">
									<span class="fa fa-dribbble" aria-hidden="true"></span>
								</a>
							</li>
							<li>
								<a href="#" class="s-iconbehance">
									<span class="fa fa-behance" aria-hidden="true"></span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

            <div class="container">
				<div class="col-lg-8 col-md-8   contact-right-grid">
                <center>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="<?=base_url().'img/profile/'.$setting->foto_profile?>" class="img-responsisve">
                        </div>
                    </div>
                    </center
					<h6>send us a message</h6>
					<div class="agileits-main-right">
						<form action="#" id="formC" method="post" class="agile_form">
							<label class="header">Name</label>
							<div class="icon1 w3ls-name1">
								<input placeholder=" " name="nama_client" type="text" required="">
							</div>
							<div class="icon2">
								<label class="header">Email</label>
								<input placeholder=" " name="email" type="email" required="">
							</div>
							<label class="header">your message</label>
							<textarea class="w3l_summary" name="say" required=""></textarea>
							<input type="submit" value="SEND">
						</form>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 ">
                    
				</div>
				<div class="clearfix"></div>
			</div>
           

			<div class="clearfix"></div>
		</div>

       
            <div class="map text-center">
            <div id="map" style="auto; height:505px;"></div>
		    </div>
           
		
		
	</div>
	<!-- contact -->
<?php $this->load->view("cms/include/footer"); ?>
<script>
      function initMap() {
        var lab = {lat: -6.934040, lng: 107.619645};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: lab
        });
        var marker = new google.maps.Marker({
          position: lab,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnAL7xSSUJA0nu1Bi-4NiLFDvJ9xVQsRs&callback=initMap">
    </script>

		<script type="text/javascript">
		var save_method;

		$(document).ready(function () {

			$('input').change(function () {
				$(this).parent().parent().removeClass('has-error');
				$(this).next().empty();
			});
			$('select').change(function () {
				$(this).parent().parent().removeClass('has-error');
				$(this).next().empty();
			});

			

			$('#formC').on('submit', function (e) {
				var url = "<?=base_url().'Client/add';?>";
				e.preventDefault();
				$.ajax({
					url: url,
					method: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function (data) {
						alert("Message delivered");
						location.reload();
					}
				});
			});


		

		});

		

		
		
	</script>