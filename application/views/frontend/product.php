<?php echo $header; ?>
<section class="bg-title-page p-t-120 p-b-30 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center">
        Produk
    </h2>
</section>
<div class="bread-crumb flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="s-text16">
        Semua Produk <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i> 
    </a>
    <div id="bread"></div>
</div>
<section class="bgwhite p-t-20 p-b-25">
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-b-20 p-t-20">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                   <i class="fa fa-list"></i> Kategori
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse">
                                <div class="card-body">
                                    <div style="height: 200px; overflow-y: auto; overflow-x: hidden;">
                                        <?php echo $category; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                    <i class="fa fa-filter"></i> Filter
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse">
                                <div class="card-body">
                                    <div style="overflow-y: auto; overflow-x: hidden;">
                                        <div class="list-group-item checkbox s-text13a">
                                            <label class="s-text13a"><input type="checkbox" class="common_selector" name="groupcat" id="groupcat" value="sale" onchange="sortingGroup();"> Diskon</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 p-b-50 p-t-20">
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 dropDownSelect2 form-control" name="price" id="price" onchange="sortingPrice();">
                                <option>Urutkan</option>
                                <option value="desc">Harga: tertinggi</option>
                                <option value="asc">Harga: terendah</option>
                            </select>
                        </div>
                    </div>
                    <div class="s-text8 p-t-5 p-b-5">
                        Menampilkan <span id="countresult"></span> hasil
                    </div>
                </div>
                <div class="row" id="load_data"></div>
                <div class="row" id="load_data_message"></div>
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
<script>
    function url_replace(limit, start, category, price) {
        var base = '<?php echo base_url(''); ?>';
        var price = '' + price + '';
        window.location.replace(base + "pages/product/search?category=" + category + "&price=" + price + "&group=");
    }

    $(document).ready(function () {
        breadcrumb();
        countresult();
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
        var category = getUrlVars()["category"];
        var price = getUrlVars()["price"];
        var group = getUrlVars()["group"];
        function lazzy_loader(limit)
        {
            var output = '';
            for (var count = 0; count < limit; count++)
            {
                output += '<div class="col-sm-12 col-md-6 col-lg-4 p-b-50 post_data">';
                output += '<div class="block2">';
                output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                output += '<p><span class="content-placeholder" style="width:100%; height: 80px;">&nbsp;</span></p>';
                output += '</div>';
                output += '</div>';
            }
            $('#load_data_message').html(output);
        }
        lazzy_loader(limit);

        function load_data(limit, start, category, price, group)
        {
            var outputend = '<div class="col-md-12"><div class="alert alert-info col-md-12 text-center"><small>Tidak ada Produk untuk di tampilkan lagi</small></div></div>';
            var output = '<div class="col-md-12"><div class="alert alert-info col-md-12 text-center"><small>Produk untuk Kategori ini Kosong</small></div></div>';
            $.ajax({
                url: "<?php echo base_url(); ?>product/fetch",
                method: "POST",
                data: {limit: limit, start: start, category: category, price: price, group: group},
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
            });
        }

        if (action == 'inactive')
        {
            action = 'active';
            load_data(limit, start, category, price, group);
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
            {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_data(limit, start, category, price, group);
                }, 1000);
            }
        });
        checkedList();
         $('.common_selector').click(function(){
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

    function sortingPrice() {
        var limit = 6;
        var start = 0;
        var category = getUrl()["category"];
        var base = '<?php echo base_url(''); ?>';
        var price = $("#price").val();
        var group = getUrl()["group"];
        var check = document.getElementById("price").checked;
        if (check == true) {
            window.location.replace(base + "pages/product/search?category="+ category +"&price="+ price +"&group=" + group);
        } else {
            window.location.replace(base + "pages/product/search?category="+ category +"&price="+ price +"&group=");
        }
    }

    function checkedList() {
        var group = getUrl()["group"];
        if (group == "sale")
            document.getElementById("groupcat").checked = true;
    }
    function breadcrumb(){
                var category = getUrl()["category"];
                 $.ajax({
                url: "<?php echo base_url(); ?>Product/breadcrumb",
                method: "POST",
                data: {category: category},
                cache: false,
                success: function (data){
                        $('#bread').html(data);
                    }
            });
    }
    function countresult(){
                var category = getUrl()["category"];
                var group = getUrl()["group"];
                 $.ajax({
                url: "<?php echo base_url(); ?>Product/count_product_result",
                method: "POST",
                data: {category: category, group:group},
                cache: false,
                success: function (data){
                        $('#countresult').html(data);
                    }
            });
    }
</script>
</body>
</html>