
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">User
            <span class="action pull-right">
                <button class="btn btn-sm btn-primary " onclick="fInputUser();"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-success " onclick="dataUser();"><i class="fa fa-refresh"></i></button>
            </span>
        </h3>
        <div class="row">
            <div id="finputuser"></div>
            <div class="panel panel-green">
                <div class="panel-heading">
                    Tambah User / User
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataUser">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Tipe User</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $value->iduser; ?></td>
                                        <td><?php echo $value->username; ?></td>
                                        <td><?php echo $value->provinsi; ?></td>
                                        <td><?php echo $value->kabupaten; ?></td>
                                        <td><?php echo $value->useremail; ?></td>
                                        <td><?php echo $value->userHp; ?></td>
                                        <td><?php echo $value->tipeuser." ".$value->partnerName; ?></td>
                                        <td>
                                            <select name="status<?php echo $value->iduser; ?>" id="status<?php echo $value->iduser; ?>" class="form-control">
                                                <option value="<?php echo $value->userStatus; ?>"><?php echo $value->userStatus; ?></option>
                                                <option value="Active">Active</option>
                                                <option value="Suspend">suspend</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td><?php echo $value->joindate; ?></td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-success" title="update" onclick="updateStatusUser('<?php echo $value->iduser; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-danger" title="delete" onclick="deleteUser('<?php echo $value->iduser; ?>');"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-sm btn-warning" title="update" onclick="updateUser('<?php echo $value->iduser; ?>');"><i class="fa fa-pencil"></i></button>
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
    function updateStatusUser(id) {
        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/User/update_status_user'); ?>",
            method: "POST",
            data: {"id": id, "status": status},
            success: function (data) {
                $('#alert').html(data);
                dataUser();
            }
        });
    }

    function fInputUser() {
        $.ajax({
            url: "<?php echo base_url('d/User/f_input_user'); ?>",
            method: "POST",
            success: function (data) {
                $('#finputuser').html(data);
                prov();
            }
        });
    }

    function updateUser(id){
         $.ajax({
            url: "<?php echo base_url('d/User/f_edit_user'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#finputuser').html(data);
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
            }
        });

    }
    
    function deleteUser(id) {
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
                            url: "<?php echo base_url('d/User/delete_user'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataUser();
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>