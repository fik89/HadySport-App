<?php echo $header; ?>
<style>
    .error{
        color:red;
    }
</style>
<link href='<?php echo base_url('') ?>asset/vendors/bootstrap-star-rating/css/star-rating.css' type='text/css' rel='stylesheet'>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Detail Order
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Detail Order
    </span>
</div>
<section class="bgwhite p-t-10 p-b-45">
    <div class="container">
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Note: </strong> Anda dapat retur / mengembalikan barang belanja Anda sesuai dengan <a href="<?php echo base_url('pages/terms');?>">Syarat & ketentuan yang berlaku</a>
        </div>
        <div class="row">
            <div class="bo7 col-md-6 p-l-40 p-t-30 p-b-38 m-t-30 bg5">
                <h4 class="p-b-10 p-t-10 bo20">
                    Detail Belanja <?php echo date_ind($detailorder[0]->orderDate);?>
                </h4>
                <h6 class="p-b-10 p-t-10 bo20">
                    Status Order : <?php echo $detailorder[0]->status;?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    ID Order : <?php echo $detailorder[0]->idorder;?>
                </h6>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Dikirim Ke:
                    </span>

                    <span class="w-full-sm">
                        <?php echo $detailorder[0]->firstName." ".$detailorder[0]->lastName;?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Alamat Kirim:
                    </span>

                    <span class="w-full-sm">
                        <?php echo $detailorder[0]->desa.", RT.".$detailorder[0]->rt."- RW.".$detailorder[0]->rw.",".$detailorder[0]->kecamatan.", ".$detailorder[0]->namaKabupaten.", ".$detailorder[0]->namaProvinsi ;?>
                    </span>
                </div>
            </div>

            <div class="col-md-6 p-l-40 p-t-30 p-b-38 m-t-30 bg5">
                <h4 class="p-b-10 p-t-10 bo20">
                    Rincian
                </h4>
                <h6 class="p-b-10 p-t-10 bo20">
                    Total Belanja : <?php echo "Rp. ".number_format($detailorder[0]->cartTotal);?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    Dicount Partner : - <?php echo "Rp. ".number_format($detailorder[0]->partnerDiscount);?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    Voucher : - <?php echo "Rp. ".number_format($detailorder[0]->discountPrice);?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    Biaya Pengiriman : <?php echo "Rp. ".number_format($detailorder[0]->totalShiping);?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    Pajak : <?php echo "Rp. ".number_format($detailorder[0]->tax);?>
                </h6>
                <h6 class="p-b-10 p-t-10 bo20">
                    Jumlah : <?php echo "Rp. ".number_format($detailorder[0]->orderSumary);?>
                </h6>
            </div>
            </div>
        <div class="p-t-30" id="datadetail"></div>
    </div>
</section>
<?php echo $footer; ?>
<script src="<?php echo base_url('') ?>asset/js/jquery.validate.min.js"></script>
<script src='<?php echo base_url('') ?>asset/vendors/bootstrap-star-rating/js/star-rating.min.js' type='text/javascript'></script>
<script type='text/javascript'>
    $(document).ready(function () {
        list_product();
        $('.ratingbar').rating({
            showCaption: false,
            showClear: false,
            size: 'xs'
        });
    });

    function list_product() {
        $.ajax({
            url: '<?php echo base_url('Order/data_detail_order'); ?>/<?php echo $this->uri->segment(3); ?>',
                        method: "POST",
                        success: function (resp) {
                            $('#datadetail').html(resp);
                            $('#loader').hide();
                        }
                    });
                }
</script>
</body>
</html>