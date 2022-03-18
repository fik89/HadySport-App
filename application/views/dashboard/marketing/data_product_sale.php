<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Produk Sale
            <button class="btn btn-primary pull-right" onclick="dataProduct();"><i class="fa fa-plus"></i></button>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataproductsale">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Normal</th>
                                    <th>Harga diskon</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr class="">
                                        <td><?php echo $value->productName; ?></td>
                                        <td class="money"><?php echo "Rp " . $value->price; ?></td>
                                        <td><?php echo "Rp " . $value->pricesale; ?></td>
                                        <td><input class="form-control" type="date" name="startdate<?php echo $value->idproductsale; ?>" id="startdate<?php echo $value->idproductsale; ?>" value="<?php echo $value->startDate; ?>"></td>
                                        <td><input class="form-control" type="date" name="enddate<?php echo $value->idproductsale; ?>" id="enddate<?php echo $value->idproductsale; ?>" value="<?php echo $value->endDate; ?>"></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update" id="<?php echo $value->idproductsale; ?>" onclick="updateProductSale('<?php echo $value->idproductsale; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="delproductsale btn btn-sm btn-danger" data-toggle="tooltip" title="hapus" data-idproductsale="<?php echo $value->idproductsale; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>

<div id="dataresult"></div>
<script>
    function updateProductSale(id) {
        var startdate = $('#startdate' + id).val();
        var enddate = $('#enddate' + id).val();
        $.ajax({
            url: "<?php echo site_url('d/Marketing/update_product_sale'); ?>",
            method: "POST",
            data: {"id": id, "startdate": startdate, "enddate": enddate},
            success: function (data) {
                $('#alert').html(data);
                dataProductSale();
            }
        });
    }

    $(document).on('click', '.delproductsale', function () {
        var id = $(this).data("idproductsale");
        swal({
            title: "Hapus Item ini ?",
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
                            url: '<?php echo base_url('d/Marketing/delete_product_sale'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataProductSale();
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    });
</script>