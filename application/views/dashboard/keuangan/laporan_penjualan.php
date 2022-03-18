<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Penjualan
        </h3>
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
                                        <label for="status" class="control-label">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="" selected="" disabled="">Pilih Status</option>
                                            <option value="add to cart">add to cart</option>
                                            <option value="place order">place order</option>
                                            <option value="closing unpaid">closing unpaid</option>
                                            <option value="closing paid">closing paid</option>
                                            <option value="PAID">PAID</option>
                                            <option value="process shiping">process shiping</option>
                                            <option value="selesai">selesai</option>
                                            <option value="reject">reject</option>
                                            <option value="canceled">canceled</option>
                                            
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

                    <div class="col-md-4">
                        <div class="panel-header with-border">
                            <h5 class="panel-heading" >
                                <button type="button" class="btn btn-sm btn-primary" data-target="#modalexport" data-toggle="modal">Export Data</button>
                            </h5>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Data Penjualan
                            <button class="btn btn-sm btn-default pull-right" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="tablepenjualan">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID Order</th>
                                        <th>Type</th> 
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Voucher</th>
                                        <th>Nama</th>
                                        <th>Alamat Detail</th>
                                        <th>Alamat Input</th>
                                        <th>Jenis Member</th>
                                        <th>Tgl. Order</th>
                                        <th>Status</th>
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
<div class="modal fade" id="modalexport">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white text-center">
                Export Penjualan
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Periode</label>
                    <select class="form-control" name="periode" id="periode" onchange="choosePeriode();">
                        <option>Pilih Periode</option>
                        <option value="all">All Data</option>
                        <option value="bydate">Berdasarkan tanggal</option>
                    </select>
                </div>
                <div class="form-group" id="sdate">
                    <label>Tanggal Awal</label>
                    <input type="date" name="startdate" id="startdate" class="form-control">
                </div>
                <div class="form-group" id="ndate">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="enddate" id="enddate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                    <select class="form-control" name="statusexport" id="statusexport">
                        <option value="" selected="" disabled="">Pilih Status</option>
                        <option value="">All</option>
                        <option value="add to cart">add to cart</option>
                        <option value="place order">place order</option>
                        <option value="closing unpaid">closing unpaid</option>
                        <option value="closing paid">closing paid</option>
                        <option value="PAID">PAID</option>
                        <option value="process shiping">process shiping</option>
                        <option value="selesai">selesai</option>
                        <option value="reject">reject</option>
                        <option value="canceled">canceled</option>

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-primary" onclick="exportpenjualan();">Cetak</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
    function load_table_penjualan(){
        Pace.start();
        table = $('#tablepenjualan').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('d/Keuangan/get_data_penjualan') ?>",
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

    function choosePeriode(){
       $('#ndate').hide();
       $('#sdate').hide();
       var period = $('#periode').val();
       if (period === "bydate"){
        $('#ndate').show("slow");
        $('#sdate').show("slow");
    }
}

    function exportpenjualan(){
       var sdate = $('#startdate').val();
       var ndate = $('#enddate').val();
       var periode = $('#periode').val();
       var status = $('#statusexport').val();
       if(periode == 'all'){
            window.open('<?php echo base_url('d/Exportdata/export_penjualan?startdate=')?>'+ sdate +'&enddate='+ ndate+'&status='+status);
       }else{   
            if(sdate == '' && ndate == ''){
            swal("","Pilih tanggal terlebih dahulu","error");
            }else{
                window.open('<?php echo base_url('d/Exportdata/export_penjualan?startdate=')?>'+ sdate +'&enddate='+ ndate+'&status='+status);
            }
        }
    }
</script>