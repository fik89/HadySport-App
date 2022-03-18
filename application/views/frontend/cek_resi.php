<?php echo $header; ?>
<style>
    .error{
        color:red;
    }
</style>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Cek Resi
    </h2>
</section>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Cek Resi
    </span>
</div>
<section class="bgwhite p-t-10 p-b-100">
    <div class="container">
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <div class="row">
            <div class="login_form col-md-4 p-l-20 p-r-20 p-t-10 p-b-38 m-t-30 m-r-0">
                <h5 class="bo18 m-b-20 p-b-20 text-center">
                    Cek Resi
                </h5>
                <form id="formresi">
                    <div class="flex-w flex-sb-m p-b-12 bo20">
                        <div class="col-lg-12 form-group">
                            <label>Masukan Nomor Resi</label>
                            <input class="form-control login_form" type="text" name="resi" id="resi" required="">
                        </div>
                        <div class="col-lg-12 form-group">
                            <select name="courier" id="courier" class="form-control" required="">
                                <option value="" disabled="" selected="">Pilih Jasa Pengiriman</option>
                                <option value="tiki">Tiki</option>
                                <option value="sicepat">Sicepat</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="wahana">Wahana</option>
                                <option value="jnt">JNT</option>
                                <option value="rpx">RPX</option>
                                <option value="sap">SAP</option>
                                <option value="pcp">PCP</option>
                                <option value="jet">JET</option>
                                <option value="dse">DSE</option>
                                <option value="first">First</option>
                                <option value="ninja">Ninja</option>
                                <option value="idl">Idl</option>
                                <option value="rex">REX</option>
                                <option value="lion">Lion</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6"><span  id="captcha"><?php echo $cap_img;?></span>
                                <span id="refresh_captcha" class="p-l-10 p-b-10"><a><i class="fa fa-refresh"></i> refresh</a></span>
                            </div>
                            <div class="col-md-12 m-b-5">
                                <input type="text" onkeyup="if (/\D/g.test(this.value))this.value = this.value.replace(/\D/g, '')" name="captcha_code" id="captcha_code" class="form-control" placeholder="captcha code" required="" maxlength="4">
                            </div>
                        </div>
                    </div>
                    <div class="size15 trans-0-4 p-t-30 m-b-20">
                        <button class="btn btn-block subs_btn form-control" type="button" onclick="check_resi()">
                            Cek Resi
                        </button>
                    </div>
                </form>
            </div>

            <div id="result" class="login_form col-md-8 p-l-20 p-r-20 p-t-10 p-b-38 m-t-30 m-r-0">
                <h5 class="bo18 m-b-20 p-b-20 text-center">
                    Hasil
                </h5>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <div id="loader" class="m-r-0 m-l-r-auto p-lr-15-sm"><i class="fa fa-spinner fa-pulse fa-3x fa-fw loading color0"></i></div>
                    <div id="resultwaybill" class="bo17 sizefull"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $footer; ?>

    <script src="<?php echo base_url('asset/') ?>js/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#loader').hide();
            $('#result').hide();
            $('#refresh_captcha').click(function(){
                new_captcha();
            });
        });
        function new_captcha() {
            $.ajax({
                url: "<?php echo base_url('Home/recaptcha'); ?>", 
                success: function(result){
                    $("#captcha").html(result);
                }
            });     
        }

        function check_resi() {
            var valid = $("#formresi").valid();
            if (valid == true) {
            $('#result').show();
                var form = $('#formresi').get(0);
                form_data = new FormData(form);
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Shipinggateway/cek_resi/') ?>',
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    accepts: {
                        json: 'application/json'
                    },
                    success: function (resp) {
                        if (resp.status == 0) {
                            swal("",""+resp.message+"","error");
                        } else if (resp.status == 1) {
                            if(resp.result.status.code != 200){
                                swal("","" + resp.result.status.description+"", "error");
                            }else{

                               $.ajax({
                                url: "<?php echo base_url('d/Shipinggateway/result_waybill'); ?>",
                                method: "POST",
                                data: {"data":resp},
                                success: function (data) {

                               $('#resultwaybill').html(data);
                                }
                            });
                           }
                       }
                       $('#loader').hide();
                   },
                   error: function (resp) {
                    swal("","" + resp.status+"", "error");
                }
            });
            }
        }
    </script>
</body>
</html>