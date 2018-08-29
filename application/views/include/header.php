<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT. Tali Cahaya Buana</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/morris.js/morris.css'?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/jvectormap/jquery-jvectormap.css'?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url().'assets/bower_components/bootstrap-daterangepicker/daterangepicker.css'?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'?>">

	<link rel="stylesheet" href="<?=base_url().'assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="<?=base_url().'assets/swt/sweetalert.css'?>">
  <link rel="stylesheet" href="<?=base_url().'assets/redactor/redactor.css'?>">
  <link rel="stylesheet" href="<?=base_url().'assets/dropify/dropify.min.css'?>">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <?php $setting=$this->MModel->get("select * from profile where id_profile='1'"); ?>
    <?php
      $id_user=$this->session->userdata('id_user_sess'); 
      $datauser=$this->MModel->get("select * from anggota where id_anggota='$id_user'");
    ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url().'Dashboard'?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TCB</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img  width="130" height="40" src="<?=base_url().'img/profile/'.$setting->foto_profile?>"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url().'img/admin.png'?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->userdata('username_sess')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url().'img/admin.png'?>" class="img-circle" alt="User Image">
                <p>
                  <?=$this->session->userdata('username_sess')?>
                  <small>admin@talicahayabuana.com</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="javascript:void(0)" onclick="gantiPassword()" class="btn btn-default btn-flat">Ganti Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url().'__Login/keluar'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php if($this->session->userdata('id_anggota_sess')!=0) { ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url().'img/admin.png'?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('username_sess')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="<?=base_url().'Dashboard'?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li><a href="<?=base_url().'Slider'?>"><i class="fa fa-home"></i> <span>Slider</span></a></li>
        <li><a href="<?=base_url().'User'?>"><i class="fa fa-users"></i> <span>User</span></a></li>
        <li><a href="<?=base_url().'Info'?>"><i class="fa fa-info"></i> <span>Informasi</span></a></li>
        <li class="treeview"><a href="<?=base_url().'Product'?>"><i class="fa fa-product-hunt"></i> <span>Product</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url().'Product/deskripsi'?>"><i class="fa fa-angle-right"></i> <span>Deskripsi</span></a></li>
            <li> <a href="<?=base_url().'Product'?>"><i class="fa fa-angle-right"></i> <span>Data Product</span></a></li>
          </ul>
        </li>
        <li class="treeview"><a href=""><i class="fa fa-wrench"></i> <span>Solutions</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url().'Servis/deskripsi'?>"><i class="fa fa-angle-right"></i> <span>Deskripsi</span></a></li>
              <li><a href="<?=base_url().'Servis'?>"><i class="fa fa-angle-right"></i> <span>Data Servis</span></a></li>
              <!--<li> <a href="<?=base_url().'Product'?>"><i class="fa fa-angle-right"></i> <span>Data Product</span></a></li>-->
          </ul>
        </li>
       <!-- <li class="treeview"><a href=""><i class="fa fa-database"></i> <span>Data Center</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url().'Video/deskripsi'?>"><i class="fa fa-angle-right"></i> <span>Deskripsi</span></a></li>
              <li><a href="<?=base_url().'Video'?>"><i class="fa fa-angle-right"></i> <span>Data Center</span></a></li>
          </ul>
        </li> -->
        <li><a href="<?=base_url().'Karir'?>"><i class="fa fa-graduation-cap"></i> <span>Karir</span></a></li>
        <li><a href="<?=base_url().'Mitra'?>"><i class="fa fa-male"></i> <span>Mitra</span></a></li>
        <li><a href="<?=base_url().'Client'?>"><i class="fa fa-user-secret"></i> <span>Client</span></a></li>
        <li class="treeview"><a href="<?=base_url().'Product'?>"><i class="fa fa-cog"></i> <span>Profile</span><span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url().'Profile/visi'?>"><i class="fa fa-angle-right"></i> <span>Visi dan Misi</span></a></li>
              <li><a href="<?=base_url().'Profile'?>"><i class="fa fa-angle-right"></i> <span>Data Profile</span></a></li>
          </ul>
        </li>
      </ul>
    </section>


  </aside>
  <?php } else { ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=base_url().'img/admin.png'?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?=$this->session->userdata('username_sess')?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="">
            <a href="<?=base_url().'Dashboard'?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li><a href="<?=base_url().'Upload'?>"><i class="fa fa-download"></i> <span>Download</span></a></li>
        </ul>
      </section>
    </aside>
  <?php } ?>

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





  		function gantiPassword()
  		{
  			save_method = 'add';
  			$('#formGP')[0].reset();
  			$('.form-group').removeClass('has-error');
  			$('.pass').show();
  			$('.help-block').empty();
  			$('#nikKaryawan').show();
  			$('#hapus').hide();
  			$('#gantiPassword').modal('show');
  			$('#btnSimpan').show();
  			$('.modal-title').text('Ganti Password');
  		}



  		function savePassword()
  		{
  			$('#btnSimpan').text('Menyimpan...');
  			$('#btnSimpan').attr('disabled', true);
  			var url = "<?=base_url().'__Login/gantiPassword';?>";
  			$.ajax({
  				url : url,
  				type : "POST",
  				data : $('#formGP').serialize(),
  				dataType : "JSON",
  				success : function(data)
  				{
  					if(data.status)
  					{
  						$('#gantiPassword').modal('hide');
  						swal({
  							title: 'Sukses!',
  							text: 'Penyimpanan berhasil',
  							type: 'success'
  						},
  						function(){
  					     window.location.href = '<?=base_url().'__Login/keluar'?>';
  						});
  					} else {
  						for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
  					}
  					$('#btnSimpan').text('Simpan');
            $('#btnSimpan').attr('disabled',false);
  				},
  				error: function (jqXHR, textStatus, errorThrown)
          {
  						swal("Oops", "Penyimpanan Gagal!", "error");
              $('#btnSimpan').text('Simpan');
              $('#btnSimpan').attr('disabled',false);

          }
  			});
  		}




  	</script>

  	<div class="modal fade" id="gantiPassword" role="dialog">
  		<div class="modal-dialog">
  					<!-- Modal content-->
  					<div class="modal-content">
  							<div class="modal-header">
  									<button type="button" class="close" data-dismiss="modal">×</button>
  									<h4 class="modal-title">Tambah Hak Register</h4>
  							</div>
  							<div class="modal-body">
  									<form class="class" id="formGP" action="#" method="post">
                      <div class="form-group">
                        <label for="">Password Lama</label>
                        <input type="password" name="passwordLama" class="form-control underline-input"  placeholder="*Masukan Password Lama...">
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
  									<button type="button" class="btn btn-raised btn-success" id="btnSimpan" onclick="savePassword()">Simpan</button>
  									<button type="button" id="hapus" class="btn btn-raised btn-danger" id="btnSimpan">Hapus Hak Register</button>
  									<button type="button" class="btn btn-raised btn-default" data-dismiss="modal">Cancel</button>
  								</div>
  							</div>
  					</div>
  			</div>
  	</div>
