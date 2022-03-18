<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart?idorder=' . $detailorder->idorder . '') ?>" class="s-text16">
        Keranjang Belanja
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart/form-customer?idorder=' . $detailorder->idorder . '') ?>" class="s-text16">
        Data Pembeli
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Metode Pengiriman
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </span>
    <a href="JavaScript:void(0);" class="s-text16">
        Metode Pembayaran
    </a>
</div>
<section class="cart bgwhite p-t-30 p-b-100">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="login_title form-customer">
                    <h6>Data Penerima Barang</h6>
                </div>
                <table class="table bo9 bg5">
                    <tbody>
                        <tr>
                            <td><small>Nama Penerima</small></td>
                            <td><small> <?php echo $detailorder->firstName . " " . $detailorder->lastName; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Alamat</small></td>
                            <td><small><?php echo $detailorder->desa . ", " . $detailorder->rt . "-" . $detailorder->rw . ", " . $detailorder->kecamatan . ", " . $detailorder->namaKabupaten . ", " . $detailorder->namaProvinsi . ", " . $detailorder->kodePos; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Kontak</small></td>
                            <td><small>E-mail: <?php echo $detailorder->custEmail . ", Telepon :" . $detailorder->custHp; ?></small></td>
                        </tr>
                    </tbody>
                </table>
                <div class="login_title form-customer">
                    <h6>Pilih Jasa Kurir</h6>
                </div>
                <form class="login_form row form-customer" action="<?php echo base_url('Order/store_shiping?idorder=' . $detailorder->idorder . '') ?>" method="post" id="shipinggateway">
                    <input type="hidden" name="subtotal" value="<?php echo $this->cart->total(); ?>">
                    <div class="col-md-2 form-group">
                        <select class="form-control" id="kurir" name="kurir" required="">
                            <option value=""> Pilih Kurir</option>
                            <option value="tiki">Tiki</option>
                            <option value="sicepat">Sicepat</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="wahana">Wahana</option>
                            <option value="jnt">JNT</option>
                            <option value="rpx">RPX</option>
                            <option value="sap">SAP</option>
                            <option value="pcp">PCP</option>
                            <option value="jet">JET</option>
                            <option value="dse">DSE</option>
                            <option value="first">First</option>
                            <option value="ninja">Ninja</option>
                            <option value="idl">Idl</option>
                            <option value="rex">REX</option>
                            <option value="lion">Lion</option>
                        </select>
                    </div>
                    <div class="col-lg-10 form-group">
                        <select class="form-control" id="cost" name="cost" required="">
                            <option selected="" value=""> Pilih Layanan </option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="dropshippercheck" name="" onclick="dropshipper();">Kirim Sebagai Dropshipper</label>
                    </div>

                    <div id="dropshipper" class="col-md-12 form-group">
                        <div class="form-group">
                            <input type="text" class="form-control" name="dropshippername" placeholder="Nama Pengirim">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="dropshipperphone" placeholder="Nomor Telepon">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="dropshipperaddress" placeholder="Alamat Lengkap">
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <a href="<?php echo base_url('pages/cart/form-customer?idorder=' . $detailorder->idorder . ''); ?>"><i class="fa fa-angle-double-left p-r-10"></i> Kembali ke Data Pembeli</a>
                    </div>
                    <div class="col-lg-6 form-group">
                        <button type="submit" value="submit" class="btn subs_btn form-control">Lanjut ke Pembayaran <i class="fa fa-angle-double-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="bo9 col-md-5 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 bg5">
                <h5 class="p-b-24 bo20">
                    Keranjang Belanja
                </h5>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                        <table>
                    <?php foreach ($this->cart->contents() as $items) { ?>
                            <tr>
                                <th class="p-r-10"><small>(<?php echo $items['qty']; ?>)</small></th>
                                <td class="p-r-10"><small> <?php echo $items['name']; ?></small></td>
                                <td><small>Rp. <?php echo number_format($items['subtotal']); ?></small></td>
                            </tr>
                    <?php } ?>
                        </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <table>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Pesanan</small></th>
                            <td><small><?php echo array_sum(array_column($this->cart->contents(), 'qty')); ?> pcs</small></td>
                        </tr>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Berat (KG)</small></th>
                            <td><small><?php echo ceil(($detailorder->totalWeight) / 1000); ?> Kg</small></td>
                        </tr>
                    </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>

                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($this->cart->total()); ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Ongkos Kirim :
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php
                        echo number_format($ordershiping->shipingCarge) . "  (" . $ordershiping->shipingName . ")";
                        if (empty($ordershiping->shipingCarge)) {
                            echo '<small><i>selesaikan proses</i></small>';
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Voucher : 
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php
                        echo number_format($orderresult->voucherPrice);
                        if (empty($orderresult->voucherPrice)) {
                            echo '<small><i>selesaikan proses</i></small>';
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Discount Partner : 
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php
                        echo number_format($orderresult->partnerDiscount);
                        if (empty($orderresult->partnerDiscount)) {
                            echo '<small><i>silahkan login</i></small>';
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Total
                    </span>
                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($orderresult->orderSumary); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dropshipper').hide();
        $.ajax({
            url: '<?php echo site_url('Cart/show_cart'); ?>',
            type: 'GET',
            success: function (resp) {
                $('#data-cart').html(resp);
            }
        });

        $("#kurir").on("change", function cost(e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            var des = <?php echo $detailorder->codeKecamatan; ?>;
            var weight = <?php echo $detailorder->totalWeight; ?>;

            if (weight === '0' || weight === '')
            {
                alert('null');
            } else if (option === '')
            {
                alert('null');
            } else
            {
                getOrigin(des, weight, option);
            }
        });
        function getOrigin(des, weight, cour) {
            $('.loading').remove();
            var $op = $("#cost");
            var i, j, x = "";
            var add = <?php echo $shipinggateway->upCost; ?>;
            $('#cost').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('d/Shipinggateway/get_cost/') ?>" + des + "/" + weight + "/" + cour, function (data) {
                if (data.rajaongkir.status.code != "200") {
                    swal("",""+data.rajaongkir.status.description+"","error");
                }else{
                $.each(data.rajaongkir.results, function (i, field) {
                    x += '<option selected="" value=""> Pilih Layanan </option>';
                    for (i in field.costs) {
                        for (j in field.costs[i].cost) {
                            x += ('<option value="' + (field.costs[i].cost[j].value + add) + '-' + field.costs[i].service + '">' + field.costs[i].service + ' (' + field.costs[i].cost[j].etd + ' hari) Rp.' + (field.costs[i].cost[j].value + add) + '</option>');
                        }
                    }
                    $op.html(x);
                });

                }
                $('.loading').remove();
            });
        }
    });
    function dropshipper() {
        var checkBox = document.getElementById("dropshippercheck");
        var text = document.getElementById("dropshipper");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
</body>
</html>