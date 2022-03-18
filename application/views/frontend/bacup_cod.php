<?php echo $header; ?>
<style>
    .error{
        color:red;
        font-size: 12px;
    }
</style>
<div id="loadingpage" class="">Loading&#8230;</div>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart?idorder=') ?><?php
    if (empty($ordershiping)) {
        
    } else {
        echo $ordershiping->idorder;
    }
    ?>" class="s-text16">
        Keranjang Belanja
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Data Pembeli
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </span>
</div>

<section class="cart bgwhite p-t-30 p-b-100">
    <div class="container">
        <div class="row">
            <!-- cart total -->
            <div class="bo7 col-md-5 p-l-20 p-r-20 p-b-38 p-t-30 bg5">
                <h5 class="p-b-24 bo20">
                    Rincian Belanja
                </h5>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <table>
                        <?php 
                        if(!empty($_SESSION['cart_contents'])){
                            foreach ($this->cart->contents() as $items) { ?>
                                <tr>
                                    <th class="p-r-10"><img style="height: 75px;" src="<?php echo base_url('asset/img/uploads/product/' . $items['options']['image']); ?>"></th>
                                    <th class="p-r-10"><small>(<?php echo $items['qty']; ?>)</small></th>
                                    <td class="p-r-10"><small> <?php echo $items['name']; ?></small></td>
                                    <td><small>Rp. <?php echo number_format($items['subtotal']); ?></small></td>
                                </tr>
                            <?php }
                        }else{
                           ?>
                           <?php if(!empty($detailorder[0]->idorder)){foreach ($detailorder as $items) { ?>
                            <tr>
                                <th class="p-r-10"><img style="height: 75px;" src="<?php echo base_url('asset/img/uploads/product/' . $items->fotoName); ?>"></th>
                                <th class="p-r-10"><small>(<?php echo $items->productQty; ?>)</small></th>
                                <td class="p-r-10"><small> <?php echo $items->productName; ?></small></td>
                                <td><small>Rp. <?php echo number_format($items->subtotalPrice); ?></small></td>
                            </tr>
                        <?php } } } ?>
                    </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <table>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Pesanan</small></th>
                            <td><small><?php if(!empty($detailorder)){ echo array_sum(array_column($detailorder, 'productQty'));} ?> pcs</small></td>
                        </tr>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Berat (KG)</small></th>
                            <td><small><?php if(!empty($ordershiping->idorder)){echo ceil(($ordershiping->totalWeight) / 1000);} ?> Kg</small></td>
                        </tr>
                    </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>
                    <span class="w-full-sm">
                        <?php 
                        if(!empty($_SESSION['cart_contents'])){
                            echo "Rp. " . number_format($this->cart->total()); 
                        }else{
                            echo "Rp. ".number_format($orderresult->cartTotal);
                        }

                        ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Ongkos Kirim :
                    </span>
                    <span class="w-full-sm" id="jumlahongkir">
                        <?php
                        if(!empty($ordershiping->idorder)){
                            if (empty($ordershiping->shipingCarge)) {
                                echo '<a href="#optionkurir"><small><i>Pilih Jasa Pengiriman</i></small></a>';
                            } else {
                                echo "Rp. " . number_format($ordershiping->shipingCarge) . "  (" . $ordershiping->shipingName . ")";
                            }
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Voucher : 
                    </span>
                    <span class="w-full-sm"  id="rincianvoucher">
                        <?php
                        if(!empty($orderresult->idorder)){
                            if (empty($orderresult->voucherPrice)) {
                                echo '<a href="#optionvoucher"><small><i>Input Voucher</i></small></a>';
                            } else {
                                echo "Rp. " . number_format($orderresult->voucherPrice);
                            }
                        }
                        ?> 
                        <?php 
                        if(!empty($orderresult->idorder)){
                            if ($orderresult->voucherPrice != 0) { ?>
                                <button class="text-danger" onclick="removeVoucher('<?php echo $orderresult->idvoucher; ?>');"><i class="fa fa-close"></i></button>
                            <?php } } ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Discount Partner : 
                    </span>
                    <span class="w-full-sm">
                        <?php
                        if (empty($_SESSION['iduser'])) {
                            echo '<small><i>silahkan login</i></small>';
                        } else {
                            if(!empty($orderresult->idorder)){
                                echo "Rp. " . number_format($orderresult->partnerDiscount);
                            }
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Total
                    </span>

                    <span class="w-full-sm" id="summaryorder">
                        <small><i>selesaikan proses</i></small>
                    </span>
                </div>
            </div>

            <div class="col-md-7">
                <div class="login_title form-customer m-t-30">
                    <h6 class="p-b-24 bo20 color0"><i class="fa fa-chevron-circle-right"></i> <u>Data Penerima Barang</u></h6>
                </div>
                <div class="bo7 p-b-10">
                    <button onclick="useExistAddress();" class="btn btn-sm btn-success">Gunakan Alamat Akun</button>
                    <button href="" class="btn btn-sm btn-success" onclick="resetForm();">Gunakan Alamat Baru</button>
                    <span id="loadingbutton"><i class="fa fa-spinner fa-pulse fa-2x fa-fw color0"></i></span>
                </div>
                <form class="login_form row form-customer" method="post" id="form-custommer">
                    <input type="hidden" name="biayapengiriman" id="biayapengiriman">
                    <input type="hidden" name="shipingdesc" id="shipingdesc">
                    <input type="hidden" name="jumlahvoucher" id="jumlahvoucher">
                    <input type="hidden" name="idvoucher" id="idvoucher">
                    <input type="hidden" name="idbank" id="idbank">
                    <input type="hidden" name="idorder" id="idorder" value="<?php if(!empty($orderresult->idorder)){echo encryption($orderresult->idorder);}?>">
                    <input type="hidden" name="discountpartner" id="discountpartner" value="<?php  if(!empty($orderresult->idorder)){ if($orderresult->partnerDiscount != NULL){echo $orderresult->partnerDiscount;}else {echo "0";}} ?>">
                    <div class="col-lg-6 form-group">
                        <label for="firstname"><small>Nama Depan</small></label>
                        <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Nama Depan" required="" value="<?php
                        if (!empty($ordershiping)) {
                            echo $ordershiping->firstName;
                        }
                        ?>">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="lastname"><small>Nama Belakang</small></label>
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Nama Belakang" required="" value="<?php
                        if (!empty($ordershiping)) {
                            echo $ordershiping->lastName;

                        }
                        ?>">
                    </div>
                    <div class="col-lg-5 form-group">
                        <label for="provinsi"><small>Provinsi</small></label>
                        <select name="provinsi" id="provinsi" class="form-control">
                            <?php
                            if (empty($ordershiping)) {
                                echo '<option value="" disabled="" selected="">Provinsi</option>';
                            } else {
                                echo'<option selected="" value="' . $ordershiping->codeProvinsi . '">' . $ordershiping->namaProvinsi . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-5 form-group">
                        <label for="kabupaten"><small>Kota / Kabupaten</small></label>
                        <select class="form-control" name="kabupaten" id="kabupaten" required="">
                            <?php
                            if (empty($ordershiping)) {
                                echo '<option value="" disabled="" selected="">Kabupaten</option>';
                            } else {
                                echo'<option selected="" value="' . $ordershiping->codeKabupaten . '">' . $ordershiping->namaKabupaten . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="postalcode"><small>Kode Pos</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="postalcode" id="postalcode" placeholder="Kode Pos" required="" value="<?php
                               if (!empty($ordershiping)) {
                                   echo $ordershiping->kodePos;
                               }
                               ?>" minlength="5" maxlength="8">
                    </div>

                    <div class="col-lg-4 form-group">
                        <label for="provinsi"><small>Kecamatan</small></label>
                        <select class="form-control" name="kecamatan" id="kecamatan" required="">
                            <?php
                            if (empty($ordershiping)) {
                                echo '<option value="" disabled="" selected="">kecamatan</option>';
                            } else {
                                echo'<option selected="" value="' . $ordershiping->codeKecamatan . '">' . $ordershiping->kecamatan . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="desa"><small>Desa</small></label>
                        <input class="form-control" type="text" name="desa" id="desa" placeholder="Desa" required="" value="<?php
                        if (!empty($ordershiping)) {
                            echo $ordershiping->desa;
                        }
                        ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="rt"><small>Rt</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rt" id="rt" placeholder="RT" required="" value="<?php
                               if (!empty($ordershiping)) {
                                   echo $ordershiping->rt;
                               }
                               ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="rw"><small>Rw</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rw" id="rw" placeholder="RW" required="" value="<?php
                               if (!empty($ordershiping)) {
                                   echo $ordershiping->rw;
                               }
                               ?>">
                    </div>

                    <div class="col-lg-12 form-group">
                        <label for="fulladdress"><small>Alamat Lengkap</small></label>
                        <textarea class="form-control" type="text" name="fulladdress" id="fulladdress" placeholder="Alamat Lengkap isikan dengan nama jalan, nama gedung atau yang lebih spesifik" required="" row="7">
                            <?php
                            if (!empty($ordershiping)) {
                                echo $ordershiping->fullAddress;
                            }
                            ?>
                        </textarea>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="customerphone"><small>Nomor Telepon / HP</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="customerphone" id="customerphone" placeholder="Nomor Telepon / HP" required="" value="<?php
                               if (!empty($ordershiping)) {
                                   echo $ordershiping->custHp;
                               }
                               ?>" maxlength="14">
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="customeremail"><small>Alamat Email</small></label>
                        <input class="form-control" type="email" name="customeremail" id="customeremail" placeholder="Alamat Email" required="" value="<?php
                        if (!empty($ordershiping)) {
                            echo $ordershiping->custEmail;
                        }
                        ?>">
                    </div>

                    <div class="col-md-12 form-check">
                        <label class="form-check-label s-text8">
                            <input type="checkbox" class="form-check-input" id="dropshippercheck" name="" onclick="dropshipper();"> <i class="fa fa-truck"></i> Kirim Sebagai Dropshipper
                        </label>
                    </div>

                        <div class="col-lg-6 form-group" id="dropshipper1">
                        <label for="customeremail"><small>Nama Dropshiper</small></label>
                            <input type="text" class="form-control" name="dropshippername" id="dropshippername" placeholder="Nama Pengirim">
                        </div>

                        <div class="col-lg-6 form-group" id="dropshipper2">
                        <label for="customeremail"><small>Nomor HP Dropshiper</small></label>
                            <input type="text" class="form-control" name="dropshipperphone" id="dropshipperphone" placeholder="Nomor Telepon">
                        </div>

                        <div class="col-lg-12 form-group" id="dropshipper3">
                        <label for="customeremail"><small>Alamat Lengkap Dropshiper</small></label>
                            <textarea class="form-control" type="text" name="dropshipperaddress" id="dropshipperaddress" placeholder="Alamat Lengkap isikan dengan nama jalan, nama gedung atau yang lebih spesifik" row="7"></textarea>
                        </div>
                </form>
            </div>

            <!-- jasa pengiriman -->
            <div class="ml-auto offset-md-5 col-md-7 p-t-20" id="optionkurir">
                <div class="login_title form-customer">
                    <h6 class="p-b-24 bo20 color0"><i class="fa fa-chevron-circle-right"></i> <u>Jasa Pengiriman Barang</u></h6>
                </div>
                <div class="login_form row form-customer">
                    <div class="col-md-8 form-group">
                        <select class="form-control" id="kurir" name="kurir" required="">
                            <option value=""> Pilih Kurir</option>
                            <?php foreach ($kurir as $key) {
                                if($key['status'] == 'Active'){
                                ?>
                            <option value="<?=$key['idcod']?>"><?=$key['lokasi']?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="col-md-12" id="datakurirAlert"></div>
                    <div class="col-md-12">
                        <table class="table bo9 bg5">
                            <tbody id="datakurir">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- pengiriman -->
            <div class="ml-auto offset-md-5 col-md-7 p-t-20">
                <div class="login_title form-customer">
                    <h6 class="p-b-24 bo20 color0"><i class="fa fa-chevron-circle-right"></i> <u>Metode Pembayaran</u></h6>
                </div>
                <table class="table bo9 bg5">
                    <tbody id="listbank">
                        <?php foreach ($bank as $value) { ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" onclick="set_bank();" class="form-check-input" name="bank" id="bank" value="<?php echo $value->idbank ?>" required>
                                            <img src="<?php echo base_url('asset/img/icons/icon_' . $value->bankName . '.svg'); ?>" style="width: 25%;">
                                            Transfer ke bank <?php echo $value->bankName; ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- voucher -->
            <div class="ml-auto offset-md-5 col-md-7 p-t-30" id="optionvoucher">
                <div class="login_title form-customer">
                    <h6 class="p-b-24 bo20 color0"><i class="fa fa-chevron-circle-right"></i> <u>Kode Voucher</u><br>
                        <a class="text-info" href="<?php echo base_url('pages/voucher');?>" target="_blank">Tidak memiliki voucher ? Cek sekarang!</a>
                    </h6>
                </div>
                <div class="flex-w flex-sb-m p-t-25 p-b-25 bo17 p-l-35 p-r-60 p-lr-15-sm m-t-10" id="formvoucher">
                    <div class="size11 bo4 m-r-10">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="vouchercode" id="vouchercode" placeholder="Kode Voucher (case sensitive)" required="">
                    </div>
                    <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                        <button onclick="applyVoucher();" class="flex-c-m sizefull bg-orange bo-rad-23 hov1 s-text1 trans-0-4">
                            Apply
                        </button>
                    </div>
                    <div id="voucher">
                    </div> 
                </div>
            </div>

            <div class="col-md-12 p-t-30">
                <a class="col-md-3" href="<?php echo base_url('pages/cart?idorder=') ?><?php
                if (!empty($orderresult)) {
                    echo $orderresult->idorder;
                }
                ?>">
                    <i class="fa fa-angle-double-left"></i> Kembali ke Keranjang Belanja
                </a>
                <a class="col-md-3 text-danger" href="javascript:void(0);" onclick="cancel_order('<?php echo encryption($orderresult->idorder);?>');">
                    <i class="fa fa-close"></i> Batalkan Pesanan ini
                </a>
                <button type="button" onclick="place_order();" class="col-md-6 btn subs_btn pull-right">Buat Pesanan <i class="fa fa-angle-double-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script src="<?php echo base_url('asset/') ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        count_summary();
        $('#dropshipper1').hide();
        $('#dropshipper2').hide();
        $('#dropshipper3').hide();
        $('#loadingpage').hide();
        $('#loadingbutton').hide();
        $("#kurir").on("change", function cost(e) {
            e.preventDefault();
        // $('#loadingpage').show();
        // $("#loadingpage").addClass("loadingfull");
            var id = $('option:selected', this).val();
            // var des = $('#kecamatan').val();
            // var weight = '10000';
    
            $.ajax({
                url: "<?php echo base_url('cart/getKurirCod'); ?>",
                dataType: "JSON",
                method: "POST",
                data: {id:id},
                success: function (data) {
                // $("#loadingpage").removeClass("loadingfull");
                // $('#loadingpage').hide();
                var idr = number_idr(parseInt(data.ongkir));
                var idr = 'Rp. ' + idr + '';
                  var x = '<div class="alert alert-success" role="alert">Ongkos Kirim : '+idr+'</div>';
                  $('#datakurirAlert').html(x);  
                  set_ongkir_edit(data.ongkir,data.name);
                }
            });

            // $('#datakurirAlert').html(x);


            // if (weight === '0' || weight === '')
            // {
            //     alert('null');
            // } else if (option === '')
            // {
            //     alert('null');
            // } else if (des == 0) {
            //     $('html, body').animate({
            //         scrollTop: $(".container").offset().top
            //     }, 2000);
            //     swal("", "Lengkapi alamat pengiriman terlebih dahulu", "error");
            // } else
            // {
                // getOrigin(des, weight, option);
            // }
        });
        function set_ongkir_edit(idr,shiping) {
            $('#loadingpage').show();
            $("#loadingpage").addClass("loadingfull");
            $('#biayapengiriman').val(idr);
            var idr = number_idr(parseInt(idr));
            var idr = 'Rp. ' + idr + '';
            $('#jumlahongkir').html(idr);
            var set_shipingdesc = $('#shipingdesc').val(shiping);
            count_summary();
        }
        function set_ongkir(idr) {
            $('#loadingpage').show();
            $("#loadingpage").addClass("loadingfull");
            $('#biayapengiriman').val(idr);
            var idr = number_idr(parseInt(idr));
            var idr = 'Rp. ' + idr + '';
            $('#jumlahongkir').html(idr);
            var shiping = $("input[type='radio'][name='shiping']:checked").val();
            var set_shipingdesc = $('#shipingdesc').val(shiping);
            count_summary();
        }

        function getOrigin(des, weight, cour) {
            $('.loading').remove();
            var str = "'";
            var $op = $("#datakurir");
            var i, j, x = "";
            var add = <?php echo $shipinggateway->upCost; ?>;
            $('#datakurir').after('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw color0"></i>loading service...</div');
            $.getJSON("<?php echo base_url('d/Shipinggateway/get_cost/') ?>" + des + "/" + weight + "/" + cour, function (data) {
                if (data.rajaongkir.status.code != "200") {
                    swal("", "" + data.rajaongkir.status.description + "", "error");
                } else if (data.rajaongkir.results[0].costs == '') {
                    swal("", "" + data.rajaongkir.results[0].name + ", Tidak mendukung pengiriman ini", "error");
                } else {
                    $.each(data.rajaongkir.results, function (i, field) {
                        for (i in field.costs) {
                            for (j in field.costs[i].cost) {
                                x += ('<tr><td><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="shiping" id="shiping" onclick="set_ongkir(' + str + (parseInt(field.costs[i].cost[j].value) + parseInt(add)) + str + ')" value="' + field.name  + ' - ' + field.costs[i].service + '" required> ' + '( ' + field.code + ' )' + " - " + field.costs[i].service + ' - ' + field.costs[i].description + ' (ESTIMASI ' + field.costs[i].cost[j].etd + ' hari) - Rp.' + number_idr((field.costs[i].cost[j].value + add)) + '</label></div></td></tr>');
                            }
                        }
                        $op.html(x);
                    });
                }
                $('.loading').remove();
            });
        }

        function getProvinsi() {
            var $op = $("#provinsi");
            $('.loading').remove();
            $('#provinsi').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_provinsi", function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
                });
                $('.loading').remove();
            });
        }
        getProvinsi();

        $("#provinsi").on("change", function (e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kabupaten option:gt(0)').remove();

            if (option === '')
            {
                alert('null');
                $("#kabupaten").prop("disabled", true);

            } else
            {
                $("#kabupaten").prop("disabled", false);
                getKota(option);
            }
        });

        $("#kabupaten").on("change", function (e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kecamatan option:gt(0)').remove();
            if (option === '')
            {
                alert('null');
                $("#kecamatan").prop("disabled", true);
            } else
            {
                $("#kecamatan").prop("disabled", false);
                getKecamatan(option);
            }
        });

        function getKota(idpro) {
            var $op = $("#kabupaten");
            $('.loading').remove();
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_kota/" + idpro, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
                });
                $('.loading').remove();
            });
        }

        function getKecamatan(idkot) {
            var $op = $("#kecamatan");
            $('.loading').remove();
            $('#kecamatan').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $.getJSON("<?php echo base_url('d/Shipinggateway/get_kecamatan/') ?>" + idkot, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.subdistrict_id + '">' + field.subdistrict_name + '</option>');
                });
                $('.loading').remove();
            });
        }
    });

    function place_order() {
        var valid = $("#form-custommer").valid();
        var idbank = $('#idbank').val();
        var biayapengiriman = $('#biayapengiriman').val();
        if (valid == true) {
            if (biayapengiriman == '') {
                $('html, body').animate({
                    scrollTop: $("#optionkurir").offset().top
                }, 2000);
                swal("", "Pilih Jasa Pengiriman Barang", "error");
            } else if (idbank == '') {
                $('html, body').animate({
                    scrollTop: $("#listbank").offset().top
                }, 2000);
                swal("", "Pilih Metode Pembayaran", "error");
            } else {
                $('#loadingpage').show();
                $("#loadingpage").addClass("loadingfull");
                var form = $('#form-custommer').get(0);
                var form_data = new FormData(form);
                $('#loader').show();
                $.ajax({
                    url: '<?php echo base_url('Order/place_order') ?>',
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    accepts: {
                        json: 'application/json'
                    },
                    success: function (resp) {
                        if (resp.status == 0) {
                            $("#loadingpage").removeClass("loadingfull");
                            swal("" + resp.message);
                            setTimeout(function () {
                                $('#loadingpage').hide();
                                window.location.href = resp.redirect;
                            }, 3000);
                        } else if (resp.status == 1) {
                            setTimeout(function () {
                                $("#loadingpage").removeClass("loadingfull");
                                $('#loadingpage').hide();
                                window.location.href = resp.redirect;
                            }, 4000);
                        }
                        $('.progress').hide();
                        $('#loader').hide();
                    },
                    error: function (resp) {
                         $("#loadingpage").removeClass("loadingfull");
                                $('#loadingpage').hide();
                        swal("error upload, error_code: " + resp.status);
                    }
                });
            }
        } else {
             $("#loadingpage").removeClass("loadingfull");
                                $('#loadingpage').hide();
            $('html, body').animate({
                scrollTop: $(".container").offset().top
            }, 2000);
        }
    }

    function set_bank() {
        var idbank = $("input[type='radio'][name='bank']:checked").val();
        $('#idbank').val(idbank);
    }
 

    function number_idr(v) {
        var value = v.toLocaleString(undefined,
                {minimumFractionDigits: 0}
        );
        return value;
    }

    function dropshipper() {
        var checkBox = document.getElementById("dropshippercheck");
        var text1 = document.getElementById("dropshipper1");
        var text2 = document.getElementById("dropshipper2");
        var text3 = document.getElementById("dropshipper3");
        if (checkBox.checked == true) {
            text1.style.display = "block";
            text2.style.display = "block";
            text3.style.display = "block";
            document.getElementById("dropshippername").required = true;
            document.getElementById("dropshipperphone").required = true;
            document.getElementById("dropshipperaddress").required = true;
        } else {
            text1.style.display = "none";
            text2.style.display = "none";
            text3.style.display = "none";
            document.getElementById("dropshippername").required = false;
            document.getElementById("dropshipperphone").required = false;
            document.getElementById("dropshipperaddress").required = false;
        }
    }

    function count_summary() {
        var cart_total = '<?php if(empty($this->cart->total())){echo $orderresult->cartTotal;}else{ echo $this->cart->total();} ?>';
        var biayapengiriman = $('#biayapengiriman').val();
        var voucherprice = $('#jumlahvoucher').val();
        var discountpartner = $('#discountpartner').val();
        if (biayapengiriman !== '') {
            biayapengiriman = parseInt(biayapengiriman);
        }
        if (voucherprice !== "") {
            voucherprice = parseInt(voucherprice);
        }
        if (discountpartner !== "") {
            discountpartner = parseInt(discountpartner);
        }

        var summary;
        summary = (parseInt(cart_total) - discountpartner) - voucherprice;
        summary = summary + biayapengiriman;
        summary = number_idr(parseInt(summary));
        summary = "Rp." + summary;
        $('#summaryorder').html(summary);
        setTimeout(function () {
            $("#loadingpage").removeClass("loadingfull");
            $('#loadingpage').hide();
        }, 2000);
    }

    function applyVoucher() {
        $('.loading').remove();
        var voucher = $('#vouchercode').val();
        var totalprice = '<?php if(empty($this->cart->total())){echo $orderresult->cartTotal;}else{ echo $this->cart->total();} ?>';
        if (voucher === "") {
            document.getElementById("vouchercode").focus();
        } else {
            $('#voucher').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.ajax({
                url: "<?php echo site_url('d/Marketing/search_code_voucher'); ?>",
                method: "POST",
                data: {voucher: voucher, totalprice: totalprice},
                success: function (data) {
                    $('#voucher').html(data);
                    $('.loading').remove();
                }
            });
        }
    }

    function useVoucher(value, id, name, code, desc) {
        $('#loadingpage').show();
        var coupon = '<div class="coupons">\
            <div class="coupon ">\
            <div class="coupon-intro">\
            <h4>Voucher ' + name + '</h4>\
            <ul>\
            <li>' + desc + '</li>\
            <li>Kode : ' + code + '</li>\
            </ul>\
            </div>\
            <div class="coupon-value">\
            RP. ' + number_idr(parseInt(value)) + '\
            </div>\
            </div>\
            </div>\
            <button class="btn btn-sm btn-danger" onclick="removeVoucher()" title="Hapus"><i class="fa fa-trash"></i> Hapus</button>';

        $("#loadingpage").addClass("loadingfull");

        $('#jumlahvoucher').val(value);
        $('#idvoucher').val(id);
        var value = number_idr(parseInt(value));
        value = "Rp. " + value;
        $('#rincianvoucher').html(value);
        $('#formvoucher').html(coupon);
        count_summary();
    }

    function removeVoucher() {
        $('#loadingpage').show();
        $("#loadingpage").addClass("loadingfull");
        var formvoucher = '<div class="size11 bo4 m-r-10">\
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="vouchercode" id="vouchercode" placeholder="Kode Voucher (case sensitive)" required="">\
            </div>\
            <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">\
            <button onclick="applyVoucher();" class="flex-c-m sizefull bg-brown bo-rad-23 hov1 s-text1 trans-0-4">Apply</button>\
            </div>\
            <div id="voucher">\
            </div>';
        $('#jumlahvoucher').val('0');
        $('#idvoucher').val('');
        value = "Rp. 0";
        $('#rincianvoucher').html(value);

        $('#formvoucher').html(formvoucher);
        count_summary();
    }

    function resetForm() {
        $('#firstname').val('');
        $('#lastname').val('');
        $('#fulladdress').val('');
        $('#desa').val('');
        $('#rt').val('');
        $('#rw').val('');
        $('#provinsi').val('');
        $('#kecamatan').val('');
        $('#kabupaten').val('');
        $('#postalcode').val('');
        $('#customeremail').val('');
        $('#customerphone').val('');
    }

    function useExistAddress()
    {
        var id = '<?php
        if (!empty($_SESSION['iduser'])) {
            echo encryption($_SESSION['iduser']);
        }
        ?>';
        if (id == '') {
            alert('Silahkan Login Terlebih Dahulu');
        } else {
            resetForm();
            var fname = document.getElementById("firstname");
            var lname = document.getElementById("lastname");
            var alamat = document.getElementById("fulladdress");
            var desa = document.getElementById("desa");
            var rt = document.getElementById("rt");
            var rw = document.getElementById("rw");
            var kecamatan = document.getElementById("kecamatan");
            var provinsi = document.getElementById("provinsi");
            var kabupaten = document.getElementById("kabupaten");
            var kodepos = document.getElementById("postalcode");
            var email = document.getElementById("customeremail");
            var hp = document.getElementById("customerphone");
            $('#loadingbutton').show();
            $.ajax({
                url: "<?php echo base_url('User/get_data_user'); ?>",
                method: "POST",
                dataType: "JSON",
                data: {id: id},
                success: function (data) {
                    if(data.desa == null){
                        swal({
                                title: "",
                                text: "Silahkan lengkapi profil Anda terlebih dahulu",
                                type: "info",
                                showCancelButton: false,
                                confirmButtonColor: "#008000",
                                confirmButtonText: "Lengkapi",
                                showLoaderOnConfirm: true,
                                closeOnConfirm: false,
                                closeOnCancel: true,
                                showCancelButton: true
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location.href="<?php echo base_url('pages/update_account/'.encryption($_SESSION['iduser']).'');?>";
                                    }
                            });
                    }
                    fname.value = data.username + fname.value;
                    if(data.lastName == null){
                        lname.value = '';
                    }else{
                        lname.value = data.lastName + lname.value;
                    }
                    if(data.alamat == null){
                        alamat.value = '';
                    }else{
                        alamat.value = data.alamat + alamat.value;
                    }
                    if(data.desa == null){
                        desa.value = '';
                    }else{
                        desa.value = data.desa + desa.value;
                    }
                    if(data.rt == null){
                        rt.value = '';
                    }else{
                        rt.value = data.rt + rt.value;
                    }
                    if(data.rw == null){
                        rw.value = '';
                    }else{
                        rw.value = data.rw + rw.value;
                    }
                    if(data.kodepos == null){
                        kodepos.value = '';
                    }else{
                        kodepos.value = data.kodepos + kodepos.value;
                    }
                    if(data.kecamatan == null){
                        $('#kecamatan').append('<option value="" selected="selected">Pilih Kecamatan</option>');
                    }else{
                        $('#kecamatan').append('<option value="' + data.codeKecamatan + '" selected="selected">' + data.kecamatan + '</option>');
                    }

                    provinsi.value = data.codeProvinsi;
                    $('#provinsi').append('<option value="' + data.codeProvinsi + '" selected="selected">' + data.provinsi + '</option>');
                    $('#kabupaten').append('<option value="' + data.codeKabupaten + '" selected="selected">' + data.kabupaten + '</option>');
                    email.value = data.useremail + email.value;
                    hp.value = data.userHp + hp.value;
                    $('#loadingbutton').hide();
                }
            });
        }
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
                                                    location.href="<?php echo base_url('pages/profile');?>";
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