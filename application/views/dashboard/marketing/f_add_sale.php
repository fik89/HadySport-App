<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Atur Diskon Produk <b><?php echo $data->productName. ", Harga awal : Rp " .number_format($data->price); ?> </b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <form action="" method="POST" id="formproductsale" enctype="multipart/form-data">
                                    <input type="hidden" name="idproduct" id="idproduct" value="<?php echo $data->idproduct; ?>">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Harga Diskon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="money form-control" id="pricesale" name="pricesale" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tanggal Awal Diskon </label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="startdate" name="startdate" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tanggal Akhir Diskon </label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="enddate" name="enddate" required="">
                                        </div>
                                    </div>
                                    <button type="button" class="btn pull-left" onclick="dataProduct();">Batal</button>
                                    <button type="button" class="btn btn-primary pull-right" onclick="storeSaleProduct('<?php echo $data->idproduct; ?>');">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function storeSaleProduct() {
        var valid = $("#formproductsale").valid();
        if (valid == true) {
            var form = $('#formproductsale').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Marketing/store_sale_product') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataProduct();
                }
            });
        }
    }
</script>