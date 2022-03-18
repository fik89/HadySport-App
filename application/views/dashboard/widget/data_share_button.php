<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Share Button
        </h3>
        <div class="row">
            <div class="alert alert border-grey" alert-dismissable>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Penting!!!</strong><br>
                Anda dapat menggunakan Share Button dengan mendaftar ke pihak ke tiga, mendaftarkan wesbite atau domain Anda. setelah mendaftar Anda
                mendapatkan script ID widget. kemudian Anda ambil ID Script tersebut untuk di inputkan dalam form dibawah ini.<br>
                Anda dapat melakukan registrasi di <a href="https://platform.sharethis.com/sign-up" target="_blank">https://platform.sharethis.com/sign-up</a>
                <br>Penjelasan lebih detail dapat di baca di menu Dokumentasi.
            </div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-datachatbutton">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Widget Script ID</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $value->widgetName; ?>
                                        </td>
                                        <td>
                                            <input class="form-control" name="scriptid<?php echo $value->id; ?>" id="scriptid<?php echo $value->id; ?>" value="<?php echo $value->widgetScriptId; ?>">
                                        </td>
                                        <td>
                                            <select name="status<?php echo $value->id; ?>" id="status<?php echo $value->id; ?>" class="form-control">
                                                <option value="<?php echo $value->widgetStatus; ?>"><?php echo $value->widgetStatus; ?></option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update status" onclick="updateWidget('<?php echo $value->id; ?>');"><i class="fa fa-refresh"></i></button>
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
    function updateWidget(id) {
        var status = $('#status' + id).val();
        var scriptid = $('#scriptid' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Widget/update_widget'); ?>",
            method: "POST",
            data: {id: id, status: status, scriptid: scriptid},
            success: function (data) {
                $('#alert').html(data);
                dataWidget('Share Button');
            }
        });
    }
</script>