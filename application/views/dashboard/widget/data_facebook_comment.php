<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Facebook Comment
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-datachatbutton">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>App ID Anda</th>
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
                dataWidget('Facebook Comment');
            }
        });
    }
</script>