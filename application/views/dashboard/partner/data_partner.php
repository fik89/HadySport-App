
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Rule Partner 
            <span class="pull-right">
                <button class="btn btn-sm btn-primary" onclick="fInputPartner();"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-success" onclick="dataPartner();"><i class="fa fa-refresh"></i></button>
            </span>
        </h3>
        <div id="finputpartner"></div>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataPartner">
                            <thead>
                                <tr>
                                    <th>Nama Partner</th>
                                    <th>Rule</th>
                                    <th>Berbayar</th>
                                    <th>Jumlah Biaya</th>
                                    <th>Potongan Harga</th>
                                    <th>Potongan Persen %</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>update</th>
                                    <th>hapus</th>
                                    <th>edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                <tr>
                                    <td><?php echo $value->partnerName; ?></td>
                                    <td><?php echo $value->partnerRule; ?></td>
                                    <td><?php echo $value->partnerPay; ?></td>
                                    <td><?php echo "Rp. <span class='money'>".$value->partnerAmountCost."</span>"; ?></td>
                                    <td><?php echo $value->partnerDiscountPrice; ?></td>
                                    <td><?php echo $value->partnerDiscountPercent; ?></td>
                                    <td><?php echo $value->partnerDescription; ?></td>
                                    <td>
                                        <select name="status<?php echo $value->idpartner; ?>" id="status<?php echo $value->idpartner; ?>" class="form-control">
                                            <option value="<?php echo $value->partnerStatus; ?>"><?php echo $value->partnerStatus; ?></option>
                                            <option value="active">active</option>
                                            <option value="inactive">inactive</option>
                                        </select>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-sm btn-success" title="update" onclick="updateStatusPartner('<?php echo $value->idpartner; ?>');"><i class="fa fa-refresh"></i></button>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-sm btn-danger" title="delete" onclick="deletePartner('<?php echo $value->idpartner; ?>');"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-sm btn-warning" title="update" onclick="updateDataPartner('<?php echo $value->idpartner; ?>');"><i class="fa fa-pencil"></i>
                                        </button>
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
    function updateStatusPartner(id) {
        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Partner/update_status_partner'); ?>",
            method: "POST",
            data: {"id": id, "status": status},
            success: function (data) {
                $('#alert').html(data);
                dataPartner();
            }
        });
    }
    function updateDataPartner(id) {
        var status = $('#status' + id).val();
        $.ajax({
            url: "<?php echo base_url('d/Partner/f_update_data_partner'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#data').html(data);
            }
        });
    }

    function fInputPartner() {
        $.ajax({
            url: "<?php echo base_url('d/Partner/f_input_partner'); ?>",
            method: "POST",
            success: function (data) {
                $('#finputpartner').html(data);
                $('.money').mask('0.000.000.000', {reverse: true});
                $('#mountcost').hide();
            }
        });
    }

    function deletePartner(id) {
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
                    url: "<?php echo base_url('d/Partner/delete_partner'); ?>",
                    method: "POST",
                    data: {"id": id},
                    success: function (data) {
                        $('#alert').html(data);
                        dataPartner();
                    }
                });
                swal("Terhapus!", "Item Terhapus", "success");
            } else {
                swal("", "", "error");
            }
        });
    }
</script>