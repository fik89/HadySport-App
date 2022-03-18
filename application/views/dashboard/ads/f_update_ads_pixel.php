    <div class="panel panel-green">
        <div class="panel-heading">
            Ads Fb Pixel
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <form action="" method="POST" id="formupdateads" enctype="multipart/form-data">
                                    <input type="hidden" value="<?php echo $ads->idads;?>" name="id" id="id">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tracking Tool Name </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?php echo $ads->adsName;?>" name="adsname" id="adsname" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ID Pixel</label>
                                        <div class="col-sm-9">
                                            <input class="textarea form-control" name="adsscript" id="adsscript" required="" value="<?php echo $ads->adsScript;?>">
                                        </div>
                                    </div>
                                    <button onclick="dataAdsFbPixel();" class="btn pull-left">Batal</button>
                                    <button type="button" class="btn btn-primary pull-right" onclick="updateAdsFbPixel();">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function updateAdsFbPixel() {
        var valid = $("#formupdateads").valid();
        if (valid == true) {
            var form = $('#formupdateads').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Ads/update_ads') ?>',
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