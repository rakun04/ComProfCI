<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data
            <small>Product</small>
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
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-danger btn-sm pull-left" onclick="addProduct()"><i class="fa fa-plus"></i>
                            | Tambah Product</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tabel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dibuat Pada</th>
                                        <th>Nama Product</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Dibuat Pada</th>
                                        <th>Nama Product</th>
                                        <th>Kategori</th>
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
        table = $('#tabel').DataTable({

            "processing": true, //Feature control the processing indicator.
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url().'Product/ajax_list'?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ]

        });

    });
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


        $('#formJ').on('submit', function (e) {
            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?=base_url().'Product/add';?>";
            } else {
                url = "<?=base_url().'Product/update';?>";
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

    function addProduct() {
        save_method = 'add';
        $('#formJ')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').hide();
        $('#addLomba').modal('show');
        $('.modal-title').text('Tambah Product');
    }

    function updateProduct(id) {

        save_method = 'update';
        $('#formJ')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').show();

        $.ajax({
            url: "<?=base_url().'Product/get/'?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id_product);
                $('[name="nama_product"]').val(data.nama_product);
                $('[name="id_sub_kategori"]').val(data.id_sub_kategori);
                $('[name="dibuat_pada"]').val(data.dibuat_pada);
                $('#editor').redactor('set', data.deskripsi);
                $('.modal-title').text('Edit Product');
                $('#addLomba').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function removeProduct(id) {
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
                    url: "<?=base_url().'Product/hapus/'?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        $('#confirm').modal('hide');
                        swal({
                            title: 'Success!',
                            text: 'Product berhasil dihapus!!!',
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
                <form class="form" id="formJ" action="#" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_sub_kategori" class="form-control" required>
                        <?php $kategori=$this->MModel->getData("select * from sub_kategori");
                        if($kategori){
                        foreach($kategori as $k){ ?>
                            <option value="<?=$k['id_sub_kategori']?>"><?=$k['nama_sub_kategori']?></option>
                        <?php } } ?>
                        </select>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label class="ace-file-input ace-file-multiple">Image</label>
                        <input multiple="" id="dropify" type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Product</label>
                        <input type="text" name="nama_product" id="" placeholder="Nama Product" class="form-control" required>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Dibuat pada</label>
                        <input type="text" name="dibuat_pada" id="" placeholder="Dibuat Pada" class="form-control" required>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label class="">Description</label>
                        <textarea name="deskripsi" id="editor" class="form-control" data-iconlibrary="fa" rows="10" required><?php echo htmlspecialchars(set_value('deskripsi'));?></textarea>
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