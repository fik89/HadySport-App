<?php
foreach ($keuanganbulananonline as $data) {
    $bulananonline[] = (float) $data->price;
}
foreach ($keuanganbulananoffline as $data) {
    $bulananoffline[] = (float) $data->price;
}
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"></h3>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $neworder->neworder; ?></div>
                            <div>Order (Bayar)</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataOrder('closing paid');">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $neworderunpaid->neworderunpaid; ?></div>
                            <div>Order (Belum Bayar)</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataInvoiceUnpaid();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-heart-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $wishlist->wishlist; ?></div>
                            <div>Wishlist</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataWishlist();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $newpartner->newpartner; ?></div>
                            <div>Partner Baru</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataInvoicePartner();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Total Belanja dari Toko buka
                            <div class="huge"><?php echo "Rp. " . number_format($countshoping->countshoping); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Barang Stok kosong
                            <div class="huge"><?php echo $countproductoutstock->countproductoutstock; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Barang In Stok
                            <div class="huge"><?php echo $countproductinstock->countproductinstock; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Laporan Penjualan Tahun <?php echo date('Y'); ?> 
                </div>
                <div class="panel-body">
                    <canvas id="areaChartBulanan" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset'); ?>/vendors/chartjs/Chart.min.js"></script>
<script type="text/javascript">
$(function () {
    Pace.start();

    var bulanan = document.getElementById('areaChartBulanan').getContext('2d');
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var myDoubleChart = new Chart(bulanan, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                    label: ['Penjualan Online'],
                    data: <?php echo json_encode($bulananonline); ?>,
                    borderColor: [
                        'rgb(3, 172, 14)',
                    ],
                    backgroundColor: [
                        'rgba(0, 0, 0, 0)',
                    ],
                    borderWidth: 2
                },
                {
                    label: ['Penjualan Offline'],
                    data: <?php echo json_encode($bulananoffline); ?>,
                    borderColor: [
                        'rgb(0, 0, 255)',
                    ],
                    backgroundColor: [
                        'rgba(0, 0, 0, 0)',
                    ],
                    borderWidth: 2
                }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Penjualan Online Dan Offline'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                        }
                    }],
                yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Rupiah'
                        }
                    }]
            }
        }
    });
    Pace.start();
});
</script>