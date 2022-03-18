<div class="alert alert-info" alert-dismissable>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Partner grup untuk membuat grup User<br> grup partner akan menjadi tipe user dan sesuai rule yang dibuat misalnya potongan diskon, dll <br>
    isikan aturan-aturan untuk bergabung di kolom deskripsi. deskripsi akan tampil saat user akan registrasi. misalnya harus transfer.
    <br> user tidak akan aktif jika Admin tidak mengubah status aktif.<br>
    <strong>Jika Anda membuat grup Admin, maka tidak perlu untuk mengisikan form jumlah ataupun deskripsi</strong>
</div>

<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Tambah Partner
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="partnerform"> 
                                <div class="form-group">
                                    <label>Nama Grup Partner</label>
                                    <input class="form-control" name="partnername" id="partnername" type="text" required="">
                                </div>
                                <div class="form-group">
                                    <label>Partner Payment Rule (Partner ini Berbayar?)</label>
                                    <select class="form-control" name="partnerpay" id="partnerpay" onchange="partnerPay();">
                                        <option selected="" disabled="" value="">Pilih Tipe</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Partner Rule</label>
                                    <select class="form-control" name="partnerrule" id="partnerrule" onchange="rule();">
                                        <option selected="" disabled="" value="">Pilih Rule</option>
                                        <option value="Admin">Admin</option>
                                        <option value="discount per price">Discount per price</option>
                                        <option value="discount per percen">Discount per percen</option>
                                        <option value="no discount">no discount</option>
                                    </select>
                                </div>
                                <div class="form-group" id="mountcost">
                                    <label>Jumlah Biaya (Rp.)</label>
                                    <input class="form-control money" name="partneramountcost" id="partneramountcost" type="text">
                                </div>
                                <div class="form-group" id="disc">
                                    <label>Jumlah Diskon (Rp.) / (%)</label>
                                    <input class="form-control" name="discount" id="discount" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsikan Aturan Tipe Partner ini dan Keuntungan yang relevan dengan Diskon</label>
                                    <textarea class="form-control" rows="7" name="partnerdescription" id="partnerdescription" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-default btn-block">Reset</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="button" onclick="storePartner();" class="btn btn-success btn-block" value="Simpan">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function storePartner() {
        var valid = $("#partnerform").valid();
        if (valid == true) {
            var form = $('#partnerform').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Partner/store_partner') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    dataPartner();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                }
            });
        }
    }
    function partnerPay() {
        var pay = $('#partnerpay').val();
        if (pay === "Yes") {
            $('#mountcost').show("slow");
        } else {
            $('#mountcost').hide("slow");
        }
    }
    function rule() {
        var rule = $('#partnerrule').val();
        if (rule === "no discount" || rule == "Admin") {
            $('#disc').hide("slow");
        } else {
            $('#disc').show("slow");
        }
    }
</script>