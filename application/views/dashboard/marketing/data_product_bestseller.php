<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Produk
            <button class="btn btn-primary pull-right" onclick="dataProduct();"><i class="fa fa-plus-square"></i></button>      
        </h3>
        <div class="row">
            <div id="dataresult"></div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataproduct">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Nama Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr class="">
                                        <td><img src="<?php
                                            echo site_url('asset/img/uploads/product/');
                                            echo $value->fotoName;
                                            ?>" style="max-width:120px;"></td>
                                        <td><?php echo $value->productName; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="hapus Item" onclick="deleteProductBest('<?php echo $value->id;?>');"><i class="fa fa-trash"></i></button>
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
<script>
    function deleteProductBest(id) {
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
                            url: "<?php echo base_url('d/Marketing/delete_product_bestseller'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataProductBestSeller();
                            }
                        });
                        swal("Terhapus!", "Image Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>