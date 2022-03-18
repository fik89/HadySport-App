 <div class="row">
    <div class="action pull-right">
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Daftar Rekening Bank
                    <button class="btn btn-sm btn-primary pull-right" onclick="fInputBank();"><i class="fa fa-plus"></i></button>
                </h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-databank">
                        <thead>
                            <tr>
                                <th>Nama Bank</th>
                                <th>Nama Pemilik</th>
                                <th>Nomor Rekening</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($databank as $value) { ?>
                            <tr>
                                <td>
                                    <input class="form-control" name="bankname<?php echo $value->idbank;?>" id="bankname<?php echo $value->idbank;?>" value="<?php echo $value->bankName; ?>" readonly>
                                </td>
                                <td>
                                    <input class="form-control" name="accountname<?php echo $value->idbank;?>" id="accountname<?php echo $value->idbank;?>" value="<?php echo $value->accountName; ?>">
                                </td>
                                <td>
                                    <input class="form-control" name="accountnumber<?php echo $value->idbank;?>" id="accountnumber<?php echo $value->idbank;?>" value="<?php echo $value->accountNumber; ?>">
                                </td>
                                <td>
                                    <select name="status<?php echo $value->idbank; ?>" id="status<?php echo $value->idbank; ?>" class="form-control">
                                        <option value="<?php echo $value->status; ?>"><?php echo $value->status; ?></option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </td>
                                <td align="center">
                                   <button class="btn btn-sm btn-primary" title="update status" onclick="updateStatusBank('<?php echo $value->idbank; ?>');"><i class="fa fa-refresh"></i></button>
                                   <button class="btn btn-sm btn-danger" title="update status" onclick="deleteDatabank('<?php echo $value->idbank; ?>');"><i class="fa fa-trash"></i></button>
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
<script type="text/javascript">
   function updateStatusBank(id) {
    var bankname = $('#bankname' + id).val();
    var accountname = $('#accountname' + id).val();
    var accountnumber = $('#accountnumber' + id).val();
    var status = $('#status' + id).val();
    $.ajax({
        url: "<?php echo base_url('d/System/update_status_bank'); ?>",
        method: "POST",
        data: {"id": id, "status": status, "bankname":bankname, "accountname":accountname, "accountnumber":accountnumber},
        success: function (data) {
            $('#alert').html(data);
            dataListBank();
        }
    });
}
function fInputBank(){
  $('#loader').show();
  $.ajax({
    url: '<?php echo base_url('d/System/f_input_bank') ?>',
    method: "GET",
    success: function (resp) {
        $('#inputbank').html(resp);
        $('#loader').hide();
        $('[data-toggle="tooltip"]').tooltip();
    }
});
}
function deleteDatabank(id) {
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
                    url: "<?php echo base_url('d/System/delete_data_bank'); ?>",
                    method: "POST",
                    data: {"id": id},
                    success: function (data) {
                        $('#alert').html(data);
                        dataListBank();
                    }
                });
                swal("Terhapus!", "Item Terhapus", "success");
            } else {
                swal("", "", "error");
            }
        });
    }
</script>