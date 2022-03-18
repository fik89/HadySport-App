<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Design Banner, Logo , Pop up
            <button class="pull-right btn btn-success" onclick="dataPopup();"><i class="fa fa-list"></i> Data Popup</button>
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        Unggah Pop Up (image akan ditampilkan 550px)
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <form role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" id="forminputpopoup" action="">
                                                <div class="form-group">
                                                    <label for="tipepopup" class="col-sm-2 control-label">Tipe Popup </label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control required" title="input this field" name="tipepopup" id="tipepopup" onchange="positionPopup();">
                                                            <option disabled="" selected="" value="">Pilih Tipe</option>
                                                            <option value="Text Only">Text Only</option>
                                                            <option value="Image Only">Image Only</option>
                                                            <option value="Header Image And Bottom Text">Header Image And Bottom Text</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="ptext">
                                                    <label for="popuptext" class="col-sm-2 control-label">popup Text</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="wysiwyg" class="textarea form-control" name="popuptext" id="popuptext" row="7" maxlength="161">maksimal 161 karakter untuk greeting dan form to subcribe</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="fhline">
                                                    <label class="col-sm-2 control-label" for="filefotoheadline">Upload Foto headline</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control required" title="input this field" type="file" name="filefotoheadline" id="filefotoheadline" required="" accept="image/*" multiple>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="ffoto">
                                                    <label class="col-sm-2 control-label" for="filefoto">Upload Foto</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control required" title="input this field" type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="statusbutton" class="col-sm-2 control-label">Status Button (show / hidden) </label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control required" title="Status button" name="statusbutton" id="statusbutton" onchange="positionPopup();">
                                                            <option disabled="" selected="" value="">Pilih Status</option>
                                                            <option value="show">show</option>
                                                            <option value="hidden">hidden</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <input type="reset" class="btn btn-default pull-left" value="Reset">
                                                <input type="button" onclick="doUploadPopup();" class="btn-submit btn btn-success pull-right" value="unggah">
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="progresbar">
                                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function positionPopup() {
        var pos = $("#tipepopup").val();
        if (pos == "Text Only") {
            $("#ptext").show("slow");
            $("#fhline").hide("slow");
            $("#ffoto").hide("slow");
        } else if (pos == "Image Only") {
            $("#ptext").hide("slow");
            $("#fhline").hide("slow");
            $("#ffoto").show("slow");
        } else if (pos == "Header Image And Bottom Text") {
            $("#ptext").show("slow");
            $("#fhline").show("slow");
            $("#ffoto").hide("slow");
        }
    }

    function doUploadPopup() {
        var valid = $("#forminputpopoup").valid();
        if (valid == true) {
            var form = $('#forminputpopoup').get(0);
            var submit = $('input[type="button"]');
            submit.attr('disabled', true);
            $('#proses').show();
            $('#progresbar').show('slow');
            $.ajax({
                url: '<?php echo base_url('d/Design/do_upload_popup') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (html) {
                    $('.progress-bar').width('0%');
                    $('#alert').html(html);
                    $('#proses').hide();
                },
                complete: function () {
                    submit.attr('disabled', false);
                    $('#alert').html();
                    $('#progresbar').hide();
                    document.getElementById("forminputpopoup").reset();
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
    }
</script>