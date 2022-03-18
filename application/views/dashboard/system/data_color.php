<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Warna Produk
            <button class="btn btn-primary pull-right" onclick="fStoreColor();"><i class="fa fa-upload"></i> Tambah Warna Produk</button>      
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-datacolor">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama warna</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->id; ?></td>
                                        <td><input class="form-control" name="name<?php echo $value->id; ?>" id="name<?php echo $value->id; ?>" value="<?php echo $value->colorName; ?>">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update Warna" onclick="updateColor('<?php echo $value->id; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="hapus Warna" onclick="deleteColor('<?php echo $value->id; ?>');"><i class="fa fa-trash"></i></button>
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
    function updateColor(id) {
        $('#loader').show();
        var name = $('#name' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Color/update_color'); ?>",
            method: "POST",
            data: {id: id, name: name},
            success: function (data) {
                $('#alert').html(data);
                dataColor();
                $('#loader').hide();
            }
        });
    }
    function deleteColor() {

    }
    function fStoreColor() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Color/f_store_color'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
</script>