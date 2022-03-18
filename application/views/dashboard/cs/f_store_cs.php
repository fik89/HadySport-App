<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Tambah Customer Service
        </h3>
        <div class="row">    
            <div class="panel panel-green">
                <div class="panel-heading">
                    Tambah Customer Service
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <form action="" method="POST" id="formcs" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Nama CS</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="name" name="name" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Nomor WA ( Penulisan harus diawali kode negara tanpa + ) 62812345678</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="phone" name="phone" type="text" required="">
                                                </div>
                                            </div>
                                            <button type="reset" class="btn pull-left">Batal</button>
                                            <button type="button" class="btn btn-primary pull-right" onclick="storeCs();">Simpan</button>
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
    function storeCs() {
        var valid = $("#formcs").valid();
        if (valid == true) {
            var form = $('#formcs').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Cs/store_cs') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataCs();
                }
            });
        }
    }
</script>