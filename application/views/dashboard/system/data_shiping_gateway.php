<div class="row">
    <div class="action pull-right">
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Data shiping gateway
                </h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nama Shiping Gateway</td>
                                <td>Api Token</td>
                                <td>Provinsi Asal</td>
                                <td>Kota Asal</td>
                                <td>Up Cost</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datashipinggateway as $value) { ?>
                                <tr>
                                    <td><input class="form-control" name="shipinggatewayname<?php echo $value->id; ?>" id="shipinggatewayname<?php echo $value->id; ?>" value="<?php echo $value->shipingGatewayName; ?>" readonly>
                                    </td>
                                    <td><input class="form-control" name="apitoken<?php echo $value->id; ?>" id="apitoken<?php echo $value->id; ?>" value="<?php echo encryption($value->apiToken); ?>">
                                    </td>

                                    <td><?php echo $value->originProvinceName; ?> </td>
                                    <td><?php echo $value->originCityName; ?> </td>
                                    <td><input class="form-control" name="upcost<?php echo $value->id; ?>" id="upcost<?php echo $value->id; ?>" value="<?php echo $value->upCost; ?> ">
                                    </td>

                                    <td align="center">
                                        <button class="btn btn-sm btn-primary" title="update setting" onclick="updateShipingGateway('<?php echo $value->id; ?>');"><i class="fa fa-refresh"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    <!-- lokasi asal -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Setting Lokasi Awal Pengiriman dan Default Shiping
                </h4>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" id="forminputorigin" action="">
                    <div class="form-group">
                        <label for="bannertype" class="col-sm-2 control-label">Pilih Provinsi <span class="text-info" data-toggle="tooltip" title=""><i class="fa fa-question-circle fa-fw"></i></span></label>
                        <div class="col-sm-10">
                            <select class="form-control required" title="input this field" name="provinsi" id="provinsi">
                                <option disabled="" selected="" value="">Pilih Provinsi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bannertype" class="col-sm-2 control-label">Pilih Kota <span class="text-info" data-toggle="tooltip" title=""><i class="fa fa-question-circle fa-fw"></i></span></label>
                        <div class="col-sm-10">
                            <select class="form-control required" title="input this field" name="kotaorigin" id="kotaorigin">
                                <option disabled="" selected="" value="">Pilih Kota / Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <input type="reset" class="btn btn-default pull-left" value="Reset">
                    <input type="button" onclick="storeOriginShiping();" class="btn-submit btn btn-success pull-right" value="Simpan">
                </form>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    function updateShipingGateway(id) {
        var name = $('#shipinggatewayname' + id).val();
        var token = $('#apitoken' + id).val();
        var upcost = $('#upcost' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/System/update_shiping_gateway'); ?>",
            method: "POST",
            data: {"id": id, "name": name, "token": token, "upcost":upcost},
            success: function (data) {
                $('#alert').html(data);
                dataShipingGateway();
            }
        });
    }
    function getProvinsi() {
        var $op = $("#provinsi")
        $('#provinsi').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $.getJSON("<?php echo base_url('d/Shipinggateway/get_provinsi')?>", function (data) {
            $.each(data, function (i, field) {
                $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
            });
            $('.loading').remove();
        });
    }

    $("#provinsi").on("change", function (e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        $('#kotaorigin option:gt(0)').remove();
        if (option === '')
        {
            alert('null');
            $("#kotaorigin").prop("disabled", true);
        } else
        {
            $("#kotaorigin").prop("disabled", false);
            getKota(option);
        }
    });

    function getKota(idpro) {
        var $op = $("#kotaorigin");
        $('#kotaorigin').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $.getJSON("<?php echo base_url('d/Shipinggateway/get_kota/')?>" + idpro, function (data) {
            $.each(data, function (i, field) {
                $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
            });
            $('.loading').remove();
        });
    }

    function storeOriginShiping() {
        var valid = $("#forminputorigin").valid();
        if (valid == true) {
            var form = $("#forminputorigin").get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Shipinggateway/store_origin_shiping') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataShipingGateway();
                }
            });
        }
    }
</script>