<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Reset Password
    </span>
</div>
<section class="bgwhite p-t-20 p-b-100">
    <div class="container">
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <div class="bo17 w-size18 p-l-20 p-r-20 p-t-20 p-b-38 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm">
            <div class="login_form">
                <h5 class="bo18 m-b-20 p-b-20 text-center">
                    Password Baru
                </h5>
                <form id="formresetpassword">
                <div class="flex-w flex-sb-m p-b-12 bo20">
                        <div class="col-lg-12 form-group">
                            <label>Password Baru</label>
                            <input class="form-control" type="new-pwd" name="new-pwd" id="new-pwd" required="" minlength="6" placeholder="minimal 6 karakter">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>Ulangi Password Baru</label>
                            <input class="form-control" type="new-pwd" name="re-new-pwd" id="re-new-pwd" onchange="checkPasswordMatch();"  required="" minlength="6" placeholder="minimal 6 karakter">
                        </div>
                        <div id="report"></div>
                    </div>
                    <div class="size15 trans-0-4 p-t-30 m-b-20">
                        <button class="btn btn-block subs_btn form-control" id="submit-btn" type="button" onclick="resetPasword();">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script src="<?php echo base_url('asset/') ?>js/jquery.validate.min.js"></script>
<script>
    function checkPasswordMatch() {
        var password = $("#new-pwd").val();
        var confirmPassword = $("#re-new-pwd").val();
        if (password != confirmPassword) {
            $("#report").show('slow');
            $("#report").html("Passwords do not match!");
            document.getElementById("submit-btn").disabled = true;
            document.getElementById("report").style.color = "red";
        } else {
            $("#report").html("Passwords match.");
            $("#report").hide('slow');
            document.getElementById("submit-btn").disabled = false;
        }
    }
    $(document).ready(function () {
        $("#re-new-pwd").keyup(checkPasswordMatch);
    });
    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }

    function resetPasword() {
        var id = getUrlVars()['id'];
        var tk = getUrlVars()['tk'];
        var newp = $("#new-pwd").val();
        var valid = $("#formresetpassword").valid();
        if (valid == true) {
            var form = $('#formresetpassword').get(0);
            form_data = new FormData(form);
            form_data.append('id', id);
            form_data.append('tk', tk);
            form_data.append('newp', newp);
            $('#loader').show();
            $.ajax({
                url: '<?php echo site_url('User/do_create_new_password'); ?>',
                data: form_data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (resp) {
                    if (resp === '0') {
                        window.location.href = '<?php echo base_url('pages/create-new-password?id=') ?>'+id+'&tk='+tk;
                    } else {
                        window.location.href = '<?php echo base_url('pages/login') ?>';
                    }
                }
            });
        }else{
            swal("","Lengkapi semua data","error");
        }
    }
</script>
</body>
</html>