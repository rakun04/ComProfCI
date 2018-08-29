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
							<u><h4>Deskripsi Solusi</h4></u>
							<button onclick="addDeskripsi()" class="btn btn-danger btn-sm pull-right">Update Deskripsi</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="panel panel-default">

								<div class="panel-body">
									<p><?=$detail->desc_solution?></p>
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

		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>


<?php $this->load->view('include/footer'); ?>

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






      $('#formJ').on('submit', function(e){
                $('#btnSave').text('Menyimpan...');
                $('#btnSave').attr('disabled', true);
                var url;
                if(save_method == 'add'){
                    url = "<?=base_url().'Servis/updateDeskripsi';?>";
                } else {
                    url = "<?=base_url().'Product/update';?>";
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

        function addDeskripsi()
        {
            save_method = 'add';
            $('#formJ')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('label').hide();
            $('#addLomba').modal('show');
            $('.modal-title').text('Tambah Product');
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
                  	<label class="">Description</label>
		                	<textarea name="deskripsi" id="editor" class="form-control" data-iconlibrary="fa" rows="10" required><?php echo htmlspecialchars(set_value('deskripsi'));?><?=$detail->desc_solution?></textarea>
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
