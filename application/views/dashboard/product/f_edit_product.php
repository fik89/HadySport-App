<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Edit Produk <?php echo $data->productName; ?>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="productdescedit">
                                <input class="form-control" name="idproduct" id="idproduct" type="hidden" value="<?php echo $data->idproduct; ?>">
                                <input class="form-control" name="idupload" id="idupload" type="hidden" value="<?php echo $data->idupload; ?>">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category" id="category">
                                        <option selected="" value="<?php echo $data->idcategory; ?>"><?php echo $data->categoryName; ?></option>
                                        <?php echo $category; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input class="form-control" name="productname" id="productname" type="text" required="" value="<?php echo $data->productName; ?>">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input class="form-control money" name="productprice" id="productprice" type="text" value="<?php echo $data->price; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Ukuran</label>
                                    <input class="form-control" name="productsize" id="productsize" type="text" value="<?php echo $data->size; ?>" required="">
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control" name="productweight" id="productweight" type="text" value="<?php echo $data->productWeight; ?>" required="">
                                    <span class="input-group-addon">satuan (gram)</span>
                                </div>
                                <div class="form-group">
                                    <label>Material Produk</label>
                                    <textarea class="form-control" rows="2" name="productmaterial" id="productmaterial" required=""><?php echo $data->material; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea class="textarea form-control" rows="7" name="productdescription" id="productdescription" required=""><?php echo $data->productDescription; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Stok Produck</label>
                                    <input class="form-control" name="productqty" id="productqty" type="number" value="<?php echo $data->quantityStock; ?>" required="">
                                </div>
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-default btn-block">Reset</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" onclick="" class="btn btn-success btn-block" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" id="formfoto">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data" id="productphotoedit" action="">
                                <div class="form-group">
                                    <label>Upload Foto</label>
                                    <div class="upload-file">
                                        <h4><span class="btn-primary pull-right" id="count"></span></h4>
                                        <input class="form-control" name="idproduct" id="idproduct" type="hidden" value="<?php echo $data->idproduct; ?>">
                                        <input class="form-control" name="idupload" id="idupload" type="hidden" value="<?php echo $data->idupload; ?>">
                                        <input type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple>
                                    </div>
                                    <p class="help-block">Foto nomor urut 1 menjadi Cover</p>
                                </div>
                            </form>

                            <div id="progresbar">
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div id="finish"></div>
                            <div id="ajaxpage"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#category').change(function () {
        $('#subcategory').after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw loading"></i>');
        $('#subcategory').load('<?php echo base_url('d/Category/subcategory_by') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
        {
            if (statusTxt === "success")
                $('.loading').remove();
        });
        return false;
    });
    $('#subcategory').change(function () {
        $('#subsubcategory').after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw loading"></i>');
        $('#subsubcategory').load('<?php echo base_url('d/Category/subsubcategory_by') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
        {
            if (statusTxt === "success")
                $('.loading').remove();
        });
        return false;
    });
</script>
<script type="text/javascript">
    function del(id) {
        swal({
            title: "Hapus Foto ini ?",
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
                    type: 'POST',
                    url: '<?php echo base_url('d/Product/imgDel'); ?>/' + id,
                    success: function (error) {
                        $('#filefoto').val('');
                        $('.progress-bar').width('0%');
                        $('#uploadPrev').remove();
                        if (error != '') {
                            $('#alert').html(error);
                        }
                        loadPhotoEdit();
                    }
                });
                swal("Terhapus!", "Foto Anda Terhapus", "success");
            } else {
                swal("", "Foto Anda Masih Tersimpan", "error");
            }
        });
    }
    function loadPhotoEdit() {
        $('#progresbar').hide();
        var id = '<?php echo $data->idupload; ?>';
        $.ajax({
            url: '<?php echo base_url('d/Product/load_photo') ?>/' + id,
            type: 'GET',
            success: function (data) {
                $('#ajaxpage').html(data);
            }
        });
    }
    function doUploadPhotoEdit() {
        $("#productphotoedit").on('submit', function (event) {
            event.preventDefault();
            var submit = $('input[type="submit"]');
            var productname = $('#productname').val();
            var qty = $('#productqty').val();
            if (productname === "" || qty === "") {
                swal("Unggah gagal", "Foto Gagal di unggah, isikan deskripsi Produk Terlebih dahulu", "warning");
                document.getElementById("productname").focus();
                document.getElementById("productphoto").reset();
                $('#loader').hide();
                return false;
            } else {
                submit.attr('disabled', true);
                $('#proses').show();
                $('#progresbar').show('slow');
                $('#alert').html('');

                $.ajax({
                    url: '<?php echo base_url('d/Product/do_upload_photo') ?>',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (html) {
                        $('#filefoto').val('');
                        $('.progress-bar').width('0%');
                        $('#alert').html(html);
                        document.getElementById("productphotoedit").reset();
                        loadPhotoEdit();
                        $('#proses').hide();
                    },
                    complete: function () {
                        submit.attr('disabled', false);
                        $('#alert').html();
                    },
                    xhr: function () {
                        var xhr = $.ajaxSettings.xhr();
                        xhr.upload.onprogress = function (e) {
                            var onprogress = Math.floor(e.loaded / e.total * 100) + '%';
                            $('.progress-bar').width(onprogress);
                        };
                        return xhr;
                    }

                });
            }
        });
    }
    function doUploadDescEdit() { 
        $("#productdescedit").on('submit', function (event) {
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Product/do_upload_product') ?>',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#alert').html(data);
                    $('#proses').hide();
                }
            });
        });
    }
</script>