<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Laporan Keuangan
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Transaksi Pada Bulan <?php echo get_bulan(date('m')) . '- ' . date('Y'); ?>
                        <span style="color:#A8B4BD"> <i class="fa fa-bar-chart-o"></i> Pembelian Offline</span>
                        <span style="color:#2677B5"> <i class="fa fa-bar-chart-o"></i> Pembelian Online</span>
                    </div>
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
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
            
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Laporan Penjualan Online & Offline Tahun <?php echo date('Y'); ?> 
                    </div>
                    <div class="panel-body">
                        <canvas id="areaChartDuoble" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
foreach ($keuanganbulananonline as $data) {
    $bulananonline[] = (float) $data->price;
}
foreach ($keuanganbulananoffline as $data) {
    $bulananoffline[] = (float) $data->price;
}

foreach ($keuanganbulanan as $data) {
    $totalbulanan[] = (float) $data->price;
}

?>
<script src="<?php echo base_url('asset'); ?>/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url('asset'); ?>/vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('asset'); ?>/vendors/morrisjs/morris.min.js"></script>
<script type="text/javascript">
    $(function () {
        Pace.start();
        Morris.Area({
            element: 'morris-area-chart',
            data: <?php echo json_encode($keuanganharian); ?>,
            xkey: 'day',
            ykeys: ['priceonline', 'priceoffline'],
            labels: ['Pembelian Online', 'Pembelian Offline'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true,
            parseTime: false,
            fillOpacity: 0.0,
            smooth:true
        });

        var double = document.getElementById('areaChartDuoble').getContext('2d');
        var bulanan = document.getElementById('areaChartBulanan').getContext('2d');
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var myDoubleChart = new Chart(double, {
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

        var myDoubleChart = new Chart(bulanan, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                        label: ['Penjualan Bulanan'],
                        data: <?php echo json_encode($totalbulanan); ?>,
                        borderColor: [
                            'rgb(255, 153, 51)',
                        ],
                        backgroundColor: [
                            'rgba(0, 0, 0, 0)',
                        ],
                        borderWidth: 2
                    }
                    ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Total Penjualan Bulanan'
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