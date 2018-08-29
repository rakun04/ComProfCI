<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Detail Product
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Product</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<u><h4>Detail Servis</h4></u>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="panel panel-default">
							<!--<img src="<?=base_url().'img/servis/'.$detail->img_servis?>" class="img-responsive">-->
							<div class="panel-heading">
								<?=$detail->nama_servis?>
							</div>
							<div class="panel-body>">
								<h4>Deskripsi :</h4>
								<?=$detail->deskripsi?>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
							<button class="btn btn-danger btn-sm pull-left" onclick="addServis()"><i class="fa fa-plus"></i>
								| Tambah Sub Servis</button>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php $data=$this->MModel->getData("select * from sub_kategori where id_servis='$detail->id_servis'");
						if($data){
						foreach ($data as $d) { ?>
							<div class="box-group" id="accordion">
									<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
									<div class="panel box box-success">
									  <div class="box-header with-border">
										<h4 class="box-title">
										  <a data-toggle="collapse" data-parent="#accordion" href="#<?=$d['id_sub_kategori']?>" aria-expanded="false" class="">
											<?=$d['nama_sub_kategori']?>	
										  </a>
										</h4>
										<button class="btn btn-danger btn-xs pull-right" onclick="removeServis(<?=$d['id_sub_kategori']?>)"><i class="fa fa-trash"></i></button>
										<button class="btn btn-success btn-xs pull-right" onclick="updateServis(<?=$d['id_sub_kategori']?>)"><i class="fa fa-pencil"></i></button>
										
									  </div>
									  <div id="<?=$d['id_sub_kategori']?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
										<div class="box-body">
                                           <div class="row">
                                            <div class="col-md-4">
                                                <img class="img-responsive" src="<?=base_url().'img/servis/sub/'.$d['img_sub']?>">
                                            </div>
                                            <div class="col-md-8">
                                                <?=$d['deskripsi_sub_kategori']?>
                                            </div>
                                           </div>
										  
										</div>
									  </div>
									</div>
								  </div>
						<?php } } ?>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>

		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>


<?php $this->load->view('include/footer'); ?>
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

        $('#editor').redactor({
            buttons: ["formatting", "|", "bold", "italic", "deleted", "|", "unorderedlist", "orderedlist", "outdent", "indent", "|", "image", "video", "link", "table", "|", "alignment", "|", "horizontalrule"],
            plugins: ['fontcolor'],
            minHeight: 200,
        });



        $('#dropify').dropify({
            messages: {
                default: 'Choose file Jpg/JPEG/PNG max(500 kb)',
                replace: 'Update',
                remove: 'Remove',
                error: 'error'
            }
        });


        $('#formX').on('submit', function (e) {
            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?=base_url().'Servis/addSubServis';?>";
            } else {
                url = "<?=base_url().'Servis/updateSubServis';?>";
            }
            e.preventDefault();
            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (save_method == 'add') {
                        $('#addLomba').modal('hide');
                        swal({
                            title: 'Sukses!',
                            text: 'Data berhasil di simpan',
                            type: 'success'
                        },
                            function () {
                                location.reload();
                            });
                    }
                    else {
                        $('#addLomba').modal('hide');
                        swal({
                            title: 'Sukses!',
                            text: 'Data berhasil di ubah',
                            type: 'success'
                        },
                            function () {
                                location.reload();
                            });
                    }
                }
            });
        });

    });

    function addServis() {
        save_method = 'add';
        $('#formX')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').hide();
        $('#addLomba').modal('show');
        $('.modal-title').text('Tambah Sub Kategori');
    }

    function updateServis(id) {

        save_method = 'update';
        $('#formX')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').show();

        $.ajax({
            url: "<?=base_url().'Servis/getSubServis/'?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id_sub_kategori);
                $('[name="nama_sub_kategori"]').val(data.nama_sub_kategori);
                $('#editor').redactor('set', data.deskripsi_sub_kategori);
                $('.modal-title').text('Edit Servis');
                $('#addLomba').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function removeServis(id) {
        swal({
            title: "Confirmation",
            text: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            closeOnConfirm: false
        },
            function () {
                $.ajax({
                    url: "<?=base_url().'Servis/hapusSubServis/'?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        $('#confirm').modal('hide');
                        swal({
                            title: 'Success!',
                            text: 'Servis berhasil dihapus!!!',
                            type: 'success'
                        },
                            function () {
                                location.reload();
                            });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            });
    }



</script>
<div class="modal fade" id="addLomba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form" id="formX" action="#" method="post">
					<input type="hidden" name="id" value="">
					<input type="hidden" name="id_servis" value="<?=$detail->id_servis?>">
                    <div class="form-group">
                        <label class="ace-file-input ace-file-multiple">Image</label>
                        <input multiple="" id="dropify" type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Sub Servis</label>
                        <input type="text" name="nama_sub_kategori" id="" placeholder="Nama Sub Servis" class="form-control" required>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label class="">Description</label>
                        <textarea name="deskripsi_sub_kategori" id="editor" class="form-control" data-iconlibrary="fa" rows="10" required><?php echo htmlspecialchars(set_value('deskripsi_sub_kategori'));?></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-raised btn-success" id="btnSave" onclick="">Save</button>
                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>