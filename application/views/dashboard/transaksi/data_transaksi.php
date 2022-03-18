<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Penjualan Offline Input Admin
        </h3>
        <div class="row" id="tableorder">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Data Order
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="tabletransaksioffline">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID</th> 
                                        <th>Pembeli</th>
                                        <th>Total</th>
                                        <th>Tanggal Order</th>
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
    <div id="detailorder"></div>
</div>
<script type="text/javascript">
    var table;
    function load_table_transaksi_offline(){
        Pace.start();
        table = $('#tabletransaksioffline').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('d/Transaksi/get_data_transaksi') ?>",
                "type": "POST",
                "data": function (data) {
                    data.orderMethod = "Offline";
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
    }
    function detail_order(id) {
        Pace.start();
        var id = id;
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                $('#detailorder').html(resp);
                $('#tableorder').hide();
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
                Pace.stop();
            }
        });
    }

    function delete_order(id) {
        var id = id;
        swal({
            title: "Anda akan menghapus data keseluruhan order dan data invoice ?",
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
                            dataTransaksi();
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