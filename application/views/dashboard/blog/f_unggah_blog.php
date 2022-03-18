<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Kategori</h4>
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
            Unggah blog
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#kategori" data-toggle="tab">Kategori blog</a>
                </li>
                <li><a href="#blog" data-toggle="tab">Unggah blog</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="kategori">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <button class="btn btn-sm btn-primary pull-right" type="button" data-toggle="modal" data-target="#modal_add_cat"><i class="fa fa-plus"></i> Tambah Kategori</button>
                                <table width="100%" class="table table-striped table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nama Kategory</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datakategori as $value) { ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $value->blog_category_name; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" onclick="get_edit_kategori('<?php echo $value->idblogcategory; ?>')">Edit</button>
                                                    <button class="btn btn-sm btn-danger" onclick="hapus_kategori('<?php echo $value->idblogcategory; ?>')">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="blog">
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" class="form-horizontal" id="formblog">
                                <div class="form-group">
                                    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" id="kategori" required="">
                                            <option disabled="" selected="" value="">Pilih Kategori</option>
                                            <?php foreach ($datakategori as $value) { ?>
                                                <option value="<?php echo $value->idblogcategory; ?>"><?php echo $value->blog_category_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="judul" class="col-sm-2 control-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="judul" id="judul" type="text" required="" onkeyup="set_metatile();">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="isi" class="col-sm-2 control-label">Isi blog</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control textarea" name="isi" id="isi" rows="4" cols="50" style="height: 430px;" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bannerimage" class="col-sm-2 control-label">Banner Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="bannerimage" id="bannerimage" type="file" required="" accept=".jpg, .JPG, .jpeg, .JPEG, .bitmap, .png, .PNG" onchange="preview(this);">
                                        <hr>
                                        <img id="bannerpre" style="width: 50%; height: 50%;"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-sm-2 control-label">Tags <span class="text-info">gunakan koma (,) untuk tag lebih dari satu</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="tag" id="tag" type="text" required="" onkeyup="set_tag()">
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="metatitle" class="col-sm-2 control-label">Meta Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="metatitle" id="metatitle" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metatag" class="col-sm-2 control-label">Meta tag</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="metatag" id="metatag" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metadesc" class="col-sm-2 control-label">Meta Desc</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control textarea" name="metadesc" id="metadesc" rows="5"required=""></textarea>
                                    </div>
                                </div>
                                <button type="reset" class="btn btn-default">Reset</button>
                                <input type="button" onclick="unggah_blog();" class="btn btn-success pull-right" value="Simpan">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal_add_cat" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <form role="form" class="form-horizontal" id="inputcategory">
                <div class="modal-body"> 
                    <input class="form-control" id="kategori" name="kategori" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>

                    <input type="button" onclick="simpan_kategori();" data-dismiss="modal" class="btn btn-success pull-right" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_edit_cat" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <form role="form" class="form-horizontal" id="editcategory">
                <div class="modal-body"> 
                    <input class="form-control" id="id_kategori" name="id_kategori" required="" type="hidden">
                    <input class="form-control" id="nama_kategori" name="nama_kategori" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>

                    <input type="button" onclick="simpan_edit_kategori();" data-dismiss="modal" class="btn btn-success pull-right" value="Simpan">
                </div>
            </form>
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
    function simpan_kategori() {
        var valid = $("#inputcategory").valid();
        if (valid == true) {
            var form = $('#inputcategory').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Blog/simpan_kategori') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#modal_add_cat').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#alert').html(resp);
                    $('#loader').hide();
                    unggahBlog();
                }
            });
        }
    }

    function simpan_edit_kategori() {
        var valid = $("#editcategory").valid();
        if (valid == true) {
            var form = $('#editcategory').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Blog/simpan_edit_kategori') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#modal_add_cat').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#alert').html(resp);
                    $('#loader').hide();
                    unggahBlog();
                }
            });
        }
    }

    function hapus_kategori(id) {
        var id = id;
        swal({
            title: "Hapus Data ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '<?php echo base_url('d/Blog/hapus_kategori'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                unggahBlog();
                            }
                        });
                        swal("Terhapus!", "Data terhapus", "success");
                    } else {
                        swal("", "P", "error");
                    }
                });
    }

    function get_edit_kategori(id) {
        var id;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('d/Blog/get_data_kategori_id'); ?>',
            dataType: "json",
            data: {id: id},
            accepts: {
                json: 'application/json'
            },
            success: function (response) {
                $('#nama_kategori').empty();
                $('#id_kategori').empty();
                if (response.status === '0') {
                    swal("error", "" + response.message + "", "error");
                } else {
                    $('#nama_kategori').val(response.data.blog_category_name);
                    $('#id_kategori').val(response.data.idblogcategory);
                    $('#modal_edit_cat').modal('show');
                }
            },
            error: function (response) {
                swal("Internal Server Error", "error_code: " + response.status + "", "error");
            }
        });
    }

    function unggah_blog() {
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
                url: '<?php echo base_url('d/Blog/unggah_blog_save') ?>',
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