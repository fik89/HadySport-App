<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h4 class="panel-title">
                    Input Rekening Bank
                </h4>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="finputbank">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="bankname" class="col-sm-2 control-label">Nama Bank</label>
                            <div class="col-sm-10">
                                <select class="form-control required" name="bankname" id="bankname" required="">
                                    <option value="BCA">BCA</option>
                                    <option value="BRI">BRI</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BTN">BTN</option>
                                    <option value="CIMB">CIMB</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="accountname" class="col-sm-2 control-label">Nama Pemilik</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="accountname" id="accountname" type="text" title="input this field" required="">
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
<script type="text/javascript">
    function storeDataBank() {
        var valid = $("#finputbank").valid();
        if (valid == true) {
            var form = $("#finputbank").get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/System/store_data_bank') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    $('#inputbank').hide();
                    dataListBank();
                    document.getElementById("finputbank").reset();
                }
            });
        }
    }
</script>