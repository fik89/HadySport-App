<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Customer
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Customer 
                </div>
                <div class="panel-body">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataCustomer">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Nama</th>
                                    <th>Kota</th>
                                    <th>Order By</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->idorder; ?></td>
                                        <td><?php echo $value->firstName . " " . $value->lastName; ?></td>
                                        <td><?php echo $value->namaKabupaten; ?></td>
                                        <td><?php echo $value->iduser; ?></td>
                                        <td><?php echo $value->status; ?></td>
                                        <td>
                                            <button class="btn btn-success" onclick="detailCustomer('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="detail customer"><i class="fa fa-eye"></i></button>
                                            <a href="tel:<?php echo $value->custHp; ?>" class="btn btn-success" target="_blank" data-toggle="tooltip" title="Hubungi  Customer"><i class="fa fa-phone"></i></a>
                                            <button class="btn btn-danger" onclick="delete_order('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>
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
<div id="datadetail"></div>
<script>
    function detailCustomer(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#datadetail').html(data);
                $('#loader').hide();

            }
        });
    }

    function delete_order(id) {
        var id = id;
        swal({
            title: "Anda akan menghapus data keseluruhan order dan data invoice ?",
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
                            url: '<?php echo base_url('d/Sales/delete_data_order'); ?>',
                            method: "POST",
                            dataType: "json",
                            accepts: {
                                json: 'application/json'
                            },
                            data: {"id": id},
                            success: function (resp) {
                                if(resp.status == 0){
                                    swal("",""+resp.message+"","error");
                                }else{
                                    swal("",""+resp.message+"","success");
                                    dataCustomer();
                                }
                            },
                            error: function (resp) {
                                swal("error, error_code: " + resp.status);
                            }
                        });
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>