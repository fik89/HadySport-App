<?php echo $header; ?>
<section class="bg-title-page p-t-120 p-b-30 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center">
        Produk
    </h2>
    <p class="m-text13 t-center">
        <?php
        $uri = $this->uri->segment('3');
        if (empty($uri)) {
            echo $profile->companyName;
        } else {
            echo str_replace(".html", "", $uri);
        }
        ?>
    </p>
</section>
<div class="bread-crumb flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="s-text16">
        Semua Produk <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i> 
    </a>
    <span class="s-text17">
        pencarian produk
    </span>
</div>
<section class="bgwhite p-t-20 p-b-25">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-20 p-t-20">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                    <i class="fa fa-tasg"></i> Kategori
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show">
                                <div class="card-body">
                                    <div style="height: 200px; overflow-y: auto; overflow-x: hidden;">
                                        <?php echo $category; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50 p-t-20">
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <p>Hasil pencarian "<span id="searchproduct"></span>"</p>
                        </div>
                    </div>
                    <div class="s-text8 p-t-5 p-b-5">
                        Menampilkan <span id="countresult"></span> hasil
                    </div>
                </div>
                <div class="row" id="load_data"></div>
                <div class="row"><div class="col-md-12" id="load_data_message"></div></div>
            </div>
        </div>
    </div>
</section> 
<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
<div id="dropDownSelect2"></div>
<?php echo $footer; ?>
<script type="text/javascript" src="<?php echo site_url('asset/') ?>vendors/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('asset/') ?>js/bootstrap-treeview.js"></script>
<script type="text/javascript">
    $(".selection-2").select2({minimumResultsForSearch: 20, dropdownParent: $('#dropDownSelect2')});
</script>
<script>
    function url_replace(limit, start, category, price) {
        var base = '<?php echo base_url(''); ?>';
        var price = '' + price + '';
        window.location.replace(base + "pages/product/search?category=" + category + "&price=" + price + "&group=");
    }

    $(document).ready(function () {
        countresult();
        searchProduct();
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                vars[key] = value;
            });
            return vars;
        }
        var limit = 6;
        var start = 0;
        var action = 'inactive';
        var productname = getUrlVars()["search"];
        var price = getUrlVars()["price"];
        var group = getUrlVars()["group"];
        function lazzy_loader(limit)
        {
            var output = '';
            for (var count = 0; count < limit; count++)
            {
                output += '<div class="p-b-50 post_data">';
                output += '<div class="block2">';
                output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                output += '<p><span class="content-placeholder" style="width:100%; height: 80px;">&nbsp;</span></p>';
                output += '</div>';
                output += '</div>';
            }
            $('#load_data_message').html(output);
        }
        lazzy_loader(limit);

        function load_data(limit, start, productname)
        {
            var outputend = '<div class="col-md-12"><div class="alert alert-info col-md-12 text-center"><small>Tidak ada Produk untuk di tampilkan lagi</small></div></div>';
            var output = '<div class="col-md-12"><div class="alert alert-info col-md-12 text-center"><small>Produk untuk Kategori ini Kosong</small></div></div>';
            $.ajax({
                url: "<?php echo base_url(); ?>product/fetch_search",
                method: "POST",
                data: {limit: limit, start: start, productname: productname},
                cache: false,
                success: function (data)
                {
                    $('.ratingbar').rating({
                        showCaption: false,
                        showClear: false,
                        size: 'xs'
                    });
                    if (start < 6 && data == '')
                    {
                        $('#load_data_message').html(output);
                        action = 'active';
                    }else if(start >= 6 && data == ''){
                        $('#load_data_message').html(outputend);
                        action = 'active';
                    } else
                    {
                        $('#load_data').append(data);
                        $('#load_data_message').html("");
                        action = 'inactive';
                    }
                }
            })
        }

        if (action == 'inactive')
        {
            action = 'active';
            load_data(limit, start, productname);
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
            {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_data(limit, start, productname);
                }, 1000);
            }
        });
        checkedList();
        $('.common_selector').click(function () {
        });

    });
    function getUrl() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }

    function sortingGroup() {
        var limit = 6;
        var start = 0;
        var action = 'inactive';
        var category = getUrl()["category"];
        var base = '<?php echo base_url(''); ?>';
        var group = $("#groupcat").val();
        var check = document.getElementById("groupcat").checked;
        if (check == true) {
            window.location.replace(base + "pages/product/search?category=0&price=ASC&group=" + group);
        } else {
            window.location.replace(base + "pages/product/search?category=0&price=ASC&group=");
        }
    }

    function searchProduct() {
        var searchproduct = getUrl()["search"];
        $('#searchproduct').html(searchproduct);
    }

    function sortingPrice() {
        var limit = 6;
        var start = 0;
        var category = getUrl()["category"];
        var base = '<?php echo base_url(''); ?>';
        var price = $("#price").val();
        var group = getUrl()["group"];
        var check = document.getElementById("price").checked;
        if (check == true) {
            window.location.replace(base + "pages/product/search?category=" + category + "&price=" + price + "&group=" + group);
        } else {
            window.location.replace(base + "pages/product/search?category=" + category + "&price=" + price + "&group=");
        }
    }

    function checkedList() {
        var group = getUrl()["group"];
        if (group == "sale")
            document.getElementById("groupcat").checked = true;
    }
    function countresult() {
        var product = getUrl()["search"];
        $.ajax({
            url: "<?php echo base_url(); ?>Product/count_search_result",
            method: "POST",
            data: {product: product},
            cache: false,
            success: function (data) {
                $('#countresult').html(data);
            }
        });
    }
</script>
</body>
</html>