<div class="row">
    <h3 class="page-header">Setting Online Shop</h3>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-green">
        <div class="panel-heading">
            Basic Tabs
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#company" data-toggle="tab">Company Profile</a>
                </li>
                <li><a href="#bank" data-toggle="tab">Daftar Bank</a>
                </li>
                <li><a href="#messages" data-toggle="tab">Messages</a>
                </li>
                <li><a href="#settings" data-toggle="tab">Settings</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="company">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form role="form" class="form-horizontal" id="companyprofile">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="companyname" class="col-sm-4 control-label">Nama Online Shop</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="companyname" id="companyname" type="text" value="<?php echo $data->companyName; ?>" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Nama Pemilik</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" type="text" name="owner" id="owner" value="<?php echo $data->owner; ?>" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Alamat Toko Offline / Alamat Gudang</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="address1" id="address1" type="text" value="<?php echo $data->address1; ?>" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Telepone 1</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="phone1" id="phone1" value="<?php echo $data->phone1; ?>" type="text" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Telepone 2</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="phone2" id="phone2" value="<?php echo $data->phone2; ?>" title="input this field" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="email" id="email" value="<?php echo $data->email; ?>"type="email" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Link Instagram</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="ig_link" id="ig_link" value="<?php echo $data->igLink; ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Link Facebook</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="fb_link" id="fb_link" value="<?php echo $data->fbLink; ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Twitter Facebook</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="twitt_link" id="fb_link" value="<?php echo $data->twittLink; ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Youtube Facebook</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="yt_link" id="yt_link" value="<?php echo $data->ytLink; ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">WhatsApp Phone</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control required" name="wa" id="wa" value="<?php echo $data->waPhone; ?>" type="text" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Deskripsi Perusahaan</label>
                                                <div class="col-sm-8">
                                                    <textarea class="textarea form-control required" rows="7" name="companydesc" id="companydesc" title="input this field" required=""> <?php echo $data->companyDescription; ?></textarea>
                                                </div>
                                            </div>
                                            <button type="reset" class="btn btn-default pull-left">Reset</button>
                                            <input type="button" onclick="updateCompany();" class="btn btn-success pull-right" value="Simpan">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bank">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form role="form" class="form-horizontal" id="databank">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="bankname" class="col-sm-2 control-label">Nama Bank</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control required" name="bankname" id="bankname" type="text" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="accountnumber" class="col-sm-2 control-label">Nomor Rekening <span class="text-info" data-toggle="tooltip" title="Sesuaikan dengan format bank agar pengguna mudah dalam membaca"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                                <div class="col-sm-10">
                                                    <input class="form-control required" name="accountnumber" id="accountnumber" type="text" title="input this field" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Status</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" title="input this field" name="status" id="status">
                                                        <option disabled="" selected="" value="">Pilih Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="reset" class="btn btn-default pull-left">Reset</button>
                                            <input type="button" onclick="storeDataBank();" class="btn btn-success pull-right" value="Simpan">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="databank"></div>
                </div>
                <div class="tab-pane fade" id="messages">
                    <h4>Messages Tab</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="tab-pane fade" id="settings">
                    <h4>Settings Tab</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function updateCompany() {
        var valid = $("#companyprofile").valid();
        if (valid ==  true){
            var form = $("#companyprofile").get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/System/update_company') ?>',
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
    function storeDataBank(){
       var valid = $("#databank").valid();
       if (valid ==  true){
        var form = $("#databank").get(0);
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/System/store_data_bank') ?>',
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (resp) {
                $('#alert').html(resp);
                $('#loader').hide(); document.getElementById("databank").reset();
            }
        });
    }
}
</script>
