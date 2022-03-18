<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Kategori</h4>
    </div>
</div>
<div id="fupdatecategory"></div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Kategory
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table width="100%" class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Nama Kategory</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <?php echo $category; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteCategory(id) {
        swal({
            title: "Hapus Kategory ini ?",
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
                            url: "<?php echo base_url('d/Category/delete_category'); ?>",
                            method: "POST",
                            data: {"idcategory": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataCategory();
                            }
                        });
                        swal("Terhapus!", "Kategory Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
    function fupdateCategory(id) {
        $.ajax({
            url: "<?php echo site_url('d/Category/f_update_category'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#fupdatecategory').html(data);
                $(".textarea").wysihtml5();
            }
        });
    }
</script>