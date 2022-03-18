<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Tambah Lokasi Ongkir
        </h3>
<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
         Tambah Ongkir
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <form action="" method="POST" id="formfootertagline" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Lokasi</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Ongkir</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="ongkir" name="ongkir" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Deskripsi (max 160 char) </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" class="form-control" id="desc" name="desc" required="" maxlength="160"></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn pull-left" onclick="dataFooterTagline();">Batal</button>
                                    <button type="button" class="btn btn-primary pull-right" onclick="storeFooterTagline();">Simpan</button>
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
<script>
    function storeFooterTagline() {
        var valid = $("#formfootertagline").valid();
        if (valid == true) {
            var form = $('#formfootertagline').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Design/store_footer_tagline') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataFooterTagline();
                }
            });
        }
    }
</script>