<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_widget', 'M_wishlist', 'M_company', 'M_design', 'M_product', 'M_category', 'M_bank', 'M_invoice', 'M_order', 'M_shiping_gateway'));
        $this->load->database();
        $this->load->library('cart');
        $this->load->helper('cookie', 'date', 'session');
    }

    function a() {
        echo "<pre>";
        print_r($this->session->userdata());
    }

    function test_email(){
      $company = $this->M_company->data_company()->row();

      $mailto = 'dansdmedia@gmail.com';
      $subject = "Test email";
      $msg = 'ini test eemail SMP ';

      $this->load->library('Mail_sender');
      $Mail = new Mail_sender;
      $loc = "front";
      $Mail->send($mailto, $subject, $msg, $loc);
  }

  function index() {
    $data['profile'] = $this->M_company->data_company()->row();
    $data['title'] = "Keranjang Belanja | " . $data['profile']->companyName;
    $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
    $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
    $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '', 'terms' => '', 'privacy' => '', 'cekresi' => '', 'gallery' => '');
    $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
    $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
    $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
    $data['header'] = $this->load->view('header', $data, TRUE);
    $data['footer'] = $this->load->view('footer', $data, TRUE);
    $this->load->view('frontend/cart', $data);
}

function cart_partner() {
    $data['profile'] = $this->M_company->data_company()->row();
    $data['title'] = "Keranjang Belanja | " . $data['profile']->companyName;
    $idorder = decryption($this->input->get('idorder'));

    $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
    $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
    $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '', 'terms' => '', 'privacy' => '', 'cekresi' => '', 'gallery' => '');
    $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
    $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
    $data['bank'] = $this->M_bank->data_bank()->result();
    $data['cart'] = $this->M_invoice->invoice_partner_by_id($idorder)->row();
    $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
    $data['header'] = $this->load->view('header', $data, TRUE);
    $data['footer'] = $this->load->view('footer', $data, TRUE);
    $this->load->view('frontend/cart_partner', $data);
}

function add_to_cart() {
    $idproduct = $this->input->post('idproduct');
    $productname = $this->input->post('productname');

    $cekqty = $this->M_product->product_by_id($idproduct)->row();

    $data = array(
        'id' => $this->input->post('idproduct'),
        'name' => $productname,
        'price' => $this->input->post('price'),
        'qty' => $this->input->post('qty'),
        'coupon' => '',
        'options' => array(
            'image' => $this->input->post('image'),
            'weight' => $this->input->post('weight'),
            'note' => $this->input->post('note')
        )
    );
    $this->cart->insert($data);
    $this->cek_stok();
    $this->load_qty_cart();
}

    // function store_session_to_order() {
    //     $generate_id_order = $this->M_order->generate_id_order();
    //     $ipaddress = $this->input->ip_address();
    //     $ses_idorder = $this->session->userdata('idorder');
    //     $cek_order_id = $this->M_order->cek_order_id($ses_idorder)->row();
    //     $data_oder = array(
    //         'idorder' => $ses_idorder,
    //         'iduser' => $ipaddress,
    //         'ipaddress' => $ipaddress,
    //         'orderSumary' => $this->cart->total(),
    //         'status' => "add to cart"
    //     );
    //     if (empty($cek_order_id)) {
    //         $this->M_order->store_order($data_oder);
    //     } elseif ($cek_order_id->status != "closing paid") {
    //         $data_oder = array(
    //             'idorder' => $ses_idorder,
    //             'iduser' => $ipaddress,
    //             'ipaddress' => $ipaddress,
    //             'orderSumary' => $this->cart->total(),
    //             'status' => $cek_order_id->status
    //         );
    //         $this->M_order->update_data_order($ses_idorder, $data_oder);
    //     } elseif ($cek_order_id->status == "closing paid" && $cek_order_id->status == "process shiping") {
    //         $this->session->unset_userdata('idorder');
    //         $this->session->set_userdata('idorder', $generate_id_order);
    //         $this->store_session_to_order();
    //     }
    // }

function load_qty_cart() {
    $newarray = array();
    foreach ($this->cart->contents() as $key) {
        $tmp['qty'] = $key['qty'];
        array_push($newarray, $tmp);
    }
    echo array_sum(array_column($newarray, 'qty'));
}

function load_list_cart() {
    $list = '';
    $list .= '<ul class="header-cart-wrapitem">';
    foreach ($this->cart->contents() as $items) {
        $list .= '<li class="header-cart-item">
        <div class="header-cart-item-img">
        <img src="' . site_url('asset/img/uploads/product/' . $items['options']['image'] . '') . '" alt="' . $items['options']['image'] . '">
        </div>
        <div class="header-cart-item-txt">
        <a href="#" class="header-cart-item-name">' . $items['name'] . '</a>
        <span class="header-cart-item-info">
        ' . $items['qty'] . ' pcs x <span class="money">' . $items['price'] . '</span>
        </span>
        </div>
        </li>
        </ul>';
    }
    $list .= '<div class="header-cart-total">'
    . 'Total: ' . $this->cart->format_number($this->cart->total()) . ''
    . '</div>';
    echo $list;
}

function update_qty_cart() {
    $qty = $this->input->post('qty');
    $idproduct = $this->input->post('idproduct');
    $data = array(
        'rowid' => $this->input->post('rowid'),
        'qty' => $qty
    );
    $cekqty = $this->M_product->product_by_id($idproduct)->row();
    if ($cekqty->quantityStock < $qty) {
        echo '<script>swal("Gagal","Anda melebih stok yang ada","error");</script>';
    } else {
        $this->cart->update($data);
    }
    $this->show_cart();
}

function cek_stok() {
    $data = array();
    foreach ($this->cart->contents() as $value) {
        $datatmp = $this->M_product->product_by_id($value['id'])->row();
        if ($datatmp->quantityStock < $value['qty']) {
            array_push($data, array(
                "idproduct" => $value['id'],
                "status" => "error",
                "stok" => $datatmp->quantityStock . " < " . $value['qty'],
                "rowiderror" => $value['rowid'],
                "realstock" => $datatmp->quantityStock,
                "name" => $value['name']
            ));
        } else {
            array_push($data, array(
                "idproduct" => $value['id'],
                "status" => "ok  ",
                "stok" => $datatmp->quantityStock . " < " . $value['qty'],
                "rowiderror" => $value['rowid'],
                "realstock" => $datatmp->quantityStock,
                "name" => $value['name']
            ));
        }
    }
    foreach ($data as $value) {
        if ($value['status'] == "error") {
            $this->update_real_stock($value['rowiderror'], $value['realstock']);
            echo '<script>swal("' . $value['name'] . '", "Gagal ditambahkan ke keranjang belanja!. melebihi batas stok (' . $value['stok'] . ')", "error");</script>';
        } else {
            echo '<script>swal({
                title: "",
                text: "' . $value['name'] . ' ditambahkan ke keranjang belanja !",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: "#008000",
                confirmButtonText: "Lihat Keranjang",
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                closeOnCancel: true,
                showCancelButton: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.href="' . base_url('pages/cart/') . '";
                    }
                });</script>';
            }
        }
    }

    function update_real_stock($rowid, $qty) {
        $data = [];
        foreach ($this->cart->contents() as $key) {
            $tmp['rowid'] = $rowid;
            $tmp['qty'] = $qty;
            array_push($data, $tmp);
        }
        $this->cart->update($data);
    }

    function delete_product() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => 0
        );
        $this->cart->update($data);
        $this->show_cart();
    }

    function show_cart() {
        $idorder = $this->input->get('idorder');
        if (empty($this->cart->total())) {
            echo '
            <div class="w-size18 p-t-20 p-b-38 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm text-center">
            <img src="' . base_url('asset/img/icons/emptycart.png') . '" style="width:40%;">
            <div class="p-t-20">Keranjang belanja Anda masih kosong. <br>
            <a class="btn btn-sm btn-success" href=' . base_url('pages/product/search?category=0&price=asc&group=') . '>Belanja Sekarang</a></div>
            </div>';
        } else {
            echo '
            <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
            <table class="table-shopping-cart">
            <tr class="table-head">
            <th class="column-1"></th>
            <th class="column-2"></th>
            <th class="column-3">Harga</th>
            <th class="column-4 p-l-70">Jumlah</th>
            <th class="column-5">Total</th>
            <th class="column-6"></th>
            </tr>';
            $output = '';
            $no = 1;
            foreach ($this->cart->contents() as $items) {
                $str = "'";
                $output .= '
                <tr class="table-row">
                <td class="column-1">
                <div class="remove-cart cart-img-product b-rad-4 o-f-hidden" id="' . $items['rowid'] . '">
                <img src="' . site_url('asset/img/uploads/product/' . $items['options']['image'] . '') . '" alt="' . $items['name'] . '">
                </div>
                </td>
                <td class="column-2 color0">' . $items['name'] . '</td>
                <td class="column-3">Rp. <span class="money">' . $this->cart->format_number($items['price']) . '</span></td>
                <td class="column-4">
                <div class="flex-w bo5 of-hidden w-size17">
                <input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="size1 m-text18 t-center num-product" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '">
                </div>
                </td>
                <td class="column-5">Rp. ' . $this->cart->format_number($items['subtotal']) . '</td>
                <td class="column-7"><button class="remove-cart btn btn-sm btn-danger" id="' . $items['rowid'] . '" title="Hapus"><i class="fa fa-trash"></i></button></td>
                </tr>
                ';
            }
            $output .= '</table>
            </div>
            </div>';
            $output .= '<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="col-lg-6"></div>

            <div class="col-md-6 pull-right">
            <span class="pull-right color3"><b>
            Subtotal Rp. ' . $this->cart->format_number($this->cart->total()) . '
            </b></span>
            </div>
            </div>

            <div class="flex-w flex-sb-m p-t-25 p-b-25 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">
            <a href="' . base_url('pages/product/search?category=0&price=asc&group=') . '" class="color0">
            <i class="fa fa-angle-double-left p-r-10"></i> Lanjutkan Belanja
            </a>
            </div>
            <div class="trans-0-4 m-t-10 m-b-10">
            <a href="' . base_url('Cart/store_cart?idorder=' . encryption($this->session->userdata('idorder')) . '') . '" class="btn subs_btn form-control">
            Checkout  <i class="fa fa-angle-double-right p-l-10"></i>
            </a>
            </div>
            </div>';
            echo $output;
        }
    }

    function store_cart() {
        if (empty($_SESSION['iduser'])) {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Silahkan login atau registrasi terlebih dahulu.</div>');
            redirect('pages/login', 'refresh');
        } else {
            $ipaddress = $this->input->ip_address();
            if (isset($_SESSION['iduser'])) {
                $iduser = $_SESSION['iduser'];
            }

            $idpartner = $this->session->userdata('tipeuser');
            if (empty($this->session->userdata('discountpercent'))) {
                $partnerdiscount = $this->session->userdata('discountprice');
            } else {
                $total = $this->cart->total();
                $disc = $this->session->userdata('discountpercent');
                $partnerdiscount = (($total * $disc) / 100);
            }

            #cek order not finish
            if (empty($iduser)) {
                $cek_order_id = $this->M_order->cek_order_not_finish("ip", $ipaddress)->row();
            } else {
                $cek_order_id = $this->M_order->cek_order_not_finish("id", $iduser)->row();
            }

            if (empty($iduser)) {
                $iduser = $ipaddress;
            } else {
                $iduser = $iduser;
            }
            
            if (!empty($cek_order_id)) {
                $idorder = $cek_order_id->idorder;
            } else {
                $idorder = $this->M_order->generate_id_order();
            }

            $cekorder = $this->M_order->cek_order_id($idorder)->row();
            $cekorderdetail = $this->M_order->data_order_detail_by_id($idorder)->row();
            $cekordershiping = $this->M_order->data_order_shiping_by_id($idorder)->row();

            $data_oder = array(
                'idorder' => $idorder,
                'iduser' => $iduser,
                'ipaddress' => $ipaddress,
                'idpartner' => $idpartner,
                'partnerDiscount' => $partnerdiscount,
                'cartTotal' => $this->cart->total(),
                'orderSumary' => $this->cart->total() - $partnerdiscount,
                'status' => "add to cart"
            );

            if (!empty($cekorder->idorder)) {
                $this->M_order->update_data_order($idorder, $data_oder);
            } else {
                $this->M_order->store_order($data_oder);
            }

            $data_order_detail = array();
            foreach ($this->cart->contents() as $items) {
                array_push($data_order_detail, array(
                    'idorder' => $idorder,
                    'idproduct' => $items['id'],
                    'productName' => $items['name'],
                    'productQty' => $items['qty'],
                    'productPrice' => $items['price'],
                    'subtotalPrice' => $items['subtotal'],
                    'productWeight' => $items['options']['weight'],
                    'subtotalWeight' => $items['options']['weight'] * $items['qty'],
                    'note' => $items['options']['note']
                ));
            }

            if (!empty($cekorderdetail->idorder)) {
                $this->M_order->delete_data_order_detail($idorder);
                $this->M_order->store_cart($data_order_detail);
            } else {
                $this->M_order->store_cart($data_order_detail);
            }

            $subweight = array();
            foreach ($this->cart->contents() as $key) {
                $tmp['weight'] = $key['options']['weight'] * $key['qty'];
                array_push($subweight, $tmp);
            }
            $totalweight = array_sum(array_column($subweight, 'weight'));

            $data_shiping = array(
                'idorder' => $idorder,
                'iduser' => $ipaddress,
                'totalPrice' => $this->cart->total(),
                'totalWeight' => $totalweight
            );

            if (!empty($cekordershiping->idorder)) {
                $this->M_order->update_data_order_shiping($idorder, $data_shiping);
            } else {
                $this->M_order->store_shiping($data_shiping); //t_order_shiping
            }
            redirect('pages/cart/form-customer?idorder=' . encryption($idorder) . '');
        }
    }

    function cart_form_customer() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Keranjang Belanja | " . $profil->companyName;
        $idorder = $this->input->get('idorder');
        $idorder = decryption($idorder);
        $cek_order = $this->M_order->cek_order_id($idorder)->row();
        if($cek_order->status != "add to cart"){
            redirect('pages/cart/', 'refresh');
        } else {
            $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
            $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
            $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'cekresi' => '', 'service' => '', 'gallery' => '', 'terms' => '', 'privacy' => '');
            $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
            $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");

            $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
            $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
            $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
            $data['shipinggateway'] = $this->M_shiping_gateway->data_shiping_gateway_by_name("Raja Ongkir")->row();

            $data['bank'] = $this->M_bank->data_bank_active()->result();
            $data['kurir'] = $this->db->get('t_cod')->result_array();
            $data['profile'] = $this->M_company->data_company()->row();
            $data['header'] = $this->load->view('header', $data, TRUE);
            $data['footer'] = $this->load->view('footer', $data, TRUE);
            $this->load->view('frontend/cart_form_customer', $data);
        }
    }

    function check_out() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Checkout Belanja | " . $profil->companyName;
        $idorder = $this->input->get('idorder');
        $idorder = decryption($idorder);
        $cek_order = $this->M_order->cek_order_id($idorder)->row();
        if($cek_order->status == "closing paid" || $cek_order->status == "process shiping"){
            redirect('pages/cart/', 'refresh');
        } else {
            $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
            $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
            $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'cekresi' => '', 'service' => '', 'gallery' => '', 'terms' => '', 'privacy' => '');
            $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
            $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");

            $data['orderresult'] = $this->M_order->data_order_id_check_out($idorder)->row();

            $data['bank'] = $this->M_bank->data_bank_active()->result();

            $data['profile'] = $this->M_company->data_company()->row();
            $data['header'] = $this->load->view('header', $data, TRUE);
            $data['footer'] = $this->load->view('footer', $data, TRUE);
            $this->load->view('frontend/check_out', $data);
        }
    }

    // function cart_shiping() {
    //     $idorder = $this->input->get('idorder');
    //     $profil = $this->M_company->data_company()->row();
    //     $data['title'] = "Keranjang Belanja | ".$profil->companyName;
    //     $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
    //     $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
    //     $data['activemenu'] = array('home' => "",  'blog'=>'','product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'cekresi' => '', 'service'=>'', 'gallery'=>'');
    //     $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
    //     $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
    //     $data['detailorder'] = $this->M_order->data_order_by_id($idorder)->row();
    //     $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
    //     $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
    //     $data['shipinggateway'] = $this->M_shiping_gateway->data_shiping_gateway_by_name("Raja Ongkir")->row();
    //     $data['profile'] = $this->M_company->data_company()->row();
    //     $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
    //     $data['header'] = $this->load->view('header', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer', $data, TRUE);
    //     $this->load->view('frontend/cart_shiping', $data);
    // }
    // function cart_payment() {
    //     $profil = $this->M_company->data_company()->row();
    //     $data['title'] = "Keranjang Belanja | ".$profil->companyName;
    //     $idorder = $this->input->get('idorder');
    //     $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
    //     $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
    //     $data['activemenu'] = array('home' => "",  'blog'=>'','product' => "", 'cart' => "sale-noti", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'cekresi' => '', 'service'=>'', 'gallery'=>'');
    //     $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
    //     $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
    //     $data['detailorder'] = $this->M_order->data_order_by_id($idorder)->row();
    //     $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
    //     $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
    //     $data['bank'] = $this->M_bank->data_bank()->result();
    //     $data['profile'] = $this->M_company->data_company()->row();
    //     $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
    //     $data['header'] = $this->load->view('header', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer', $data, TRUE);
    //     $this->load->view('frontend/cart_payment', $data);
    // }

    function add_to_wishlist() {
        $data = array(
            'idproduct' => $this->input->post('idproduct'),
            'ipaddress' => $this->input->ip_address(),
            'phone' => $this->input->post('emailhp')
        );
        $this->M_wishlist->store_wishlist($data);
    }

    public function getKurirCod(){
         $id = $this->input->post('id');
         $ongkir = $this->db->get_where('t_cod',['idcod'=>$id])->result_array();
           // $ar = array();
           // foreach ($ongkir as $value) {
           //    array_push($ar, $ongkir);
           // }
         echo json_encode($ongkir);
    }
    // function rupiah($rupiah = null){
    //     $rp = "Rp. ".number_format($rupiah,2,",",".");
    //     return $rp;

    // }

}
