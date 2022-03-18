<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Update Blog</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="progress">
            <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>  
    </div>  
</div>  
<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Update blog
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#blog" data-toggle="tab">Update blog</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="blog">
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" class="form-horizontal" id="formblog">
                                <input name="idblogpost" name="idblogpost" type="hidden" value="<?php echo $datablog->idblogpost;?>">
                                <div class="form-group">
                                    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" id="kategori" required="">
                                            <option disabled="" selected="" value="">Pilih Kategori</option>
                                            <option value="<?php echo $datablog->idblogcategory;?>" selected><?php echo $datablog->blog_category_name;?></option>
                                            <?php foreach ($datakategori as $value) { ?>
                                                <option value="<?php echo $value->idblogcategory; ?>"><?php echo $value->blog_category_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="judul" class="col-sm-2 control-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="judul" id="judul" type="text" required="" onkeyup="set_metatile();" value="<?php echo $datablog->blog_title;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="isi" class="col-sm-2 control-label">Isi blog</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control textarea" name="isi" id="isi" rows="4" cols="50" style="height: 430px;" required=""><?php echo $datablog->blog;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bannerimage" class="col-sm-2 control-label">Banner Image</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="currentbanner" id="currentbanner" value="<?php echo $datablog->banner_image;?>">
                                        <input class="form-control" name="bannerimage" id="bannerimage" type="file" accept=".jpg, .JPG, .jpeg, .JPEG, .bitmap, .png, .PNG" onchange="preview(this);">
                                        <hr>
                                        <img id="bannerpre" src="<?php echo base_url('').$datablog->banner_image;?>" style="width: 50%; height: 50%;"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-sm-2 control-label">Tags <span class="text-info">gunakan koma (,) untuk tag lebih dari satu</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="tag" id="tag" type="text" required="" onkeyup="set_tag()" value="<?php echo $datablog->post_tag;?>">
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="metatitle" class="col-sm-2 control-label">Meta Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="metatitle" id="metatitle" type="text" value="<?php echo $datablog->metatitle;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metatag" class="col-sm-2 control-label">Meta tag</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="metatag" id="metatag" type="text" value="<?php echo $datablog->metatag;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metadesc" class="col-sm-2 control-label">Meta Desc</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control textarea" name="metadesc" id="metadesc" rows="5"required=""><?php echo $datablog->metadesc;?></textarea>
                                    </div>
                                </div>
                                <button type="reset" class="btn btn-default">Reset</button>
                                <input type="button" onclick="unggah_blog('<?php echo $datablog->idblogpost;?>');" class="btn btn-success pull-right" value="Simpan">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function set_metatile(){
        var title = $('#judul').val();
        var metatitle = $('#metatitle').val(title);
        var metadesc = $('#metadesc').val(title);
    }
    function set_tag(){
        var tag = $('#tag').val();
        var metatag = $('#metatag').val(tag);
    }

    function unggah_blog(id) {
        $('html, body').animate({
            scrollTop: $("#page-wrapper").offset().top
        }, 2000);
        var file;
        var form_data;
        var valid = $("#formblog").valid();
        if (valid == true) {
            var form = $('#formblog').get(0);
            file = $('#bannerimage').prop('files')[0];
            form_data = new FormData(form);
            form_data.append('file', file);
            $('#loader').show();
            $.ajax({
                xhr: function () {
                    $('.progress').show();
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    });
                    return xhr;
                },
                url: '<?php echo base_url('d/Blog/unggah_blog_save/') ?>'+id,
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
                        swal("error upload: " + resp.message);
                    } else if (resp.status == 1) {
                        swal({
                            title: "" + resp.message + "",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#008000",
                            confirmButtonText: "OK",
                            showLoaderOnConfirm: true,
                            closeOnConfirm: true,
                            closeOnCancel: false
                        },
                                function (isConfirm) {
                                    dataBlog();
                                });
                    }
                    $('.progress').hide();
                    $('#loader').hide();
                },
                error: function (resp) {
                    swal("error upload, error_code: " + resp.status);
                }
            });
        }
    }

    function preview(oInput) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("bannerimage").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("bannerpre").src = oFREvent.target.result;
        };
        ValidateSingleInput(oInput);
    }
    var _validFileExtensions = [".jpg", ".jpeg", ".png", ".JPG", ".JPEG"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Maaf, " + sFileName + " tidak valid, silahkan upload dengan tipe file: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
</script>