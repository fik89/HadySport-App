<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Keranjang Belanja
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </span>
    <a href="JavaScript:void(0);" class="s-text16">
        Data Pembeli
    </a>
</div>
<section class="cart bgwhite p-t-30 p-b-100">
    <div class="container">
        <div id="data-cart"></div>
    </div>
</section>

<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                vars[key] = value;
            });
            return vars;
        }
        var param = getUrlVars()['idorder'];
        $.ajax({
            url: '<?php echo site_url('Cart/show_cart?idorder='); ?>' + param,
            type: 'GET',
            success: function (resp) {
                $('#data-cart').html(resp);
            }
        });

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
                                    loadQty();
                                }
                            });
                            swal("Terhapus!", "", "success");
                        } else {
                            swal("", "", "error");
                        }
                    });
        });
    });

    function updateQty(rowid, idproduct) {
        var row = rowid;
        var qty = $('#qty' + row).val();
        var idproduct = idproduct;
        $.ajax({
            url: "<?php echo site_url('Cart/update_qty_cart'); ?>",
            method: "POST",
            data: {"rowid": row, "qty": qty, "idproduct":idproduct},
            success: function (data) {
                $('#data-cart').html(data);
                loadQty();
                getList();
            }
        });
    }
    function loadQty() {
        $.ajax({
            url: "<?php echo site_url('Cart/load_qty_cart'); ?>",
            method: "GET",
            success: function (resp) {
                $('#qty-cart-a').html(resp);
                $('#qty-cart-b').html(resp);
                $('#qty-cart-c').html(resp);
            }
        });
    }
    function getList() {
        $.ajax({url: "<?php echo base_url('Cart/load_list_cart') ?>", success: function (resp) {
                $('#list-cart-a').html(resp);
                $('#list-cart-b').html(resp);
                $('#list-cart-c').html(resp);
            }});
    }
</script>
</body>
</html>