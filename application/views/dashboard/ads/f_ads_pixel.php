<div class="alert alert border-grey" alert-dismissable>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Penting!!!</strong><br>
    Anda dapat membaca dokumentasi dari Facebook untuk mendapatkan Pixel, yang dibutuhkan disini hanya ID Pixel yang sudah Anda buat.<br> 
    <a href="https://id-id.facebook.com/business/help/314143995668266" target="_blank">https://id-id.facebook.com/business/help/314143995668266</a>
    <br>Penjelasan lebih detail dapat di baca di menu Dokumentasi.
</div>    
<div class="panel panel-green">
    <div class="panel-heading">
        Fb Pixel <strong>Anda hanya di perbolehkan mendaftarkan 1 Pixel saja pada Website ini.</strong>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <form action="" method="POST" id="formadsfbpixel" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Tracking Tool Name </label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="adsname" name="adsname" required="">
                                            <option value="">Pilih Tracking Tool</option>
                                            <option value="FB Pixel">FB Pixel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">ID Pixel</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="adsscript" id="adsscript" required="">
                                    </div>
                                </div>
                                <button type="reset" class="btn pull-left">Batal</button>
                                <button type="button" class="btn btn-primary pull-right" onclick="storeAdsFbPixel();">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function storeAdsFbPixel() {
        var valid = $("#formadsfbpixel").valid();
        if (valid == true) {
            var form = $('#formadsfbpixel').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Ads/store_ads') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataAdsFbPixel();
                }
            });
        }
    }
</script>