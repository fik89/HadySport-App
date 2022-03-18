<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Unggah Data Voucher
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12" id="formfoto">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-horizontal">
                                    <form action="" method="POST" id="formvoucher" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Nama Voucher</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="vouchername" name="vouchername" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Harga Voucher</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="money form-control" id="voucherprice" name="voucherprice" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Deskripsi Voucher</label>
                                            <div class="col-sm-9">
                                                <textarea row="7" class="form-control" id="voucherdesc" name="voucherdesc" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Kode Voucher | <span class="text-danger"><b><small>case sensitive, jangan gunakan spasi</small></b></span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="price form-control" id="vouchercode" name="vouchercode" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Tanggal Awal voucher </label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="startdate" name="startdate" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Tanggal Akhir voucher </label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="enddate" name="enddate" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Minimum Belanja (Rupiah)</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="money form-control" id="minprice" name="mintransaction" required="" placeholder="Voucher dapat di gunakan jika minimum belanja terpenuhi">
                                            </div>
                                        </div>
                                        <button type="button" class="btn pull-left" onclick="dataProduct();">Batal</button>
                                        <button type="button" class="btn btn-primary pull-right" onclick="storeVoucher();">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function storeVoucher() {
        var valid = $("#formvoucher").valid();
        if (valid == true) {
            var form = $('#formvoucher').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Marketing/store_voucher') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataVoucher();
                }
            });
        }
    }
</script>