<div class="row" id="top">
    <div class="col-lg-12">
        <h4 class="page-header">Input Penjualan / Transaksi</h4>
    </div>
</div>
<!-- : -->
<form id="transaksi">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body"> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body"> 
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Pembeli Dari Data User</label>
                            <select class="form-control" name="datapembeli" id="datapembeli" onchange="setdata_pembeli();" required>
                                <option value="" selected="" disabled="">-- pilih pembeli --</option>
                                <option value="umum">Umum</option>
                                <?php foreach ($data_user as $value) { ?>
                                    <option value="<?php echo $value->iduser; ?>"><?php echo $value->username . ' ' . $value->lastName . ' - ' . $value->kecamatan . ', ' . $value->kabupaten . ', ' . $value->provinsi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="buttonnew">Pembeli Baru ?</label>
                            <button class="form-control btn btn-sm btn-success" onclick="pembeli_baru();">Input Pembeli Baru</button>
                        </div>
                    </div>
                    <div id="pembeli_baru">
                        <hr>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="namadepan">Nama Depan</label>
                                <input class="form-control" id="namadepan" name="namadepan" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="namabelakang">Nama Belakang</label>
                                <input class="form-control" id="namabelakang" name="namabelakang" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telepon">Nomor Telepon</label>
                                <input class="form-control" id="telepon" name="telepon" type="number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" required="" required>
                                    <option selected="" disabled="">Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select class="form-control" name="kabupaten" id="kabupaten" required="" required>
                                    <option disabled="" selected="">Pilih Kabupaten / Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan" required="">
                                    <option value="" disabled="" selected="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <input class="form-control" id="desa" name="desa" type="text" required="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input class="form-control" id="rt" name="rt" type="text" required="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <input class="form-control" id="rw" name="rw" type="text" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kodepos">Kode POS</label>
                                <input class="form-control" id="kodepos" name="kodepos" type="text" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reset">Reset</label>
                                <button class="btn btn-danger form-control" onclick="reset_form_pembeli();"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Barang
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <select class="form-control select2" id="product" name="product">
                                <option value="" selected="" disabled="">Pilih Barang</option>
                                <?php foreach ($data_product as $value) { ?>
                                    <option value="<?php echo $value->idproduct; ?>"> <?php echo $value->productName; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" readonly="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" readonly="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jumlah">Qty</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="add"><i class="fa fa-plus"></i></label>
                            <button type="button" class="btn btn-info" onclick="tambah_barang();">Tambah Barang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class=" table-responsive">
                <table id="tabelbarang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>@ Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="databarang">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Pengiriman
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Menggunakan Jasa Pengiriman ? </label>
                        <label class="radio-inline">
                            <input type="radio" name="usekurir" id="usekuriryes" value="ya" onclick="form_kurir();" required="">Kurir
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="usekurir" id="usekurircod" value="ya" onclick="form_kurir();" required="">Cod
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="usekurir" id="usekurir" value="tidak" onclick="form_kurir();">Tidak
                        </label>
                    </div>
                    
                    <div id="form_kurir_cod">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jasa Pengiriman</label>
                                <select class="form-control" id="kurir_cod" name="kurir_cod" required="">
                                    <option value=""> Pilih Kurir</option>
                                    <?php foreach ($kurir as $key) {
                                        if($key['status'] == 'Active'){?>
                                            <option value="<?=$key['idcod']?>"><?=$key['lokasi']?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <table class="table bo9 bg5">
                                    <tbody id="datakurir">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="form_kurir">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jasa Pengiriman</label>
                                    <select class="form-control" id="kurir" name="kurir" required="">
                                        <option value=""> Pilih Kurir</option>
                                        <option value="tiki">Tiki - Citra Van Titipan Kilat</option>
                                        <option value="sicepat">Sicepat</option>
                                        <option value="jne">JNE - Jalur Nugraha Ekakurir</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="wahana">Wahana Prestasi Logistik</option>
                                        <option value="jnt">JNT</option>
                                        <option value="rpx">RPX Holding</option>
                                        <option value="sap">SAP - Satria Antaran Prima</option>
                                        <option value="pcp">PCP - Priority Cargo & Package</option>
                                        <option value="jet">JET Express</option>
                                        <option value="dse">DSE - 21 Express</option>
                                        <option value="first">First - Synergy First Logistics</option>
                                        <option value="ninja">Ninja Express</option>
                                        <option value="idl">Idl - Indotama Domestik Lestari</option>
                                        <option value="rex">REX - Royal Express Indonesia</option>
                                        <option value="lion">Lion Parcel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <table class="table bo9 bg5">
                                    <tbody id="datakurir">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="totalweight" class="col-md-4 control-label">Berat (Gram)</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="totalweight" name="totalweight" value="0" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subtotalcart" class="col-md-4 control-label">Ongkir</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="ongkir" value="" readonly="" value="0">
                                    <input type="hidden" class="form-control" id="ongkirvalue" name="ongkirvalue" value="0">
                                    <input type="hidden" class="form-control" id="shipingdesc" name="shipingdesc" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subtotalcart" class="col-md-4 control-label">Subtotal</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="subtotalcart" value="0" readonly="">
                                    <input type="hidden" class="form-control" id="subtotalvalue" name="subtotalvalue" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="discount" class="col-md-4 control-label">Discount</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="discount" value="0" onkeyup="set_ppn();">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ppn" class="col-md-4 control-label">Ppn <?php echo $profile->taxProduct;?> %</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="ppn" readonly="">
                                    <input type="hidden" class="form-control" id="ppnvalue" name="ppnvalue">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="grandtotal" class="col-md-4 control-label">Grand Total</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="grandtotal" value="" readonly="">
                                    <input type="hidden" class="form-control" id="grandtotalvalue" name="grandtotalvalue" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-offset-6 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="button" id="button_submit" class="btn btn-success pull-right" onclick="submit_transaksi();">Simpan & Cetak Struk</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <!-- ; -->
    <script type="text/javascript">
        function prov() {
            $('#pembeli_baru').hide();
            $('#form_kurir').hide();
            $('#form_kurir_cod').hide();
            load_cart();
            form_kurir();
            set_ppn();
            getProvinsi();
            $(document).on('click', '.remove-cart', function () {
                var rowid = $(this).attr("id");
                swal({
                    title: "Hapus Produk ini ?",
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
                            url: "<?php echo site_url('Cart/delete_product'); ?>",
                            method: "POST",
                            data: {rowid: rowid},
                            success: function (data) {
                                $('#data-cart').html(data);
                                load_cart();
                                subtotal();
                                set_ppn();
                            }
                        });
                        swal("Terhapus!", "", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
            });

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

            $("#product").on("change", function (e) {
                e.preventDefault();
                var option = $('option:selected', this).val();
                getDetailproduct(option);
            });

            $("#kurir").on("change", function cost(e) {
                e.preventDefault();
                var option = $('option:selected', this).val();
                var des = $('#kecamatan').val();
                var weight = $('#totalweight').val();;

                if (weight === '0' || weight === '')
                {
                    alert('null');
                } else if (option === '')
                {
                    alert('null');
                } else if (des == null) {
                    $('html, body').animate({
                        scrollTop: $("#top").offset().top
                    }, 2000);
                    swal("", "Lengkapi alamat pengiriman terlebih dahulu", "error");
                } else
                {
                    getOrigin(des, weight, option);
                }
            });
            $("#kurir_cod").on("change", function cost(e) {
                e.preventDefault();
                var id = $('option:selected', this).val();
                var $op = $("#datakurir");
                $.ajax({
                    url: "<?php echo base_url('d/Transaksi/getKurirCod'); ?>",
                    dataType: "JSON",
                    method: "POST",
                    data: {id:id},
                    success: function (data) { 
                    // $("#loadingpage").removeClass("loadingfull");
                    // $('#loadingpage').hide();
                    // var idr = number_idr(parseInt(data.ongkir));
                    // var idr = 'Rp. ' + idr + '';
                    // var x = '<div class="alert alert-success" role="alert">Ongkos Kirim : '+idr+'</div>';
                    // $('#datakurirAlert').html(x);  
                    // set_ongkir_edit(data.ongkir,data.name);
                    let ht = "";
                    for (var i = 0; i < data.length; i++) {
                        ht += '<tr><td><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="shiping" id="shiping" onclick="set_ongkir_cod('+data[i]['ongkir']+')" value="' + data[i]['name'] + '-' + data[i]['lokasi'] + '" required>';
                        ht += ' ' + data[i]['name'] +' - ' + 'Wilayah' + ' '+ data[i]['lokasi'] +number_idr(data[i]['ongkir']);

                        ht += '</label></div></td></tr>';   
                    }

                    $op.html(ht);
                }
            });
            });
        }

        function form_kurir(){
            if(document.getElementById("usekuriryes").checked){
                $('#form_kurir').show();
                $('#form_kurir_cod').hide();
            }else if(document.getElementById("usekurircod").checked){
                $('#form_kurir_cod').show();
                $('#form_kurir').hide();
            }else{

                $('#datakurir').html('');
                $('#ongkirvalue').val('0');
                $('#ongkir').val('0');
                subtotal();
                $('#form_kurir').hide();
                $('#form_kurir_cod').hide();
            }
        }

        function setdata_pembeli(){
            var iduser = $('#datapembeli').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('d/User/get_detail_user'); ?>/' + iduser,
                dataType: "json",
                accepts: {
                    json: 'application/json'
                },
                success: function (response) {
                    if(response.status == 1){
                        $('#pembeli_baru').show();
                        $('#namadepan').val(response.data.username);
                        $('#namabelakang').val(response.data.lastname);
                        $('#telepon').val(response.data.userHp);
                        $('#desa').val(response.data.desa);
                        $('#rt').val(response.data.rt);
                        $('#rw').val(response.data.rw);
                        $('#kodepos').val(response.data.kodepos);
                        $('#email').val(response.data.useremail);

                        $('#provinsi').append('<option value="' + response.data.codeProvinsi + '" selected="selected">' + response.data.provinsi+ '</option>');
                        $('#kabupaten').append('<option value="' + response.data.codeKabupaten + '" selected="selected">' + response.data.kabupaten+ '</option>');
                        $('#kecamatan').append('<option value="' + response.data.codeKecamatan + '" selected="selected">' + response.data.kecamatan+ '</option>');
                    }
                },
                error: function (response) {
                    swal("error, error_code: " + response.status, "error");
                    Pace.stop();
                }
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

        function pembeli_baru() {
            $('#pembeli_baru').show();
            $('#namadepan').val('');
            $('#namabelakang').val('');
            $('#telepon').val('');
            $('#desa').val('');
            $('#provinsi').prop('selectedIndex', 0);
            $('#kabupaten').prop('selectedIndex', 0);
            $('#kecamatan').prop('selectedIndex', 0);
            ;
            $('#rt').val('');
            $('#rw').val('');
            $('#kodepos').val('');
            $('#email').val('');
        }

        function reset_form_pembeli() {
            $('#namadepan').val('');
            $('#namabelakang').val('');
            $('#telepon').val('');
            $('#desa').val('');
            $('#provinsi').prop('selectedIndex', 0);
            $('#kabupaten').prop('selectedIndex', 0);
            $('#kecamatan').prop('selectedIndex', 0);
            ;
            $('#rt').val('');
            $('#rw').val('');
            $('#kodepos').val('');
            $('#email').val('');
            $('#pembeli_baru').hide();
        }

        function getKota(idpro) {
            var $op = $("#kabupaten");
            $('.loading').remove();
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url(); ?>d/Shipinggateway/get_kota/" + idpro, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
                });
                $('.loading').remove();
            });
        }

        function getDetailproduct(id) {
            var harga;
            $('#stok').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('d/Product/get_detail_product'); ?>/' + id,
                dataType: "json",
                accepts: {
                    json: 'application/json'
                },
                success: function (response) {
                    $("#stok").val('');
                    $("#harga").val('');
                    if (response.status === '0') {
                        swal("error get data status", "" + response.status + "", "error");
                    } else {
                        $("#stok").val(response.data.qty);
                        harga = number_idr(response.data.harga);
                        $("#harga").val(harga);
                        $('.loading').remove();
                    }
                },
                error: function (response) {
                    swal("error, error_code: " + response.status, "error");
                    Pace.stop();
                }
            });
        }

        function getKecamatan(idkot) {
            var $op = $("#kecamatan");
            $('.loading').remove();
            $('#kecamatan').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $.getJSON("<?php echo base_url(); ?>d/Shipinggateway/get_kecamatan/" + idkot, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.subdistrict_id + '">' + field.subdistrict_name + '</option>');
                });
                $('.loading').remove();
            });
        }

        function number_idr(v) {
            var value = v.toLocaleString(undefined,
                {minimumFractionDigits: 0}
                );
            return value;
        }

        function tambah_barang() {
            $('.loading').show();
            var idproduct = $('#product').val();
            var jumlah = $('#jumlah').val();
            if (jumlah == '') {
                swal("", "Jumlah pembelian barang harus diisi", "error");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('d/Transaksi/tambah_barang'); ?>',
                    dataType: "json",
                    accepts: {
                        json: 'application/json'
                    },
                    data: {idproduct: idproduct, jumlah: jumlah},
                    success: function (response) {
                        if (response.status == '0') {
                            swal("", "" + response.message + "", "error");
                        } else {
                            $('#databarang').html(response.data);
                            $('#totalweight').val(response.totalweight);
                            $('#jumlah').val('');
                            $("#harga").val('');
                            $("#stok").val('');
                            subtotal();
                            total_weight();
                            set_ppn();
                        }
                    },
                    error: function (response) {
                        swal("error, error_code: " + response.status, "error");
                        Pace.stop();
                    }
                });
            }

        }

        function load_cart() {
            var action = "load";
            $('.loading').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('d/Transaksi/data_cart'); ?>/' + action,
                success: function (response) {
                    $('#databarang').html(response);
                    subtotal();
                    total_weight();
                    set_ppn();
                }
            });

        }

        function subtotal() {
            var subtotal;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('d/Transaksi/subtotal_cart'); ?>',
                dataType: "json",
                accepts: {
                    json: 'application/json'
                },
                success: function (response) {
                    subtotal = number_idr(response.data);
                    subtotal = 'Rp. '+subtotal;
                    $('#subtotalcart').val(subtotal);
                    $('#subtotalvalue').val(response.data);
                    set_ppn();
                    if(response.data == 0){
                        document.getElementById("button_submit").disabled = true;
                    }else{
                        document.getElementById("button_submit").disabled = false;
                    }
                }
            });
        }

        function total_weight() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('d/Transaksi/total_weight'); ?>',
                dataType: "json",
                accepts: {
                    json: 'application/json'
                },
                success: function (response) {
                    $('#totalweight').val(response.totalweight);
                }
            });
        }

        function updateQty(rowid, idproduct) {
            var row = rowid;
            var qty = $('#qty' + row).val();
            var idproduct = idproduct;
            $.ajax({
                url: "<?php echo site_url('Cart/update_qty_cart'); ?>",
                method: "POST",
                data: {"rowid": row, "qty": qty, "idproduct": idproduct},
                success: function (data) {
                    $('#data-cart').html(data);
                    load_cart();
                    subtotal();
                }
            });
        }

        function getOrigin(des, weight, cour) {
            $('.loading').remove();
            var str = "'";
            var $op = $("#datakurir");
            var i, j, x = "";
            var add = 0;
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
                                x += ('<tr><td><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="shiping" id="shiping" onclick="set_ongkir(' + str + (parseInt(field.costs[i].cost[j].value) + parseInt(add)) + str + ')" value="' + field.name + ' - ' + field.costs[i].service + '" required> ' + '( ' + field.code + ' )' + " - " + field.costs[i].service + ' - ' + field.costs[i].description + ' (ESTIMASI ' + field.costs[i].cost[j].etd + ' hari) - Rp.' + number_idr((field.costs[i].cost[j].value + add)) + '</label></div></td></tr>');
                            }
                        }
                        $op.html(x);
                    });
                }
                $('.loading').remove();
            });
        }

        function set_ongkir_cod(idr){
            $('#ongkirvalue').val(idr);
            var idr = number_idr(parseInt(idr));
            var idr = 'Rp. ' + idr + '';
            $('#ongkir').val(idr);
            var shiping = $("input[type='radio'][name='shiping']:checked").val();
            var set_shipingdesc = $('#shipingdesc').val(shiping);
            grand_total();
        }

        function set_ongkir(idr){

            $('#ongkirvalue').val(idr);
            var idr = number_idr(parseInt(idr));
            var idr = 'Rp. ' + idr + '';
            $('#ongkir').val(idr);
            var shiping = $("input[type='radio'][name='shiping']:checked").val();
            var set_shipingdesc = $('#shipingdesc').val(shiping);
            grand_total();
        }

        function grand_total(){

            var tax = '<?php echo $profile->taxProduct;?>';
            $('#grandtotal').val('');
            var subtotalcart = $('#subtotalvalue').val();;
            var discount = $('#discount').val();
            var ongkir = $('#ongkirvalue').val();
            ongkir = parseInt(ongkir);
            var ppn = tax;

            var total = (parseInt(subtotalcart)-parseInt(discount))+ongkir;
            var ppn = parseInt(total)*parseInt(ppn)/100;
            ppn = Math.round(ppn);
            ppnidr = number_idr(ppn);
            ppnidr = 'Rp. '+ppnidr;
            $('#ppn').val(ppnidr);
            var total = total+ppn;


            totalidr = number_idr(total);
            totalidr = 'Rp. '+totalidr;
            $('#ppn').val(ppnidr);

            $('#grandtotal').val(totalidr);
            $('#grandtotalvalue').val(total);
        }

        function set_ppn(){
            $('#ppn').val('');
            var tax = '<?php echo $profile->taxProduct;?>';
            var subtotalcart = $('#subtotalvalue').val();
            var discount = $('#discount').val();
            var ongkir = $('#ongkirvalue').val();
            ongkir = parseInt(ongkir);
            var ppn = tax;

            var total = (parseInt(subtotalcart)-parseInt(discount))+ongkir;
            var ppn = parseInt(total)*parseInt(ppn)/100;
            ppn = Math.round(ppn);
            ppnidr = number_idr(ppn);
            ppnidr = 'Rp. '+ppnidr;
            $('#ppn').val(ppnidr);
            $('#ppnvalue').val(ppn);
            grand_total();
        }

        function submit_transaksi(){
            $('#loader').show();
            var valid = $("#transaksi").valid();

            if (valid ==  true){

               swal({
                title: "Anda yakin akan memproses transaksi ini ?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#218838",
                confirmButtonText: "Proses",
                cancelButtonText: "Batal",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    var form = $("#transaksi").get(0);
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('d/Transaksi/submit_transaksi'); ?>',
                        data: new FormData(form),
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        accepts: {
                            json: 'application/json'
                        },
                        success: function (response) {
                            if(response.status == 1){
                                dataTransaksi();
                                window.open('<?php echo base_url('d/Exportdata/export_struck?idorder=') ?>'+response.idorder+'');
                            }
                        }
                    });
                } else {
                    swal("", "", "error");
                }
            });
           }else{
            swal("","Lengkapi semua data","error");
        }
    }
</script>
