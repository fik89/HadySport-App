<?php if ($detailorder[0]->status == "selesai") { ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Order Anda telah selesai, Terimakasih atas kepercayaan Anda.
    </div>
<?php } else { ?>
    <div class="alert alert-default alert-dismissible">
        <button class="btn btn-block btn-sm btn-success" onclick="finish_order('<?php echo encryption($detailorder[0]->idorder);?>');"><i class="fa fa-check"></i> Selesaikan order ini</button>
    </div>
<?php } ?>
<div class="container-table-cart pos-relative">
    <div class="wrap-table-shopping-cart bgwhite">
        <table class="table-shopping-cart">
            <tr class="table-head">
                <th class="column-1"></th>
                <th class="column-2">Produk</th>
                <th class="column-3">Qty</th>
                <th class="column-3">Harga</th>
                <th class="column-4 p-l-70">Komentar Anda</th>
                <th class="column-6">Rating Anda</th>
                <th class="column-7"></th>
            </tr>
            <?php foreach ($detailorder as $value) { ?>
                <input id="idorder<?php echo $value->idP; ?>" value="<?php echo $value->idorder; ?>" type="hidden">
                <input  id="pcomment<?php echo $value->idP; ?>" value="<?php echo $value->comment; ?>" type="hidden">
                <input  id="qty<?php echo $value->idP; ?>" value="<?php echo $value->productQty; ?>" type="hidden">
                <tr class="table-row">
                    <td class="column-1">
                        <div class="cart-img-product-history b-rad-4 o-f-hidden" id="pimg<?php echo $value->idP; ?>">
                            <img src="<?php echo base_url('asset/img/uploads/product/') . $value->fotoName; ?>" alt="<?php echo $value->productName; ?>">
                        </div>
                    </td>
                    <td class="column-2" id="pname<?php echo $value->idP; ?>"><?php echo $value->productName; ?></td>
                    <td class="column-3" id="pname<?php echo $value->idP; ?>"><?php echo $value->productQty; ?></td>
                    <td class="column-3">Rp. <?php echo number_format($value->productPrice); ?></td>
                    <td class="column-4">
                        <?php echo $value->comment; ?>
                    </td>
                    <td class="column-6" id="prating">
                        <input id="prating<?php echo $value->idP; ?>" value="<?php echo $value->ratingProduct; ?>" class="rating-loading ratingbar" data-min="0" data-max="5" data-step="1" data-size="xs" readonly="">

                    </td>
                    <td class="column-7 p-r-10">
                      <?php if (empty($value->idretur)) { ?>
                            <button class="btn btn-sm btn-success"  onclick="get_rating('<?php echo $value->idP; ?>')">
                                <?php
                                if ($value->submitRating != "OK") {
                                    echo "Beri Penilaian";
                                } else {
                                    echo "Edit Penilaian";
                                }
                                ?>
                            </button>
                        <?php } ?>

                        <?php if ($value->status == "process shiping" && empty($value->idretur)) { ?>
                            <button class="btn btn-sm btn-success"  onclick="get_rating('<?php echo $value->idP; ?>')">
                                <?php
                                if ($value->submitRating != "OK") {
                                    echo "Beri Penilaian";
                                } else {
                                    echo "Edit Penilaian";
                                }
                                ?>
                            </button>
                            <button class="btn btn-sm btn-danger"  onclick="retur('<?php echo $value->idP; ?>')">
                                Retur *
                            </button>
                        <?php } else if ($value->status == "selesai") { ?>
                            <button class="btn btn-sm btn-success"  onclick="get_rating('<?php echo $value->idP; ?>')">
                                <?php
                                if ($value->submitRating != "OK") {
                                    echo "Beri Penilaian";
                                } else {
                                    echo "Edit Penilaian";
                                }
                                ?>
                            </button>
                        <?php } else if (!empty($value->idretur)) { ?>
                            <button class="btn btn-sm btn-info" onclick="info_retur('<?php echo $value->idretur; ?>');">
                                Anda telah mengajukan retur. ID: <?php echo $value->idretur;?>
                            </button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>         
    </div>
</div>
<div class="modal" id="myModal" style="z-index:999999">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formrating">
                <div class="modal-header bg-dark text-white text-center">
                    <h5 class="modal-title">Beri Penilaian untuk produk <span id="productname"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="pimage" class="cart-img-product-history b-rad-4 o-f-hidden"></div>
                    <label>Komentar Anda Mengenai Produk ini</label>
                    <textarea class="form-control" id="comment" name="comment"></textarea>
                    <hr>
                    <label>Kepuasan Anda</label>
                    <input id="ratingvalue" name="rating" class="rating-loading">
                    <input id="idproduct" name="idproduct" type="hidden">
                    <input id="idorderval" name="idorderval" type="hidden">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="submit_rating();">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="myModalretur" style="z-index:9999">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="login_form" id="formretur">
                <div class="modal-header bg-dark text-white text-center">
                    <h5 class="modal-title">Retur produk <span id="productnamer"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="pimager" class="cart-img-product-history b-rad-4 o-f-hidden"></div>
                    <div class="form-group">
                        <label>Alasan Retur</label>
                        <textarea class="form-control" id="commentr" name="commentr" required="" maxlength="200" placeholder="max 200 karakter"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="solution" id="solution" class="form-control">
                            <option value="" disabled="" selected="">Permintaan Opsi Retur</option>
                            <option value="pengembalian barang">Pengembalian Barang</option>
                            <option value="pengembalian uang">Pengembalian Uang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Retur</label>
                        <input class="form-control" type="number" name="qtyretur" id="qtyretur" required="">
                    </div>
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <input class="form-control" type="file" name="imgproduct" id="imgproduct" onchange="preview(this);" required="">
                        <img id="imgproductpre" style="width: 50%; height: 50%;"/>
                    </div>
                    <input id="idproductr" name="idproductr" type="hidden">
                    <input id="idordervalr" name="idordervalr" type="hidden">
                </div>
                <div class="modal-footer">
                    <button type="button" class="pull-left btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success pull-right" onclick="submit_retur();">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldetailretur" style="z-index:9999">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white text-center">
                <h5 class="modal-title" id="headerinfo"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">Opsi Retur</span>
                    <span class="w-full-sm" id="opsiretur"></span>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">Jumlah Retur</span>
                    <span class="w-full-sm" id="qtyreturinfo"></span>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">Alasan Retur</span>
                    <span class="w-full-sm" id="alasanretur"></span>
                </div>
                <hr>

                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">Informasi Dari Admin</span>
                    <span class="w-full-sm" id="infoadmin"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $('.ratingbar').rating({
            showCaption: false,
            showClear: false,
            size: 'xs'
        });
    });
    function finish_order(id) {
            var id = id;
            swal({
                title:"",
                text: "Apa Anda yakin pesanan dari toko kami sudah diterima atau anda akan menyelesaikan order ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#218838",
                confirmButtonText: "Finish",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '<?php echo base_url('Order/finish_order'); ?>',
                                method: "POST",
                                dataType: "json",
                                accepts: {
                                    json: 'application/json'
                                },
                                data: {"id": id},
                                success: function (resp) {
                                    if (resp.status == 0) {
                                        swal("", "" + resp.message + "", "error");
                                    } else {
                                        swal("", "" + resp.message + "", "success");
                                        location.reload();
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
    function get_rating(id) {
        var idorder = $('#idorder' + id).val();
        var pname = document.getElementById("pname" + id).innerHTML;
        var pcomment = $('#pcomment' + id).val();
        var prating = $('#prating' + id).val();
        var pimg = document.getElementById("pimg" + id).innerHTML;
        $('#idorderval').val(idorder);
        $('#comment').val(pcomment);
        $('#idproduct').val(id);
        $('#ratingvalue').val(prating);
        $('#productname').html(pname);
        $('#pimage').html(pimg);
        $('#ratingvalue').rating({
            'showCaption': false,
            'showClear': false,
            'stars': '5',
            'min': '0',
            'max': '5',
            'step': '1',
            'size': 'lg',
        });

        $('#myModal').modal('show');
    }

    function submit_rating() {
        var valid = $("#formrating").valid();
        if (valid == true) {
            var form = $('#formrating').get(0);
            form_data = new FormData(form);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('Rating/submit_rating') ?>',
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
                        swal("", "" + resp.message + "", "error");
                    } else {
                        list_product();
                    }
                    $('#loader').hide();
                },
                error: function (resp) {
                    swal("", "" + resp.status + "", "error");
                }
            });
        }
    }

    function retur(id) {
        var idorder = $('#idorder' + id).val();
        var qty = $('#qty' + id).val();
        var pname = document.getElementById("pname" + id).innerHTML;
        var pimg = document.getElementById("pimg" + id).innerHTML;
        $("#qtyretur").attr({
            "max": qty,
            "min": 1
        });

        $('#idordervalr').val(idorder);
        $('#idproductr').val(id);
        $('#productnamer').html(pname);
        $('#pimager').html(pimg);

        $('#myModalretur').modal('show');
    }

    function submit_retur() {
        var form_data;
        var file;
        var valid = $("#formretur").valid();
        if (valid == true) {
            var form = $('#formretur').get(0);

            file = $('#imgproduct').prop('files')[0];
            form_data = new FormData(form);
            form_data.append('file', file);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('Retur/submit_retur') ?>',
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
                        swal("", "" + resp.message + "", "error");
                    } else {
                        swal("", "" + resp.message + "", "success");
                        list_product();
                    }
                    $('#loader').hide();
                },
                error: function (resp) {
                    swal("", "" + resp.status + "", "error");
                }
            });
        }
    }
    function preview(oInput) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imgproduct").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("imgproductpre").src = oFREvent.target.result;
        };
        ValidateSingleInput(oInput);
    }
    var _validFileExtensions = [".jpg", ".jpeg", ".png", ".JPG", ".JPEG", ".PNG"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Maaf, " + sFileName + " tidak valid, silahkan upload dengan tipe file: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }

    function info_retur(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('Retur/detail_retur') ?>',
            method: "POST",
            dataType: "json",
            data: {id: id},
            accepts: {
                json: 'application/json'
            },
            success: function (resp) {
                if (resp.status == 0) {
                    swal("", "" + resp.message + "", "error");
                } else {
                    var header = "Informasi Retur dengan ID : " + resp.data.idretur + "";
                    $('#headerinfo').html(header);
                    $('#infoadmin').html(resp.data.comment_reply);
                    $('#qtyreturinfo').html(resp.data.qty_retur);
                    $('#opsiretur').html(resp.data.request_retur_solution);
                    $('#alasanretur').html(resp.data.comment_retur);
                    $('#modaldetailretur').modal('show');
                }
                $('#loader').hide();
            },
            error: function (resp) {
                swal("", "" + resp.status + "", "error");
            }
        });
    }
</script>