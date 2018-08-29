<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT Tali Cahaya Buana | LOG IN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/bootstrap/dist/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/font-awesome/css/font-awesome.min.css'?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/Ionicons/css/ionicons.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url().'assets/plugins/iCheck/square/blue.css'?>">
  <link rel="stylesheet" href="<?=base_url().'assets/swt/sweetalert.css'?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<?php $setting=$this->MModel->get("select * from profile where id_profile='1'"); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url().'__Login'?>"><center><img class="img-responsive" src="<?=base_url().'img/profile/'.$setting->foto_profile?>"></center></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
		<?php if($this->session->flashdata('status')) { ?>
    <p class="login-box-msg"><span class="label label-danger"><?=$this->session->flashdata('status')?></span></p>
		<?php } ?>

    <form action="<?=base_url().'__Login/do_login'?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url().'assets/bower_components/jquery/dist/jquery.min.js'?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url().'assets/bower_components/bootstrap/dist/js/bootstrap.min.js'?>"></script>
<!-- iCheck -->
<script src="<?=base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>
<script src="<?=base_url().'assets/swt/sweetalert.min.js'?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script type="text/javascript">
		var $save_method;


		$(document).ready(function(){

			$(':text').change(function(){
				$(this).parent().parent().removeClass('has-error');
				$(this).next().empty();
			});
			$(':password').change(function(){
				$(this).parent().parent().removeClass('has-error');
				$(this).next().empty();
			});
			$('select').change(function(){
				$(this).parent().parent().removeClass('has-error');
				$(this).next().empty();
			});

		});





		function addRegister()
		{
			save_method = 'add';
			$('#formAK')[0].reset();
			$('.form-group').removeClass('has-error');
			$('.pass').show();
			$('.help-block').empty();
			$('#nikKaryawan').show();
			$('#hapus').hide();
			$('#addRegister').modal('show');
			$('#btnSave').show();
			$('.modal-title').text('Tambah Hak Register');
		}



		function saveRegister()
		{
			$('#btnSave').text('Menyimpan...');
			$('#btnSave').attr('disabled', true);
			var url = "<?=base_url().'__Login/addRegister';?>";

			$.ajax({
				url : url,
				type : "POST",
				data : $('#formAK').serialize(),
				dataType : "JSON",
				success : function(data)
				{
					if(data.status)
					{
						$('#addRegister').modal('hide');
						swal({
							title: 'Sukses!',
							text: 'Penyimpanan berhasil',
							type: 'success'
						},
						function(){
							location.reload();
						});
					} else {
						for (var i = 0; i < data.inputerror.length; i++)
              {
                  $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
              }
					}
					$('#btnSave').text('Simpan');
          $('#btnSave').attr('disabled',false);
				},
				error: function (jqXHR, textStatus, errorThrown)
        {
						swal("Oops", "Penyimpanan Gagal!", "error");
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled',false);

        }
			});
		}




	</script>

	<div class="modal fade" id="addRegister" role="dialog">
		<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
							<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h4 class="modal-title">Tambah Hak Register</h4>
							</div>
							<div class="modal-body">
									<form class="class" id="formAK" action="#" method="post">
                    <div class="form-group">
                      <label  style="color:red;" for="">*No Serial IOT TRAINER KIT</label>
                      <input type="text" name="no_seri" class="form-control underline-input"  placeholder="*No Serial Pembelian Alat">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Nama Lengkap</label>
                      <input type="text" name="pembeli" class="form-control underline-input"  placeholder="*Masukan Nama Lengkap...">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Kota/Domisili</label>
                      <input type="text" name="kota" class="form-control underline-input"  placeholder="*Masukan Kota...">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" name="email" class="form-control underline-input"  placeholder="*Masukan Email...">
                      <p class="help-block"></p>
                    </div>
                    <center><u><h5>Hak Akses</h5></u></center>
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" class="form-control underline-input"  placeholder="*Masukan Email...">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="password" class="form-control underline-input"  placeholder="*Masukan Password...">
                      <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Ulangi Password</label>
                      <input type="password" name="password2" class="form-control underline-input"  placeholder="*Ulangi Password...">
                      <p class="help-block"></p>
                    </div>
									</form>
							</div>
							<div class="modal-footer">
								<div class="col-md-12">
									<button type="button" class="btn btn-raised btn-success" id="btnSave" onclick="saveRegister()">Simpan</button>
									<button type="button" id="hapus" class="btn btn-raised btn-danger" id="btnSave">Hapus Hak Register</button>
									<button type="button" class="btn btn-raised btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</div>
					</div>
			</div>
	</div>

</body>
</html>
