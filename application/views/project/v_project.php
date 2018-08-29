<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data
			<small>Project</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Project</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
							<button class="btn btn-danger btn-sm pull-left" onclick="addProject()"><i class="fa fa-plus"></i> | Tambah Project</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="table-responsive">
              <table id="tabel" class="table table-bordered table-hover">
                <thead>
                <tr>
									<th>No</th>
									<th>kategori</th>
									<th>Dibuat Pada</th>
									<th>Nama Project</th>
									<th>Client</th>
									<th>Link</th>
									<th>Aksi</th>
                </tr>
                </thead>
                <tbody>
									<tr>
										<th>No</th>
										<th>kategori</th>
										<th>Dibuat Pada</th>
										<th>Nama Project</th>
										<th>Client</th>
										<th>Link</th>
										<th>Aksi</th>
	                </tr>
                </tbody>
              </table>
						</div>
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


<script>
    var table;
    $(document).ready(function () {
      table =  $('#tabel').DataTable({

                    "processing": true, //Feature control the processing indicator.
                    "language": {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo base_url().'Project/ajax_list'?>",
                        "type": "POST"
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [
                    {
                        "targets": [ 0 ], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                    ]

                });

    });
</script>

<script type="text/javascript">
        var save_method;

        $(document).ready(function(){

            $('input').change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $('select').change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });

						$('#editor').redactor({
                      buttons:["formatting","|","bold","italic","deleted","|","unorderedlist","orderedlist","outdent","indent","|","image", "video", "link", "table","|","alignment","|","horizontalrule"],
                      plugins: ['fontcolor'],
                      minHeight: 200,
                  });



      $('#dropify').dropify({
                messages: {
                      default: 'Choose file Jpg/JPEG/PNG max(500 kb)',
                      replace: 'Update',
                      remove:  'Remove',
                      error:   'error'
                  }
        });


      $('#formJ').on('submit', function(e){
                $('#btnSave').text('Menyimpan...');
                $('#btnSave').attr('disabled', true);
                var url;
                if(save_method == 'add'){
                    url = "<?=base_url().'Project/add';?>";
                } else {
                    url = "<?=base_url().'Project/update';?>";
                }
           e.preventDefault();
                $.ajax({
                     url:url,
                     method:"POST",
                     data:new FormData(this),
                     contentType: false,
                     cache: false,
                     processData:false,
                     success:function(data)
                     {
                       if(save_method == 'add')
                     {
                         $('#addLomba').modal('hide');
                         swal({
                             title: 'Sukses!',
                             text: 'Data berhasil di simpan',
                             type: 'success'
                         },
                         function(){
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
                        function(){
                            location.reload();
                        });
                     }
                     }
                });
      });

        });

        function addProject()
        {
            save_method = 'add';
            $('#formJ')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('label').hide();
            $('#addLomba').modal('show');
            $('.modal-title').text('Tambah Project');
        }

        function updateProject(id)
        {

            save_method = 'update';
            $('#formJ')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('label').show();

            $.ajax({
                url : "<?=base_url().'Project/get/'?>"+id,
                type : "GET",
                dataType : "JSON",
                success : function(data)
                {
										$('[name="id"]').val(data.id_project);
										$('[name="nama_project"]').val(data.nama_project);
										$('[name="dibuat_pada"]').val(data.dibuat_pada);
										$('[name="client"]').val(data.client);
										$('[name="link"]').val(data.link);
										$('[name="status"]').val(data.status);
										$('#editor').redactor('set', data.deskripsi);
                    $('.modal-title').text('Edit Project');
                    $('#addLomba').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown)
				        {
				            alert('Error get data from ajax');
				        }
							});
        }

        function removeProject(id)
        {
            swal({
              title: "Confirmation",
              text: "Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes!",
              closeOnConfirm: false
            },
            function(){
                $.ajax({
			            url : "<?=base_url().'Project/hapus/'?>"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                $('#confirm').modal('hide');
			                                swal({
			                                    title: 'Success!',
			                                    text: 'Project berhasil dihapus!!!',
			                                    type: 'success'
			                                },
			                                function(){
			                                    location.reload();
			                                });
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
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
                    <form class="form" id="formJ" action="#" method="post">
										<input type="hidden" name="id" value="">
										<div class="form-group">
											<label class="ace-file-input ace-file-multiple">Image</label>
											 <input multiple="" id="dropify" type="file" name="image">
										</div>
										<div class="form-group">
                        <label for="">Kategori</label>
                        <select class="form-control" name="status">
													<option value="Internal">Internal</option>
													<option value="Portopolio">Portopolio</option>
													<option value="Process">Process</option>
												</select>
                        <p class="help-block mb-0"></p>
                    </div>
										<div class="form-group">
                        <label for="">Nama Project</label>
                        <input type="text" name="nama_project" id="" placeholder="Nama Project" class="form-control" >
                        <p class="help-block mb-0"></p>
                    </div>
										<div class="form-group">
                        <label for="">Dibuat pada</label>
                        <input type="text" name="dibuat_pada" id="" placeholder="Dibuat Pada" class="form-control" >
                        <p class="help-block mb-0"></p>
                    </div>
										<div class="form-group">
                        <label for="">Client</label>
                        <input type="text" name="client" id="" placeholder="Client" class="form-control" >
                        <p class="help-block mb-0"></p>
                    </div>
										<div class="form-group">
                        <label for="">Link</label>
                        <input type="text" name="link" id="" placeholder="Link" class="form-control" >
                        <p class="help-block mb-0"></p>
                    </div>
										<div class="form-group">
                  	<label class="">Description</label>
		                	<textarea name="deskripsi" id="editor" class="form-control" data-iconlibrary="fa" rows="10" required></textarea>
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
