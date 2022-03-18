<?php echo $header; ?>
<style type="text/css" media="screen">
    #page-wrap { 
        width: 600px; 
        margin: 15px auto; 
        position: relative; 
    }
    #sidebar { 
        width: 190px; 
        position: fixed; 
        margin-left: 0px; 
    }
    input{
        border-style: solid !important;
        border-width: 1px !important;
        border-color: #ddd !important;
    }
    .card-body{
        font-size: 14px !important;
        padding: 0;
    }
    .nav-item .active{
        background-color: rgb(3, 172, 14) !important;
        border-color:#398439;
    }
</style>
<div class="bread-crumb-detail-single bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Data User
    </span>
</div>
<section class="bgwhite p-t-10 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('MSG')) { ?>
                    <?= $this->session->flashdata('MSG') ?>
                <?php } ?>
                <h3 class="m-text26 p-b-16">
                    <?php echo "Selamat Datang, " . $user->username; ?>
                </h3>
            </div>
            <div class="col-sm-2 col-xs-12">
                <nav>
                    <div>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="javaScript:void(0);" id="navprofile" onclick="profile();">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javaScript:void(0);" id="navorderhistory" onclick="orderHistory();">Order History</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-10 p-b-30">
                <div id="profile" class="card p-l-20 p-b-20">
                    <p class="p-b-28">
                    <table style="width: 100%;">
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $user->username; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $user->useremail; ?></td>
                        </tr>

                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $user->kabupaten . ", " . $user->provinsi; ?></td>
                        </tr>
                        <tr>
                            <td>No Telephone</td>
                            <td><?php echo $user->userHp; ?></td>
                        </tr>
                        <tr>
                            <td>Tipe User</td>
                            <td><?php echo $user->partnerName; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $user->userStatus; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Join</td>
                            <td><?php echo $user->joindate; ?></td>
                        </tr>
                    </table>
                    </p>
                    <p class="p-b-28">
                    <table style="width: 100%;">
                        <tr>
                            <td><a class="btn btn-warning btn-sm" href="<?php echo base_url('pages/update_account/' . encryption($user->iduser) . '') ?>">Edit Account <i class="fa fa-pencil"></i></a>
                            </td>
                            <td><a class="btn btn-danger btn-sm" href="<?php echo base_url('User/logout') ?>">logout <i class="fa fa-sign-out"></i></a>
                            </td>
                        </tr>
                    </table> 
                    </p>
                </div>

                <div id="orderhistory" class="card p-t-10 p-r-10 p-b-10 p-l-10">
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-bordered table-responsive" style="width:100%" id="dataorder">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Tanggal Order</th>
                                    <th>Jenis</th>
                                    <th>Status Pembayaran</th>
                                    <th>No. Resi</th>
                                    <th>Total Pembayaran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataorder as $value) { ?>
                                    <tr>
                                        <td><?php echo strtoupper($value->idorder); ?></td>
                                        <td><?php echo date_ind($value->orderDate); ?></td>
                                        <td><?php echo $value->orderMethod; ?></td>
                                        <td><?php echo $value->status; ?></td>
                                        <td><?php echo $value->receiptNumber; ?></td>
                                        <td>Rp. <?php echo number_format($value->orderSumary); ?></td>
                                        <td>
                                            <?php if ($value->status == "closing paid" || $value->status == "process shiping" || $value->status == "selesai") { ?>
                                                <a href="<?php echo base_url('order/detail_order_history/' . encryption($value->idorder) . ''); ?>" class="btn btn-sm btn-success">Invoice
                                                </a>
                                                <a href="<?php echo base_url('pages/detailorder/' . encryption($value->idorder) . ''); ?>" class="btn btn-sm btn-primary">Detail Order
                                                </a>
                                            <?php } else if ($value->status == "reject") { ?>
                                                <span class="btn btn-sm btn-danger">Order Reject</span>
                                            <?php } else if ($value->status == "canceled") { ?>
                                                <span class="btn btn-sm btn-danger">Order Canceled</span>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url('order/detail_order_history/' . encryption($value->idorder) . ''); ?>" class="btn btn-sm btn-warning">Selesaikan Order
                                                </a>
                                                <button class="btn btn-sm btn-danger" onclick="cancel_order('<?php echo encryption($value->idorder);?>');"><i class="fa fa-close"></i> Cancel order ini</button>
                                            <?php } ?>
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
</section>
<?php echo $footer; ?>
<script src="<?php echo base_url('asset/vendors/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/vendors/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script type="text/javascript">
        $(function () {
            $('#profile').profile();            
            $('#dataorder').DataTable();

        });

        function profile() {
            $('#orderhistory').hide();
            $('#profile').show();
            var navprofile = document.getElementById("navprofile");
            navprofile.classList.add("active");
            var navorderhistory = document.getElementById("navorderhistory");
            navorderhistory.classList.remove("active");
        }

        function orderHistory() {
            $('#profile').hide();
            $('#orderhistory').show();
            var navorderhistory = document.getElementById("navorderhistory");
            navorderhistory.classList.add("active");
            var navprofile = document.getElementById("navprofile");
            navprofile.classList.remove("active");
        }    

        function cancel_order(id) {
            swal({
                title: "",
                text: "Batalkan Order ini ?",
                type: "warning",
                showCancelButton: true, 
                showLoaderOnConfirm: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: "Cancel Order",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function (isConfirm) {
                    if (isConfirm) {
                        $('#loader').show();
                        $.ajax({
                            url: '<?php echo base_url('Order/cancel_order'); ?>',
                            method: "POST",
                            data: {"id":id},
                            dataType: "json",
                            accepts: {
                                json: 'application/json'
                            },
                            success: function (response) {
                                if (response.status === '0') {
                                    swal("error", "" + response.message + "", "error");
                                } else {
                                     swal({
                                        title: "",
                                        text: ""+response.message+"",
                                        type: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#5cb85c",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false,
                                        closeOnCancel: false
                                    },
                                            function (isConfirm) {
                                                if (isConfirm) {
                                                    location.reload();
                                                }
                                        });

                                }
                                Pace.stop();
                                $('#loader').hide();
                            }
                        });
                    } else {
                        swal("", "", "error");
                    }
                });
        } 
</script>
</body>
</html>