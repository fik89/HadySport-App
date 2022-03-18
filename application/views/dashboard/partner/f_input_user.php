<div class="panel panel-green">
    <div class="panel-heading">
        Tambah User
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="userdesc">
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
                                <select class="form-control" name="provinsi" id="provinsi" required="">
                                    <option selected="" disabled="">Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $value) { ?>
                                        <option value="<?php echo $value->id_prov ?>"><?php echo $value->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="kabupaten" id="kabupaten" required="">
                                    <option disabled="" selected="">Pilih Kabupaten / Kota</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input class="form-control" name="username" id="username" type="text" required="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" id="email" type="email" required="">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input class="form-control money" name="userhp" id="userhp" type="text" required="">
                            </div>
                            <div class="form-group">
                                <label>Password - default 123456</label>
                                <input class="form-control" name="password" id="password" type="text" required="">
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
                url: '<?php echo base_url('d/User/store_user_back') ?>',
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