<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Order Online
            <span class="action pull-right">
                <button class="btn btn-sm btn-success " onclick="dataOrder('closing paid');"><i class="fa fa-shopping-cart"></i></button>
            </span>
        </h3>
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Note: </strong> Gunakan filter sesuai dengan status order & gunakan button proses untuk memproses order(cetak invoice, kirim nomor resi, dll)
        </div>
        
        <div id="detailorder"></div>
        <div class="row" id="tableorder">
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
                                        <label for="type" class="control-label">Status</label>
                                        <select class="form-control" name="statusorder" id="statusorder">
                                            <option value="" selected="" disabled="">Pilih Type</option>
                                            <option value="add to cart">Add to Cart</option>
                                            <option value="place order">Place Order</option>
                                            <option value="closing paid">Closing Paid</option>
                                            <option value="expired">Expired</option>
                                            <option value="reject">Reject</option>
                                            <option value="canceled">Canceled</option>
                                            <option value="process shiping">process shiping</option>
                                            <option value="finish">finish</option>
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
                            Data Order Online
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%" id="tableorderall">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID</th> 
                                        <th>ID User</th>
                                        <th>IP</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
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
       function load_table_order() {
        Pace.start();
        table = $('#tableorderall').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('d/Sales/get_data_order_all') ?>",
                "type": "POST",
                "data": function (data) {
                     data.tglawal = $('#tglawal').val();
                     data.tglakhir = $('#tglakhir').val();
                     data.statusorder = $('#statusorder').val();
                     data.ordermethod = 'online';
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
                "targets": [0,6],
                "orderable": false,
            },
            ],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
                "info": "Menampilan _START_ sampai _END_ dari <span class='label label-default'>_TOTAL_</span> total data",
                "infoEmpty": "Tidak ada Data untuk ditampilkan",
                "infoFiltered": "",
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
    function detailOrder(id) {
        var id = id;
        $('#loader').show();
        $('#detailorder').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                $('#detailorder').html(resp);
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    function delete_order(id) {
        var id = id;
        swal({
            title: "",
            text: "Anda akan menghapus data keseluruhan order dan data invoice ?",
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
                            url: '<?php echo base_url('d/Sales/delete_data_order'); ?>',
                            method: "POST",
                            dataType: "json",
                            accepts: {
                                json: 'application/json'
                            },
                            data: {"id": id},
                            success: function (resp) {
                                if(resp.status == 0){
                                    swal("",""+resp.message+"","error");
                                }else{
                                    swal("",""+resp.message+"","success");
                                    table.ajax.reload();
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
</script>