 <div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            Tambah Data gallery
        </h4>
    </div>
    <div class="panel-body"> 
        <form role="form" class="form-horizontal" id="formgallery">
            <div class="form-group">
                <label for="judul" class="col-sm-2 control-label">Judul</label>
                <div class="col-sm-10">
                    <input class="form-control" name="judulgallery" id="judulgallery" type="text" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="link" class="col-sm-2 control-label">Link Gallery</label>
                <div class="col-sm-10">
                    <input class="form-control" name="link" id="link" type="text" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="deskripsigallery" id="deskripsigallery" rows="4" cols="50" required=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="iconimage" class="col-sm-2 control-label">Icon Image -will resize 500x333</label>
                <div class="col-sm-10">
                    <input class="form-control" name="iconimagegallery" id="iconimagegallery" type="file" required="" accept=".jpg, .JPG, .jpeg, .JPEG, .bitmap, .png, .PNG" onchange="preview(this);">
                    <hr>
                    <img id="iconimagegallerypre" style="width: 50%; height: 50%;"/>
                </div>
            </div>
            <button type="reset" class="btn btn-default">Reset</button>
            <input type="button" onclick="simpan_gallery();" class="btn btn-success pull-right" value="Simpan">
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            Data gallery
        </h4>
    </div>
    <div class="panel-body"> 
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%" id="dataTables-datagallery">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Judul</td>
                        <td>Link</td>
                        <td>Icon</td>
                        <td>Deskripsi</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datagallery as $value) {?>
                        <tr>
                            <td><?php echo $value->idpagegallery;?></td>
                            <td><?php echo $value->title;?></td>
                            <td><?php echo $value->link;?></td>
                            <td><img src="<?php echo base_url('/').$value->icon;?>" height="80px;"></td>
                            <td><?php echo $value->description;?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" title="update" onclick="update_gallery('<?php echo $value->idpagegallery;?>')"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-sm btn-danger" title="hapus" onclick="hapus_gallery('<?php echo $value->idpagegallery;?>')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
     function update_gallery(id) {
        $.ajax({
            url: "<?php echo base_url('d/Pages/update_gallery'); ?>",
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
        
    function simpan_gallery() {
        $('html, body').animate({
            scrollTop: $("#page-wrapper").offset().top
        }, 2000);
        var file;
        var form_data;
        var valid = $("#formgallery").valid();
        if (valid == true) {
            var form = $('#formgallery').get(0);
            file = $('#iconimagegallery').prop('files')[0];
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
                url: '<?php echo base_url('d/Pages/simpan_gallery') ?>',
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
                                    data_gallery();
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
        oFReader.readAsDataURL(document.getElementById("iconimagegallery").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("iconimagegallerypre").src = oFREvent.target.result;
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
    
     function hapus_gallery(id) {
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
                            url: '<?php echo base_url('d/Pages/hapus_gallery'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                data_gallery();
                            }
                        });
                        swal("Terhapus!", "Data terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>