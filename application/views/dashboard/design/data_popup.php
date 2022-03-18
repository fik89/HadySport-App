<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Popup
            <span class="pull-right btn btn-success" onclick="uploadPopup();"><i class="fa fa-plus-square"></i> Unggah Popup</span>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Popup 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataPopup">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type Popup</th>
                                    <th>Text</th>
                                    <th>Image</th>
                                    <th>Deskripsi</th>
                                    <th>Button Status</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->idpopup; ?></td>
                                        <td><?php echo $value->popupType; ?></td>
                                        <td><?php echo $value->popupText; ?></td>
                                        <td><img src="<?php echo site_url('asset/img/uploads/popup/') . $value->popupImage; ?>" style="max-width: 180px;"></td>
                                        <td><?php echo $value->typeDescription; ?></td>
                                        <td><?php echo $value->statusButton; ?></td>
                                        <td>
                                            <select class="form-control" id="status<?php echo $value->idpopup ?>" name="status<?php echo $value->idpopup ?>" onchange="updateStatusPopup('<?php echo $value->idpopup; ?>');">
                                                <option value="<?php echo $value->popupStatus; ?>"><?php echo $value->popupStatus; ?></option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-success" onclick="showPopup('<?php echo $value->idpopup; ?>');" data-toggle="tooltip" title="show popup"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-danger" onclick="deletePopup('<?php echo $value->idpopup; ?>', '<?php echo $value->popupType; ?>');" data-toggle="tooltip" title="delete"><i class="fa fa-trash-o"></i></button>
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
<div class="row">
    <div class="col-lg-12">
        <div id="prevpopup"></div>  
    </div>
</div>
<script>
    function updateStatusPopup(id) {                $('#loader').show();

        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Design/update_status_popup'); ?>",
            method: "POST",
            data: {"id": id, "status": status},
            success: function (data) {
                $('#alert').html(data);
                dataPopup();
                $('#loader').hide();

            }
        });
    }
    function deletePopup(id, type) {
        swal({
            title: "Hapus Banner ini ?",
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
                            url: "<?php echo base_url('d/Design/delete_popup'); ?>",
                            method: "POST",
                            data: {"id": id, "type": type},
                            success: function (data) {
                                $('#alert').html(data);
                                dataPopup();
                            }
                        });
                        swal("Terhapus!", "Image Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
    function showPopup(id) {
    $('#loader').show();
        $.ajax({
            url: "<?php echo base_url('d/Design/preview_popup'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#prevpopup').html(data);
                $('#loader').hide();
            }
        });
    }
</script>