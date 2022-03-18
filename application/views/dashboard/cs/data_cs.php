<div id="editcs"></div>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Customer Service
            <button class="btn btn-sm btn-primary pull-right" onclick="fStoreCs();"><i class="fa fa-plus"></i></button>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Customer Service
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-datacs">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor Hp</th>
                                <th>Count Order</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $value) { ?>
                                <tr>
                                    <td>
                                        <input class="form-control" name="name<?php echo $value->id;?>" id="name<?php echo $value->id;?>" value="<?php echo $value->csName; ?>">
                                    </td>
                                    <td>
                                        <input class="form-control" name="phone<?php echo $value->id;?>" id="phone<?php echo $value->id;?>" value="<?php echo $value->csPhone; ?>">
                                    </td>
                                    <td><?php echo $value->count; ?></td>
                                    <td>
                                        <select name="status<?php echo $value->id; ?>" id="status<?php echo $value->id; ?>" class="form-control">
                                            <option value="<?php echo $value->status; ?>"><?php echo $value->status; ?></option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update cs" onclick="updateCs('<?php echo $value->id; ?>');"><i class="fa fa-refresh"></i></button>
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
<script>
    function updateCs(id) {
        var name = $('#name' + id).val();
        var phone = $('#phone' + id).val();
        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Cs/update_cs'); ?>",
            method: "POST",
            data: {id: id, status: status, name:name, phone:phone},
            success: function (data) {
                $('#alert').html(data);
                dataCs();
            }
        });
    }
</script>