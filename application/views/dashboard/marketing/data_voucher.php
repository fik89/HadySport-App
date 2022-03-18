<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Voucher
            <button class="btn btn-primary pull-right" onclick="fVoucher();"><i class="fa fa-plus"></i></button>
        </h3>
        <div class="row">
            <div id="addvoucher"></div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-datavoucher">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Minimum Belanja</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" id="vouchername<?php echo $value->idvoucher;?>" name="vouchername<?php echo $value->idvoucher;?>" value="<?php echo $value->voucherName; ?>">
                                        </td>
                                        <td>
                                            <input class="money form-control" type="text" id="voucherprice<?php echo $value->idvoucher;?>" name="voucherprice<?php echo $value->idvoucher;?>" value="<?php echo $value->voucherPrice; ?>">
                                        </td>
                                        <td>
                                           <input class="form-control" type="text" id="vouchercode<?php echo $value->idvoucher;?>" name="vouchercode<?php echo $value->idvoucher;?>" value="<?php echo $value->voucherCode; ?>">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="voucherdesc<?php echo $value->idvoucher;?>" name="voucherdesc<?php echo $value->idvoucher;?>" value="<?php echo $value->voucherDescription; ?>">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="mintr<?php echo $value->idvoucher;?>" name="mintr<?php echo $value->idvoucher;?>" value="<?php echo $value->minTransaction; ?>">
                                        </td>
                                        <td><input class="form-control" type="date" name="startdate<?php echo $value->idvoucher; ?>" id="startdate<?php echo $value->idvoucher; ?>" value="<?php echo $value->startDate; ?>"></td>
                                        <td><input class="form-control" type="date" name="enddate<?php echo $value->idvoucher; ?>" id="enddate<?php echo $value->idvoucher; ?>" value="<?php echo $value->endDate; ?>"></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update" id="<?php echo $value->idvoucher; ?>" onclick="updateVoucher('<?php echo $value->idvoucher; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="delvoucher btn btn-sm btn-danger" data-toggle="tooltip" title="hapus" data-idvoucher="<?php echo $value->idvoucher; ?>"><i class="fa fa-trash"></i></button>
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
    function fVoucher() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Marketing/f_voucher'); ?>',
            method: "GET",
            success: function (resp) {
                $('#addvoucher').html(resp);
                $('#loader').hide();
                $('.money').mask('000.000.000', {reverse: true});
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function updateVoucher(id) {
        var name = $('#vouchername' + id).val();
        var price = $('#voucherprice' + id).val();
        var code = $('#vouchercode' + id).val();
        var desc = $('#voucherdesc' + id).val();
        var mintr = $('#mintr'+id).val();
        var startdate = $('#startdate' + id).val();
        var enddate = $('#enddate' + id).val();
        $.ajax({
            url: "<?php echo site_url('d/Marketing/update_voucher'); ?>",
            method: "POST",
            data: {"id": id,"vouchername":name,"voucherprice":price,"vouchercode":code,"voucherdesc":desc ,"startdate": startdate, "enddate": enddate, "mintransaction": mintr},
            success: function (data) {
                $('#alert').html(data);
                dataVoucher();
            }
        });
    }

    $(document).on('click', '.delvoucher', function () {
        var id = $(this).data("idvoucher");
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
                            url: '<?php echo base_url('d/Marketing/delete_voucher'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataVoucher();
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    });
</script>