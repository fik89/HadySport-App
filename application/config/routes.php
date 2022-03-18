<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = 'Home/page_404';
$route['sitemap\.xml'] = "Home/sitemap";
$route['pages/product-detail/(:any)'] = 'Product/detail_product/$1';
// $route['pages/product/(:any)'] = 'Product/product_by_link/$1';
$route['pages/product/search'] = 'Product/search/';
$route['pages/about'] = 'Home/about';
$route['pages/contact'] = 'Home/contact';
$route['default_controller'] = 'Home/home';
$route['translate_uri_dashes'] = FALSE;

$route['pages/product-search/p'] = 'Product/search_product/';

//user
$route['pages/login'] = "User/login";
$route['pages/update_account/(:any)'] = "User/f_edit_account/$1";

//cart-order-invoice
$route['pages/cart'] = "Cart";
$route['pages/cart/form-customer'] = "Cart/cart_form_customer";
$route['pages/cart/shiping'] = "Cart/cart_shiping";
$route['pages/cart/cart-partner'] = "Cart/cart_partner/";
$route['pages/cart/payment'] = "Cart/cart_payment/";
$route['pages/cart/check-out'] = "Cart/check_out/";

$route['pages/invoice/invoice-partner'] = "Invoice/invoice_partner/";
$route['pages/invoice'] = "Invoice/invoice/";
$route['pages/track-order'] = "Order/form_track_order/";
$route['pages/confirm-payment'] = "Invoice/form_confirm_payment/";
$route['pages/order-search'] = "Order/track_order_result/";

$route['pages/profile'] = "Home/data_profile_partner/";
$route['pages/reset-password'] = "User/f_reset_password/";
$route['pages/create-new-password'] = "User/f_new_password/";

// blog
$route['pages/blog/(:num)'] = "Blog/blog/$1";
$route['pages/blog'] = "Blog/blog";
$route['pages/blog-detail/(:any)'] = "Blog/blog_detail/$1";
$route['pages/blog-category'] = "Blog/blog_category";
$route['pages/blog-category/(:num)'] = "Blog/blog_category/$1";
$route['pages/blog-category/(:num)/(:num)'] = "Blog/blog_category/$1/$1";
$route['pages/blog-search'] = 'Blog/search_blog';
$route['pages/blog-search/(:num)'] = 'Blog/search_blog/';

//gallery
$route['pages/gallery/(:num)'] = "Home/gallery/$1";
$route['pages/gallery'] = "Home/gallery";

//service
$route['pages/service'] = "Home/service";

//term & condition
$route['pages/terms'] = "Home/term_condition";

//voucher_list
$route['pages/voucher'] = "Home/voucher_list";

//privacy policy
$route['pages/privacy'] = "Home/privacy_policy";

// cek resi
$route['pages/cekresi'] = "Home/cek_resi";

// detail order
$route['pages/detailorder/(:any)'] = "Order/detail_order";

$route['pages/404'] = "Order/detail_order";


