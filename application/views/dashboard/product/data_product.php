<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Produk
            <button class="btn btn-primary pull-right" onclick="fUploadProduct();"><i class="fa fa-upload"></i> Upload Produk</button>      
        </h3>
        <div class="row">
            <div id="dataresult"></div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="tableproduct">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Cover</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Stok</th>
                                    <th>Upload By</th>
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
<script>
    var table;
       function load_table_product() {
        Pace.start();
        table = $('#tableproduct').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('d/Product/get_data_product') ?>",
                "type": "POST",
                "data": function (data) {
//                     data.tglawal = $('#tglawal').val();
//                     data.tglakhir = $('#tglakhir').val();
//                     data.statusorder = $('#statusorder').val();
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
                "targets": [0,1],
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
    
    function updateStock(id) {
        var stock = $('#stock' + id).val();
        $.ajax({
            url: "<?php echo site_url('d/Product/update_stock'); ?>",
            method: "POST",
            data: {"id": id, "stock": stock},
            success: function (data) {
                $('#alert').html(data);
                table.ajax.reload();
            }
        });
    }
    function fUpdate(id) {
        $.ajax({
            url: "<?php echo site_url('d/Product/f_update_product'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                loadPhotoEdit();
                $('.money').mask('0.000.000.000', {reverse: true});
                $(".textarea").wysihtml5();
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
            }
        });
    }
    function fAddSale(id) {
        $.ajax({
            url: "<?php echo site_url('d/Marketing/f_add_sale_product'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                $(".textarea").wysihtml5();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    function AddBestSeller(id) {
        $.ajax({
            url: "<?php echo site_url('d/Marketing/add_product_bestseller'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                $(".textarea").wysihtml5();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    $(document).on('click', '.delproduct', function () {
        var idupload = $(this).data("idupload");
        var id = $(this).data("idproduct");
        swal({
            title: "Hapus Produk ini ?",
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
                            url: '<?php echo base_url('d/Product/delete_product'); ?>',
                            method: "POST",
                            data: {"idproduct": id, "idupload": idupload},
                            success: function (data) {
                                $('#alert').html(data);
                                dataProduct();
                                $(".alert").fadeTo(3500, 0).slideUp(500, function () {
                                    $(this).remove();
                                });
                            }
                        });
                        swal("Terhapus!", "Produk Anda Terhapus", "success");
                    } else {
                        swal("", "Produk Anda Masih Tersimpan", "error");
                    }
                });
    });
</script>