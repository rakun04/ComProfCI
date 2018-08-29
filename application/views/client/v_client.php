<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data
            <small>Client</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Client</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-danger btn-sm pull-left" onclick="addClient()"><i class="fa fa-plus"></i>
                            | Tambah Client</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tabel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Client</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Client</th>
                                        <th>Email</th>
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
                "url": "<?php echo base_url().'Client/ajax_list'?>",
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


        $('#formJ').on('submit', function (e) {
            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?=base_url().'Client/add';?>";
            } else {
                url = "<?=base_url().'Client/update';?>";
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
                    if (data.status) {
                        $('#addLomba').modal('hide');
                        swal({
                            title: 'Sukses!',
                            text: 'Penyimpanan berhasil',
                            type: 'success'
                        },
                            function () {
                                location.reload();
                            });
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                }
            });
        });

    });

    function addClient() {
        save_method = 'add';
        $('#formJ')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').hide();
        $('#addLomba').modal('show');
        $('.modal-title').text('Tambah Client');
    }

    function updateClient(id) {

        save_method = 'update';
        $('#formJ')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').show();

        $.ajax({
            url: "<?=base_url().'Client/get/'?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id_client);
                $('[name="nama_client"]').val(data.nama_client);
                $('[name="email"]').val(data.email);
                $('[name="say"]').val(data.say);
                $('.modal-title').text('Edit Client');
                $('#addLomba').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function removeClient(id) {
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
                    url: "<?=base_url().'Client/hapus/'?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        $('#confirm').modal('hide');
                        swal({
                            title: 'Success!',
                            text: 'Client berhasil dihapus!!!',
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
                        <label for="">Nama Client</label>
                        <input type="text" name="nama_client" id="" placeholder="Nama Client" class="form-control" required>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" placeholder="Email" class="form-control" required>
                        <p class="help-block mb-0"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggapan</label>
                        <textarea type="text" name="say" id="" placeholder="Tanggapan " class="form-control" rows="3" required></textarea>
                        <p class="help-block mb-0"></p>
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