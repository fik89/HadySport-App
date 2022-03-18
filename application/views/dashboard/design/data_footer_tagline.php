
<div class="row">
        <h3 class="page-header">Data Footer Tagline
            <span class="pull-right btn btn-success" onclick="uploadFooterTagline();"><i class="fa fa-plus-square"></i> Unggah Footer Tagline</span>
        </h3>                
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Footer Tagline 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataTagline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->id; ?></td>
                                        <td><img src="<?php echo base_url('asset/img/uploads/footer/'.$value->icon);?>"></td>
                                        <td><?php echo $value->taglineTitle; ?></td>
                                        <td><?php echo $value->taglineDescription; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteTagline('<?php echo $value->id?>', '<?php echo $value->icon;?>');"><i class="fa fa-trash"></i></button>
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
<script>
function deleteTagline(id, icon) {
        swal({
            title: "Hapus Item ini ?",
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
                            url: "<?php echo base_url('d/Design/delete_footer_tagline'); ?>",
                            method: "POST",
                            data: {"id": id, "icon":icon},
                            success: function (data) {
                                $('#alert').html(data);
                                dataFooterTagline();
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>