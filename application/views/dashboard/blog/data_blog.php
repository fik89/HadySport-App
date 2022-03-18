<div id="editcs"></div>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Berita
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Berita
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered" style="width:100%" id="dataTables-datablog">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Read</th>
                                <th>Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datablog as $value) { ?>
                                <tr>
                                    <td><?php echo $value->idblogpost; ?></td>
                                    <td><?php echo $value->blog_category_name; ?></td>
                                    <td><?php echo $value->blog_title; ?></td>
                                    <td><?php echo $value->post_read; ?></td>
                                    <td><?php echo date_ind($value->post_date)." - ".get_time($value->post_date); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" title="update" onclick="update_blog('<?php echo $value->idblogpost; ?>');"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="delete" onclick="delete_blog('<?php echo $value->idblogpost; ?>');"><i class="fa fa-trash"></i></button>
                                        <a href="<?php echo base_url('pages/blog-detail/' . $value->post_blog_slug . ''); ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="view" target="_blank"><i class="fa fa-firefox"></i></button>
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
    function update_blog(id) {
        $.ajax({
            url: "<?php echo base_url('d/Blog/update_blog'); ?>",
            method: "POST",
            data: {id: id},
            success: function (data) {
                $('#data').html(data);
                $('html, body').animate({
                    scrollTop: $("#page-wrapper").offset().top
                }, 2000);
                $(".textarea").wysihtml5();
            }
        });
    }
    function delete_blog(id) {
        var id = id;
        swal({
            title: "Hapus Data ini ?",
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
                            url: '<?php echo base_url('d/Blog/hapus_blog'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataBlog();
                            }
                        });
                        swal("Terhapus!", "Data terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>