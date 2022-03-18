<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Tambah Golongan Warna
        </h3>
        <div class="row">    
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <form action="" method="POST" id="formcolor" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Nama Warna</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="name" name="name" type="text" required="">
                                                </div>
                                            </div>
                                            <button type="reset" class="btn pull-left">Batal</button>
                                            <button type="button" class="btn btn-primary pull-right" onclick="storeColor();">Simpan</button>
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
</div>
<script>
    function storeColor() {
        var valid = $("#formcolor").valid();
        if (valid == true) {
            var form = $('#formcolor').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Color/store_color') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataColor();
                }
            });
        }
    }
</script>