<div class="row">
    <div class="action pull-right">
    </div> 

    <!-- lokasi asal -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Order Setting
                </h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="daysdue" class="col-sm-2 control-label">Jumlah Jam Jatuh Tempo (order)<span class="text-info" data-toggle="tooltip" title=""><i class="fa fa-question-circle fa-fw"></i></span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="daysdue<?php echo $profile->id; ?>" id="daysdue<?php echo $profile->id; ?>" value="<?php echo $profile->daysDue; ?>">
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <button class="btn btn-success" onclick="updateDaysDue('<?php echo $profile->id;?>');">Simpan</button>
                </div>

            </div>
        </div>
    </div>    
</div>


<script type="text/javascript">
    function updateDaysDue(id) {
        var daysdue = $('#daysdue' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/System/update_order_setting'); ?>",
            method: "POST",
            data: {"id": id, "daysdue": daysdue},
            success: function (data) {
                $('#alert').html(data);
                orderSetting();
            }
        });
    }
</script>