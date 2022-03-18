<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data FB Pixel
            <span class="pull-right">
                <button class="btn btn-sm btn-primary" onclick="fAdsFbPixel();"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-success" onclick="dataAdsFbPixel();"><i class="fa fa-refresh"></i></button>
            </span>
        </h3>
        <div class="row">
            <div id="fads"></div>
            <div id="fupadateads"></div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataadsfbpixel">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Pixel ID</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->adsName; ?></td>
                                        <td><?php echo $value->adsScript; ?></td>
                                        <td>
                                            <select name="status<?php echo $value->idads; ?>" id="status<?php echo $value->idads; ?>" class="form-control">
                                                <option value="<?php echo $value->adsStatus; ?>"><?php echo $value->adsStatus; ?></option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update status" onclick="updateStatusFbAds('<?php echo $value->idads; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-warning" data-toggle="tooltip" title="update ads" onclick="updateAds('<?php echo $value->idads; ?>');"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="hapus" onclick="deleteAds('<?php echo $value->idads; ?>');"><i class="fa fa-trash"></i></button>
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
<div id=""></div>
<script>
    function updateStatusFbAds(id) {
        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Ads/update_status_ads'); ?>",
            method: "POST",
            data: {"id": id, "status": status},
            success: function (data) {
                $('#alert').html(data);
                dataAdsFbPixel();
            }
        });
    }

    function updateAds(id) {
        $.ajax({
            url: "<?php echo base_url('d/Ads/f_update_ads'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#fupadateads').html(data);
            }
        });
    }

    function deleteAds(id) {
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
                            url: "<?php echo base_url('d/Ads/delete_ads'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataAdsFbPixel();
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
    function fAdsFbPixel() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Ads/f_ads_pixel'); ?>',
            method: "GET",
            success: function (resp) {
                $('#fads').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
</script>