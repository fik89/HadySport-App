<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data User 
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data User 
                </div>
                <div class="panel-body">
                     <form role="form" class="form-horizontal" id="userprofile">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label">Nama User</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="id" id="id" type="hidden" value="<?php echo $data->iduser; ?>">
                                <input class="form-control required" name="username" id="username" type="text" value="<?php echo $data->username; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="email" id="email" type="text" value="<?php echo $data->useremail; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hp" class="col-sm-4 control-label">Hp</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="hp" id="hp" type="text" value="<?php echo $data->userHp; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipeuser" class="col-sm-4 control-label">Type User (1 = admin)</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="tipeuser" id="tipeuser" type="text" value="<?php echo $data->tipeuser; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="password" id="password" type="text" value="<?php echo $data->password; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <button type="reset" class="btn btn-default pull-left">Reset</button>
                        <input type="button" onclick="updateProfile();" class="btn btn-success pull-right" value="Simpan">
                    </div>
                </form>
                </div>
            </div>
        </div>      
    </div>
</div>
<script>
   function updateProfile() {
        var valid = $("#userprofile").valid();
        if (valid == true) {
            var form = $("#userprofile").get(0);
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
                }
            });
        }
    }
</script>