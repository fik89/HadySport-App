<div class="panel panel-green">
    <div class="panel-heading">
        Update User
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="userdesc">
                            <input type="hidden" name="id" value="<?php echo $datauser->iduser;?>">
                            <div class="form-group">
                                <label>Tipe User</label>
                                <select class="form-control" name="tipeuser" id="tipeuser" required="">
                                    <option disabled="" selected="">pilih Grup Tipe</option>
                                    <option value="1">Admin</option>
                                    <?php foreach ($partner as $value) {?>
                                    <option value="<?php echo $value->idpartner;?>"><?php echo $value->partnerName;?> - <?php echo $value->idpartner;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="" disabled="" selected="">Pilih Provinsi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="kabupaten" id="kabupaten" required="">
                                        <option value="" disabled="" selected="">Pilih Kabupaten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input class="form-control" name="username" id="username" type="text" required="" value="<?php echo $datauser->username;?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" id="email" type="email" required="" value="<?php echo $datauser->useremail;?>">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input class="form-control money" name="hp" id="hp" type="text" required="" value="<?php echo $datauser->userHp;?>">
                            </div>
                            <div class="form-group">
                                <label>Password - default 123456</label>
                                <input class="form-control" name="password" id="password" type="text" required="" value="<?php echo $datauser->password;?>">
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-default btn-block">Reset</button>
                            </div>
                            <div class="col-md-6">
                                <input type="button" onclick="storeUser();" class="btn btn-success btn-block" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        function getProvinsi() {
            $('.loading').remove();
            var $op = $("#provinsi")
            $('#provinsi').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_provinsi", function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
                });
                $('.loading').remove();
            });

        }
        getProvinsi();

        $("#provinsi").on("change", function (e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kabupaten option:gt(0)').remove();

            if (option === '')
            {
                alert('null');
                $("#kabupaten").prop("disabled", true);

            } else
            {
                $("#kabupaten").prop("disabled", false);
                getKota(option);
            }
        });

        function getKota(idpro) {
            $('.loading').remove();
            var $op = $("#kabupaten");
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_kota/" + idpro, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
                });
                $('.loading').remove();
            });
        };
    });
    function prov() {
        $('#provinsi').change(function () {
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $('#kabupaten').load('<?php echo base_url('Daerah/listKab') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
            {
                if (statusTxt === "success")
                    $('.loading').remove();
            });
            return false;
        });
    }
    function storeUser() {
        var valid = $("#userdesc").valid();
        if (valid == true) {
            var form = $('#userdesc').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/User/update_user') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataUser();
                }
            });
        }
    }
</script>