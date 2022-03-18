
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Request Retur Produk
        </h3>
        <div id="datadetailretur"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="margin-top: -20px;">

                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-header with-border">
                                <h5 class="panel-heading" > Gunakan Filter : 
                                    <button type="button" class="btn btn-box-tool" data-toggle="collapse" href="#collapse1"><i class="fa fa-filter"></i>
                                    </button>
                                </h5>
                            </div>
                            <div  id="collapse1" class="panel-collapse collapse">
                                <form id="form-filter">
                                    <div class="form-group">
                                        <label for="tglawal" class="control-label">Tanggal Awal</label>
                                        <input type="date" name="tglawal" id="tglawal" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="tglakhir" class="control-label">Tanggal Akhir</label>
                                        <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label">status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="" selected="" disabled="">Pilih status</option>
                                            <option value="submit">Submit</option>
                                            <option value="confirmed">Confirmed</option>

                                        </select>
                                    </div>
                                    <div class="panel-footer">
                                        <button type="button" id="btn-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Filter</button>
                                        <button type="reset" id="btn-reset" class="btn btn-default"><i class="fa fa-close"></i> Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Data Request Retur
                            <button class="btn btn-sm btn-default pull-right" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="tableretur">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID Retur</th> 
                                        <th>ID Produk</th>
                                        <th>ID Order</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Email Confirm</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
    function load_table_retur() {
        Pace.start();
        table = $('#tableretur').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('d/Retur/get_data_retur') ?>",
                "type": "POST",
                "data": function (data) {
                    data.tglawal = $('#tglawal').val();
                    data.tglakhir = $('#tglakhir').val();
                    data.status = $('#status').val();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    switch (jqXHR.status)
                    {
                        case 403:
                        swal({
                            title: "Your Session was Expired, Please Re-login",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#008000",
                            confirmButtonText: "Re-login",
                            showLoaderOnConfirm: true,
                            closeOnConfirm: true,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                location.href = "<?php echo base_url('d/Home'); ?>";
                            }
                        }
                        );
                        break;
                    }
                },
            },
            "columnDefs": [
            {
                "targets": [0],
                "orderable": false,
            },
            ],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
                "info": "Menampilan _START_ sampai _END_ dari <span class='label label-default'>_TOTAL_</span> total data",
                "infoEmpty": "Tidak ada Data untuk ditampilkan",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "zeroRecords": "Tidak ada data untuk ditampilkan",
                "loadingRecords": "<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i> Loading...",
                "processing": "<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i> Processing...",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "<i class='fa fa-chevron-right'></i>",
                    "previous": "<i class='fa fa-chevron-left'></i>"
                },
            }
        });
        Pace.stop();
        $('#btn-filter').click(function () {
            Pace.start();
            table.ajax.reload();
            Pace.stop();
        });
        $('#btn-reset').click(function () {
            Pace.start();
            $('#form-filter')[0].reset();
            table.ajax.reload();
            Pace.stop();
        });
        $('#btn-refresh').click(function () {
            Pace.start();
            table.ajax.reload();
            Pace.stop();
        });
    }
    function detail_retur(id) {
        Pace.start();
        var id = id;
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Retur/detail_retur') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
                $('#datadetailretur').show();
                $('#datadetailretur').html(resp);
                $(".textarea").wysihtml5();
                $('#loader').hide();
                check_status_retur();
                Pace.stop();
            }
        });
    }

    function delete_retur(id) {
        var id = id;
        swal({
            title: "",
            text:"Anda akan menghapus data keseluruhan ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '<?php echo base_url('d/Retur/delete_data_retur'); ?>',
                    method: "POST",
                    dataType: "json",
                    accepts: {
                        json: 'application/json'
                    },
                    data: {"id": id},
                    success: function (resp) {
                        if (resp.status == 0) {
                            swal("", "" + resp.message + "", "error");
                        } else {
                            swal("", "" + resp.message + "", "success");
                             table.ajax.reload()
                        }
                    },
                    error: function (resp) {
                        swal("error, error_code: " + resp.status);
                    }
                });
            } else {
                swal("", "", "error");
            }
        });
    }


    function send_email_confirm(id) {
        var id;
        swal({
            title: "Kirim Email konfirmasi?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Kirim",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: 'Sedang mengirim email!',
                    text: 'Mohon tunggu',
                    imageUrl: '<?php echo base_url('asset/img/icons/loading.gif'); ?>',
                    imageWidth: 30,
                    imageHeight: 30,
                    showCancelButton: false,
                    showConfirmButton: false
                });
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('d/Retur/send_email_konfirmasi'); ?>',
                    data: {id: id},
                    success: function (response) {
                        $('#alert').html(response);
                        table.ajax.reload();
                        swal.close();
                    },
                    error: function (response) {
                        swal("", "Internal server error, error_code: " + response.status + "", "error");
                    }
                });

            } else {
                swal("", "", "error");
            }
        });
    }
</script>