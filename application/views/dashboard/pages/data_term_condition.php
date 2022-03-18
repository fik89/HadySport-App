<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            Term & Condition
        </h4>
    </div>
    <div class="panel-body"> 
        <form role="form" class="form-horizontal" id="formterm">
            <div class="form-group">
                <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control textarea" name="deskripsi" id="deskripsi" rows="4" cols="50" required="" style="height: 400px;"><?php echo $datatermcondition->description;?></textarea>
                </div>
            </div>
            <button type="reset" class="btn btn-default">Reset</button>
            <input type="button" onclick="simpan_term_condition();" class="btn btn-success pull-right" value="Simpan">

        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            Data Term & Condition
        </h4>
    </div>
    <div class="panel-body"> 
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataservice">
                <thead>
                    <tr>
                        <td>Deskripsi</td>
                        <td>Date Update</td>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $datatermcondition->description;?></td>
                            <td>
                               <?php echo $datatermcondition->date_update;?>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function simpan_term_condition() {
        var valid = $("#formterm").valid();
        if (valid == true) {
            var form = $('#formterm').get(0);
            form_data = new FormData(form);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Pages/update_term_condition') ?>',
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
                                    data_term_condition();
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
</script>