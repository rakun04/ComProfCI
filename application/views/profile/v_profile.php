<?php
$this->load->view('include/header');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-danger btn-sm pull-left" onclick="addProfile()"><i class="fa fa-pencil"></i>
                            | Edit Profile</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                Foto Profile
                            </div>
                            <div class="panel-body">
                                <center>
                                    <img src="<?=base_url().'img/profile/'.$detail->foto_profile?>" class="img-responsive">
                                </center>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <th>
                                            <?=$detail->alamat?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <th>
                                            <?=$detail->email?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <th>:</th>
                                        <th>
                                            <?=$detail->telepon?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <th>:</th>
                                        <th>
                                            <?=$detail->fax?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Jam Kerja</th>
                                        <th>:</th>
                                        <th>
                                            <?=$detail->jam_kerja?>
                                        </th>
                                    </tr>
                                </table>
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
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url().'Profile/ajax_list'?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                { extend: 'copy', className: 'btn-sm' },
                { extend: 'csv', title: 'ExampleFile', className: 'btn-sm' },
                { extend: 'pdf', title: 'ExampleFile', className: 'btn-sm' },
                { extend: 'print', className: 'btn-sm' }
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

            url = "<?=base_url().'Profile/add';?>";

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



    function addProfile() {

        save_method = 'add';
        $('#formJ')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('label').show();

        $.ajax({
            url: "<?=base_url().'Profile/get'?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id_profile);
                $('#editor').redactor('set', data.deskripsi);
                $('#editor1').redactor('set', data.visi);
                $('#editor2').redactor('set', data.misi);
                $('[name="alamat"]').val(data.alamat);
                $('[name="email"]').val(data.email);
                $('[name="telepon"]').val(data.telepon);
                $('[name="fax"]').val(data.fax);
                $('[name="jam_kerja"]').val(data.jam_kerja);
                $('.modal-title').text('Edit Profile');
                $('#addLomba').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
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
                        <label class="">Description</label>
                        <textarea name="deskripsi" id="editor" class="form-control" data-iconlibrary="fa" rows="10" required><?php echo htmlspecialchars(set_value('deskripsi'));?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="">Alamat</label>
                        <textarea name="alamat" id="editor3" class="form-control" data-iconlibrary="fa" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="">Email</label>
                        <input type="text" name="email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="">Telepon</label>
                        <input type="text" name="telepon" placeholder="Telepon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="">Fax</label>
                        <input type="text" name="fax" placeholder="Fax" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="">Jam Kerja</label>
                        <input type="text" name="jam_kerja" placeholder="Jam Kerja" class="form-control" required>
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