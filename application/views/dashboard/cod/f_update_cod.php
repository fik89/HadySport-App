<div class="panel panel-green">
    <div class="panel-heading">
        Update COD
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="coddesc">
                            <input type="hidden" name="id" value="<?php echo $datacod->idcod;?>">

                            <div class="form-group">
                                <label>Lokasi</label>
                                <input class="form-control" name="lokasi" id="lokasi" type="text" required="" value="<?php echo $datacod->lokasi;?>">
                            </div>
                            <div class="form-group">
                                <label>Ongkir</label>
                                <input class="form-control" name="ongkir" id="ongkir" type="number" required="" value="<?php echo $datacod->ongkir;?>">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input class="form-control money" name="deskripsi" id="deskripsi" type="textarea" required="" value="<?php echo $datacod->deskripsi;?>">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input class="form-control" name="status" id="status" type="text" required="" value="<?php echo $datacod->status;?>">
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-default btn-block">Reset</button>
                            </div>
                            <div class="col-md-6">
                                <input type="button" onclick="storecod();" class="btn btn-success btn-block" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function storecod() {
        var valid = $("#coddesc").valid();
        if (valid == true) {
            var form = $('#coddesc').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Home/update_cod') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    datacod();
                }
            });
        }
    }
</script>