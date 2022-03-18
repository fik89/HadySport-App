
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Wishlist</h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                   Count Wishlist
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataWishlist">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah Wish</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $value) { ?>
                            <tr>
                                <td><?php echo $value->productName; ?></td>
                                <td><?php echo $value->count; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>      
    </div>
</div>

<div class="row">
<div class="col-lg-12">
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Lengkap Wishlist
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-dataWishlist2">
                        <thead>
                            <tr>
                                <th>Nama Produk</th> 
                                <th>HP User</th>
                                <th>IP Address</th>
                                <th>Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataall as $value) { ?>
                            <tr>
                                <td><?php echo $value->productName; ?></td>
                                <td><?php echo $value->phone; ?></td>
                                <td><?php echo $value->ipAddress; ?></td>
                                <td><?php echo $value->dateSubmit; ?></td>
                                <td><a href="tel:<?php echo $value->phone;?>"<button class="btn btn-success"><i class="fa fa-phone"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>      
    </div>
</div>