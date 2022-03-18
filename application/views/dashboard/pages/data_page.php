<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Pages</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
    </div>  
</div>  
<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Data Page
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#kategori" data-toggle="tab">Page Service</a>
                </li>
                <li><a href="#termcondition" data-toggle="tab" onclick="data_term_condition();">Page Term & Condition</a>
                </li>
                <li><a href="#privacypolicy" data-toggle="tab" onclick="data_privacy_policy();">Page Privacy & Policy</a>
                </li>
                <li><a href="#gallery" data-toggle="tab" onclick="data_gallery();">Page Gallery</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="kategori">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        Tambah Data Service
                                    </h4>
                                </div>
                                <div class="panel-body"> 
                                    <form role="form" class="form-horizontal" id="formservice">
                                        <div class="form-group">
                                            <label for="judul" class="col-sm-2 control-label">Judul</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="judul" id="judul" type="text" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" cols="50" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="iconimage" class="col-sm-2 control-label">Icon Image -will resize 500x333</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="iconimage" id="iconimage" type="file" required="" accept=".jpg, .JPG, .jpeg, .JPEG, .bitmap, .png, .PNG" onchange="preview(this);">
                                                <hr>
                                                <img id="iconimagepre" style="width: 50%; height: 50%;"/>
                                            </div>
                                        </div>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <input type="button" onclick="simpan_service();" class="btn btn-success pull-right" value="Simpan">

                                    </form>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        Data Service
                                    </h4>
                                </div>
                                <div class="panel-body"> 
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataservice">
                                            <thead>
                                                <tr>
                                                    <td>id</td>
                                                    <td>Judul</td>
                                                    <td>Icon</td>
                                                    <td>Deskripsi</td>
                                                    <td>Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataservice as $value) {?>
                                                <tr>
                                                    <td><?php echo $value->idpageservice;?></td>
                                                    <td><?php echo $value->title;?></td>
                                                    <td><img src="<?php echo base_url('/').$value->icon;?>" height="80px;"></td>
                                                    <td><?php echo $value->description;?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" title="update" onclick="update_service('<?php echo $value->idpageservice;?>')"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-sm btn-danger" title="hapus" onclick="hapus_service('<?php echo $value->idpageservice;?>')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="termcondition">
                    <div class="row">
                        <div class="col-lg-12" id="datatermcondition">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="privacypolicy">
                    <div class="row">
                        <div class="col-lg-12" id="dataprivacypolicy">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="gallery">
                    <div class="row">
                        <div class="col-lg-12" id="datagallery">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     function data_term_condition() {
        $.ajax({
            url: "<?php echo base_url('d/Pages/page_term_condition'); ?>",
            method: "POST",
            success: function (data) {
                $('#datatermcondition').html(data);
                $(".textarea").wysihtml5();
            }
        });
    }
    function data_gallery() {
        $.ajax({
            url: "<?php echo base_url('d/Pages/page_gallery'); ?>",
            method: "POST",
            success: function (data) {
                $('#datagallery').html(data);
                $(".textarea").wysihtml5();
            }
        });
    }
    function data_privacy_policy() {
            $.ajax({
                url: "<?php echo base_url('d/Pages/page_privacy_policy'); ?>",
                method: "POST",
                success: function (data) {
                    $('#dataprivacypolicy').html(data);
                    $(".textarea-privacy").wysihtml5();
                }
            });
        }

    function update_service(id) {
        $.ajax({
            url: "<?php echo base_url('d/Pages/update_service'); ?>",
            method: "POST",
            data: {id: id},
            success: function (data) {
                $('#data').html(data);
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
                $(".textarea").wysihtml5();
            }
        });
    }
        
    
    function simpan_service() {
        $('html, body').animate({
            scrollTop: $("#page-wrapper").offset().top
        }, 2000);
        var file;
        var form_data;
        var valid = $("#formservice").valid();
        if (valid == true) {
            var form = $('#formservice').get(0);
            file = $('#iconimage').prop('files')[0];
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
                url: '<?php echo base_url('d/Pages/simpan_service') ?>',
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
                                    pages();
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
        oFReader.readAsDataURL(document.getElementById("iconimage").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("iconimagepre").src = oFREvent.target.result;
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
    
     function hapus_service(id) {
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
                            url: '<?php echo base_url('d/Pages/hapus_service'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                pages();
                            }
                        });
                        swal("Terhapus!", "Data terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>