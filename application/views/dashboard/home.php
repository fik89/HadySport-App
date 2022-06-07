<!DOCTYPE html>
<html lang="en">
    <head>
         
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $profile->companyName; ?>">
        <meta name="author" content="<?php echo $profile->companyName; ?>">
        <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/uploads/banner/') ?><?php if(!empty($icontitle->image)){echo $icontitle->image;}?>"/>       
        <title><?php echo $profile->companyName; ?></title>
        <link href="<?php echo base_url('asset/') ?>vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('asset/') ?>vendors/select2/select2.min.css">
        <link href="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>vendors/morrisjs/morris.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('asset/') ?>vendors/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>vendors/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>vendors/datatables-responsive/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/') ?>css/animate.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('asset/') ?>vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <script src="<?php echo base_url('asset/') ?>vendors/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url('asset/') ?>js/timer.js"></script>
        <script src="<?php echo base_url('asset/') ?>js/jquery.validate.min.js"></script>
        <link href='<?php echo base_url('') ?>asset/vendors/bootstrap-star-rating/css/star-rating.css' type='text/css' rel='stylesheet'>
        <link rel="stylesheet" href="<?php echo base_url('asset/') ?>vendors/pace/pace.css">
        <link rel="stylesheet" href="<?php echo base_url('asset/') ?>vendors/Chartjs/Chart.css">
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="JavaScript:void(0);"><?php echo $profile->companyName; ?></a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li><div class="loader" id="loader"><i class="fa fa-refresh fa-spin"></i></div></li>
                    <li class="dropdown"><span id="date_time"></span></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li><a href="JavaScript:void(0);"><i class="fa fa-user fa-fw"></i><?php echo $this->session->userdata('username'); ?></a>
                            </li>
                            <li><a href="JavaScript:void(0);" onclick="updateUserLogin('<?php echo $this->session->userdata('iduser') ?>');"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('d/User/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="JavaScript:void(0);" onclick="reportHome();"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tags fa-fw"></i> Katalog<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Kategori <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="fCategory();"><i class="fa fa-angle-double-right fa-fw"></i> Tambah kategori</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataCategory();"><i class="fa fa-angle-double-right fa-fw"></i> Data Kategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Produk <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="fUploadProduct();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Produk</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataProduct();"><i class="fa fa-angle-double-right fa-fw"></i> Data Produk</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="ulasanProduct();"><i class="fa fa-angle-double-right fa-fw"></i> Ulasan Produk</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Transaksi Offline<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="inputTransaksi();"><i class="fa fa-angle-double-right fa-fw"></i> Input Transaksi</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataTransaksi();"><i class="fa fa-angle-double-right fa-fw"></i> Data Transaksi</a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            <li>
                                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Transaksi Online<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataOrder('closing paid');"><i class="fa fa-angle-double-right fa-fw"></i> Order Masuk (Bayar)</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataWishlist()"><i class="fa fa-angle-double-right fa-fw"></i> Data wishlist</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataOrderAll();"><i class="fa fa-angle-double-right fa-fw"></i> Data Semua Order</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataInvoiceUnpaid();"><i class="fa fa-angle-double-right fa-fw"></i> Invoice (Belum Bayar)</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataProductRetur();"><i class="fa fa-angle-double-right fa-fw"></i> Request Retur</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- <li>
                                <a href="#"><i class="fa fa-dollar fa-fw"></i> Keuangan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataKeuangan();"><i class="fa fa-angle-double-right fa-fw"></i> Data Keuangan</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="laporanKeuangan();"><i class="fa fa-angle-double-right fa-fw"></i> Chart</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="laporanPenjualan();"><i class="fa fa-angle-double-right fa-fw"></i> Laporan Penjualan</a>
                                    </li>
                                </ul>
                            </li> -->
                            <li>
                                <a href="#"><i class="fa fa-share fa-fw"></i> Marketing produk<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataProductSale();"><i class="fa fa-angle-double-right fa-fw"></i> Flashsale</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataVoucher();"><i class="fa fa-angle-double-right fa-fw"></i> Voucher</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataProductBestSeller();"><i class="fa fa-angle-double-right fa-fw"></i> Data Produk Best Seller</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i> User<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataUser();"><i class="fa fa-angle-double-right fa-fw"></i> Data User</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Partner <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataPartner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Rule Partner</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataInvoicePartner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Invoice Registrasi</a>
                                    </li>
                                </ul>
                            </li>

                          <!--   <li>
                                <a href="#"><i class="fa fa-desktop fa-fw"></i> Design<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Banner & Logo <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataBanner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Banner</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="fBannerHome();"><i class="fa fa-angle-double-right fa-fw"></i> Unggah Banner</a>
                                            </li> 
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Pop Up <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataPopup();"><i class="fa fa-angle-double-right fa-fw"></i> Data Pop Up</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="uploadPopup();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Pop Up</a>
                                            </li> 
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Footer Tagline <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataFooterTagline();"><i class="fa fa-angle-double-right fa-fw"></i> Data Footer Tagline</a>
                                            </li>
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="uploadFooterTagline();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Footer Tagline</a>
                                            </li> 
                                        </ul>
                                    </li>


                                </ul>
                            </li> -->

                            <!-- <li>
                                <a href="#"><i class="fa fa-envelope fa-fw"></i> Kontak & Pesan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataContact();"><i class="fa fa-angle-double-right fa-fw"></i> Data Pesan</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataSubscribe();"><i class="fa fa-angle-double-right fa-fw"></i> Data Email Subcribe</a>
                                    </li>
                                </ul>
                            </li> -->
                            
                            <li>
                                <a href="#"><i class="fa fa-wechat fa-fw"></i> Custommer Service<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataCs();"><i class="fa fa-angle-double-right fa-fw"></i> Data CS</a>
                                    </li>
                                     <li>
                                        <a href="JavaScript:void(0);" onclick="fStoreCs();"><i class="fa fa-angle-double-right fa-fw"></i> Tambah CS</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- <li>
                                <a href="#"><i class="fa fa-terminal fa-fw"></i> Widget<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataWidget('Chat Button');"><i class="fa fa-angle-double-right fa-fw"></i> Chat Button</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataWidget('Share Button');"><i class="fa fa-angle-double-right fa-fw"></i> Share Button</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataWidget('Facebook Comment');"><i class="fa fa-angle-double-right fa-fw"></i> Facebook Comment</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataWidget('Order Via WhatsApp');"><i class="fa fa-angle-double-right fa-fw"></i> Order Via WhatsApp</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-magic fa-fw"></i> Tracking Setting <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="dataAdsFbPixel();"><i class="fa fa-angle-double-right fa-fw"></i> FB Pixel</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->

                             <!-- <li>
                                <a href="#"><i class="fa fa-wordpress fa-fw"></i> News / Blog<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="unggahBlog();"><i class="fa fa-angle-double-right fa-fw"></i> Unggah Blog</a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="dataBlog();"><i class="fa fa-angle-double-right fa-fw"></i> Data Blog</a>
                                    </li>
                                </ul>
                            </li>

                             <li>
                                <a href="#"><i class="fa fa-firefox fa-fw"></i> Pages<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="pages();"><i class="fa fa-angle-double-right fa-fw"></i> Data Page</a>
                                    </li>
                                </ul>
                            </li> -->

                            <li>
                                <a href="#"><i class="fa fa-cogs fa-fw"></i> System<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="JavaScript:void(0);" onclick="settingCompanyProfile();"><i class="fa fa-angle-double-right fa-fw"></i> Settings Toko</a>
                        
                                    </li>
                                    <!-- <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Maintenance <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="JavaScript:void(0);" onclick="listExportdata();"><i class="fa fa-angle-double-right fa-fw"></i> Export Data</a>
                                            </li>
                                        </ul>
                                    </li> -->
                                </ul>
                            </li>
                            
                            <li>
                                <a href="JavaScript:void(0);" onclick="settingcod();"><i class="fa fa-truck fa-fw"></i> Setting COD</a>
                            </li>

                            <!-- <li>
                                <a href="JavaScript:void(0);" onclick="documentation();"><i class="fa fa-book fa-fw"></i> Dokumentasi</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div id="alert"></div>
                    <div id="data"></div>
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('asset/') ?>js/jquery.mask.min.js"></script>
        
        <script src="<?php echo base_url('asset/') ?>vendors/bootstrap/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url('asset/'); ?>vendors/select2/select2.full.min.js"></script>

        <script src="<?php echo base_url('asset/') ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('asset/') ?>vendors/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url('asset/') ?>vendors/datatables-responsive/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.js"></script>

        <script src="<?php echo base_url('asset/') ?>vendors/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="<?php echo base_url('asset/') ?>dist/js/sb-admin-2.js"></script>
        <script src="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo base_url('asset/') ?>vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src='<?php echo base_url('') ?>asset/vendors/bootstrap-star-rating/js/star-rating.min.js' type='text/javascript'></script>
        
        <script src="<?php echo base_url('asset/') ?>vendors/pace/pace.min.js"></script>
        <script src="<?php echo base_url('asset'); ?>/vendors/chartjs/Chart.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2();
            window.onload = date_time('date_time');
            $(function () {
                $(".textarea").wysihtml5();
                Pace.start();
            });
            $(document).ready(function () {
                $('.money').mask('0.000.000.000', {reverse: true});
                $(".textarea").wysihtml5();
                $('[data-toggle="tooltip"]').tooltip();
                reportHome();
            });
            
            // keuangan
            function dataKeuangan(){
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Keuangan/data_keuangan'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        load_table_keuangan();
                        $('#loader').hide();
                        Pace.stop();
                    }
                }); 
            }
            function laporanKeuangan(){
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Keuangan/laporan_keuangan'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        Pace.stop();
                    }
                }); 
            }
            function laporanPenjualan(){
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Keuangan/data_penjualan'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        load_table_penjualan();
                        $('#loader').hide();
                        Pace.stop();
                    }
                }); 
            }
            // Transaksi
            function inputTransaksi(){
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Transaksi/input_transaksi'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        prov();        
                        $('.select2').select2();

                    }
                }); 
            }
            function dataTransaksi(){
                Pace.restart();
                $.ajax({
                    url: '<?php echo base_url('d/Transaksi/data_transaksi'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        load_table_transaksi_offline();
                        Pace.stop();
                    }
                }); 
            }
            // ulasan
            function ulasanProduct(){
               $('#loader').show();
               Pace.start();
                $.ajax({
                    url: '<?php echo base_url('d/Product/data_ulasan'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        load_table_product();
                        $('.ratingbar').rating({
                            showCaption: false,
                            showClear: false,
                            size: 'md'
                        });
                        Pace.stop();
                    }
                }); 
            }
            
            function pages(){
            $('#loader').show();
            $.ajax({
                    url: '<?php echo base_url('d/Pages/data_page'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataservice').DataTable();
                    }
                }); 
            }
            //blog
             function unggahBlog(){
               $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Blog/f_unggah_blog'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $(".textarea").wysihtml5();
                    }
                }); 
            }
            function dataBlog(){
               $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Blog/data_blog'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-datablog').DataTable();
                    }
                }); 
            }
            //end news
            //color
            function dataColor(){
               $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Color/data_color'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-datacolor').DataTable();
                    }
                }); 
            }
            //endcolor
            //doc
            function documentation(){
               $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Home/documentation'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                }); 
            }

            function settingcod(){
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Home/settingcod') ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            /// end-user

            //cs
            function dataCs(){
               $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Cs/data_cs'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-datacs').DataTable();
                    }
                }); 
            }
            function fStoreCs(){
            $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Cs/f_store_cs'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                }); 
            }
            //end cs
            //widget
            function dataWidget(name){
                 $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Widget/data_widget_by_name'); ?>',
                    method: "POST",
                    data: {name:name},
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-datachatbutton').DataTable();
                    }
                });
            }
            //end widget
            /// footertagline
            function dataFooterTagline() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/data_footer_tagline'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                });
            }
            function uploadFooterTagline() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/f_store_footer_tagline'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                });
            }

            function uploadcod() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Home/upload_cod'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $(".textarea").wysihtml5();
                        $('[data-toggle="tooltip"]').tooltip();
                        $('#loader').hide();

                    }
                });
            }
            /// endtagline
            function updateUserLogin(id) {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/User/user_by_id'); ?>',
                    method: "POST",
                    data: {id: id},
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                });
            }
            function reportHome() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Home/report_home'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                    }
                });
            }
            ///profil company 
            function settingCompanyProfile() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/System/setting_company_profile'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataprofile').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            } ///end profil company


            /// f categori
            function fCategory() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Category/f_category') ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $(".textarea").wysihtml5();
                        $('[data-toggle="tooltip"]').tooltip();
                        $('#loader').hide();

                    }
                });
            }
            function dataCategory() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Category/data_category') ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }/// end categori

            /// product
            function dataProduct() {
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Product/data_product'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        load_table_product();
                        $('[data-toggle="tooltip"]').tooltip();
                        $('.money').mask('0.000.000.000', {reverse: true});
                        Pace.stop();
                    }
                });
            }

            function fUploadProduct() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Product/f_upload'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('.money').mask('0.000.000.000', {reverse: true});
                        $('#progresbar').hide();
                        $(".textarea").wysihtml5();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }

            /// endproduct

            /// sales
            function dataWishlist() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Sales/data_count_wishlist'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataWishlist').DataTable();
                        $('#dataTables-dataWishlist2').DataTable({responsive: true});
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }

            function dataOrder(status) {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Sales/data_order'); ?>',
                    method: "post",
                    data: {status: status},
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataOrder').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }

            function dataOrderAll() {
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Sales/data_order_all'); ?>',
                    method: "post",
                    data: {status: status},
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        load_table_order();
                        Pace.stop();
                    }
                });
            }

            function dataInvoiceUnpaid() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Invoice/data_invoice_unpaid'); ?>',
                    method: "post",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataInvoiceunpaid').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            
            function dataProductRetur() {
                Pace.start();
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Retur/data_retur'); ?>',
                    method: "post",
                    success: function (resp) {
                            $('#data').html(resp);
                            $('#loader').hide();
                            load_table_retur();
                        $('#loader').hide();
                        Pace.stop();
                    }
                });
            }
            /// end-sales

            /// user
            function dataUser() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/User/data_user_all'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataUser').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            /// end-user

            /// partner
            function dataPartner() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Partner/data_partner_all'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataPartner').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                        $('.money').mask('0.000.000.000', {reverse: true});
                    }
                });
            }
            function dataInvoicePartner() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Invoice/data_invoice_partner_all'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataInvoicePartner').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                        $('.money').mask('0.000.000.000', {reverse: true});
                    }
                });
            }
            /// ENDpartner
            ///marketing
            function dataProductSale() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Marketing/data_product_sale'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataproductsale').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            function dataVoucher() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Marketing/data_voucher'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('.money').mask('0.000.000.000', {reverse: true});
                        $('#dataTables-datavoucher').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            function dataProductBestSeller() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Marketing/data_product_bestseller'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('.money').mask('0.000.000.000', {reverse: true});
                        $('#dataTables-dataproductbestseller').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            ///marketing
            //design
            function fBannerHome() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/f_banner_home'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#progresbar').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                        position();
                        $(".sort").hide();
                    }
                });
            }
            function dataBanner() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/data_banner_all'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataBanner').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            function dataPopup() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/data_popup'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataPopup').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            function uploadPopup() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Design/f_upload_popup'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $(".textarea").wysihtml5();
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            //design
            //ads
            function dataAdsFbPixel() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Ads/data_ads_fb_pixel'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataadsfbpixel').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            //endads
            //customer
            function dataCustomer() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Customer/data_customer'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('#dataTables-dataCustomer').DataTable();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            //endcustomer
            //maintenance
            function listExportdata() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Maintenance/list_exportdata'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            //maintenance
            // kontak & pesan//
            function dataContact() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Contact/data_contact'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#dataTables-dataContact').DataTable();
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            function dataSubscribe() {
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('d/Contact/data_email_sub'); ?>',
                    method: "POST",
                    success: function (resp) {
                        $('#data').html(resp);
                        $('#dataTables-dataEmailsub').DataTable();
                        $('#loader').hide();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            // kontak & pesan//
        </script>
    </body>
</html>
