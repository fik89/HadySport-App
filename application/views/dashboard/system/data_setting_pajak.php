<div class="row">
    <div class="action pull-right">
    </div> 

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Setting Pajak
                </h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="tax" class="col-sm-2 control-label">Jumlah Pajak dalam % wajib numerik. misal 0<span class="text-info" data-toggle="tooltip" title=""><i class="fa fa-question-circle fa-fw"></i></span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="tax" id="tax" value="<?php echo $profile->taxProduct; ?>" placeholder="wajib nummerik">
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <button class="btn btn-success" onclick="updatePajak('<?php echo $profile->id;?>');">Simpan</button>
                </div>

            </div>
        </div>
    </div>    
</div>


<script type="text/javascript">
    function updatePajak(id) {
        var tax = $('#tax').val();
        $.ajax({
            url: "<?php echo base_url('d/System/update_setting_pajak'); ?>",
            method: "POST",
            data: {"tax":tax, "id":id},
            success: function (data) {
                $('#alert').html(data);
                settingPajak();
            }
        });
    }
</script>