<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Asset Banner
            <span class="pull-right">
                <button class="btn btn-sm btn-primary" onclick="fBannerHome();"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-success" onclick="dataBanner();"><i class="fa fa-refresh"></i></button>
            </span>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataBanner">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Link Produk</th>
                                    <th>Sort</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><img src="<?php echo site_url('asset/img/uploads/banner/') . $value->image; ?>" style="max-width: 180px;"></td>
                                        <td>
                                            <select name="position<?php echo $value->idbannerimage; ?>" id="position<?php echo $value->idbannerimage; ?>" class="form-control">
                                                <option value="<?php echo $value->bannerPosition; ?>"><?php echo $value->bannerPosition; ?></option>
                                                <option value="bannerhome">Banner Home</option>
                                                <option value="featuretop">Feature Add Top</option>
                                                <option value="featurebottom">Feataure Add Bottom</option>
                                                <option value="logo">Logo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="status<?php echo $value->idbannerimage; ?>" id="status<?php echo $value->idbannerimage; ?>" class="form-control">
                                                <option value="<?php echo $value->status; ?>"><?php echo $value->status; ?></option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="link<?php echo $value->idbannerimage; ?>" id="link<?php echo $value->idbannerimage; ?>" class="form-control">
                                                <option value="<?php echo $value->bannerLink; ?>"><?php echo $value->bannerLink; ?></option>
                                                <option value="<?php echo base_url(); ?>">Logo Toko</option>
                                                <?php echo $category; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sort<?php echo $value->idbannerimage; ?>" id="sort<?php echo $value->idbannerimage; ?>" class="form-control">
                                                <option value="<?php echo $value->sortOrder; ?>"><?php echo $value->sortOrder; ?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="bannertext<?php echo $value->idbannerimage; ?>" id="bannertext<?php echo $value->idbannerimage; ?>" row="7" maxlength="50"><?php echo $value->bannerText; ?></textarea>
                                        </td>
                                        <td>
                                            <span class="centered">
                                                <button class="btn btn-sm btn-primary" title="update" onclick="updateStatusBanner('<?php echo $value->idbannerimage; ?>');"><i class="fa fa-refresh"></i></button>
                                                <button class="btn btn-sm btn-danger" title="hapus" onclick="deleteBanner('<?php echo $value->idbannerimage; ?>');"><i class="fa fa-trash"></i></button>
                                            </span>
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
<div id="finputmember"></div>
<script>
    function updateStatusBanner(id) {
        var status = $('#status' + id).val();
        var position = $('#position' + id).val();
        var link = $('#link' + id).val();
        var sort = $('#sort' + id).val();
        var text = $('#bannertext' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Design/update_status_banner'); ?>",
            method: "POST",
            data: {"id": id, "status": status, "position": position, "link": link, "sortorder": sort, "bannertext": text},
            success: function (data) {
                $('#alert').html(data);
                dataBanner();
            }
        });
    }

    function deleteBanner(id) {
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
                            url: "<?php echo base_url('d/Design/delete_banner'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataBanner();
                            }
                        });
                        swal("Terhapus!", "Image Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>