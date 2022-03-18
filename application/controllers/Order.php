<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_widget', 'M_company', 'M_bank', 'M_category', 'M_order', 'M_invoice', 'M_design', 'M_product', 'M_voucher'));
        $this->load->database();
        $this->load->helper('url', 'date');
    }

    function form_track_order() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Lacak Order Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "", 'trackorder' => "sale-noti", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '', 'terms' => '', 'privacy' => '', 'cekresi' => '', 'gallery' => '');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/track_order', $data);
    }

function track_order_result() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Lacak Order Belanja | " . $profil->companyName;
        $idorderpost = $this->input->post('idorder');
        $idorderget = $this->input->get('idorder');

        if(!empty($idorderget)){
            $cek = substr($idorderget, 0,3);
            if($cek == 585){
                $idorder = $idorderget;
            }else{
                $idorder = decryption($idorderget);
            }

        }else{
            $cek = substr($idorderpost, 0,3); 
            if($cek == 585){
                $idorder = $idorderpost;
            }else{
                $idorder = decryption($idorderpost);
            }
        }

        
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "", 'trackorder' => "sale-noti", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '', 'terms' => '', 'privacy' => '', 'cekresi' => '', 'gallery' => '');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/track_order_result', $data);
    }

    function detail_order() {
        $idorder = $this->uri->segment(3);
        $idorder = decryption($idorder);
        $data['detailorder'] = $this->M_order->history_order($idorder)->result();
        if (!empty($data['detailorder'])) {
            $data['profile'] = $this->M_company->data_company()->row();
            $data['title'] = "Lacak Order Belanja | " . $data['profile']->companyName;
            $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
            $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
            $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
            $data['activemenu'] = array('home' => "", 'blog' => '', 'product' => "", 'cart' => "", 'trackorder' => "sale-noti", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '', 'terms' => '', 'privacy' => '', 'cekresi' => '', 'gallery' => '');
            $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
            $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
            $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
            $data['header'] = $this->load->view('header', $data, TRUE);
            $data['footer'] = $this->load->view('footer', $data, TRUE);
            $this->load->view('frontend/detail_order', $data);
        } else {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Id Order tidak ditemukan</div>');
            redirect('pages/profile', 'refresh');
        }
    }

    function data_detail_order($id) {
        $idorder = $this->uri->segment(3);
        $idorder = decryption($idorder);
        $data['detailorder'] = $this->M_order->history_order($idorder)->result();
        $this->load->view('frontend/data_detail_order', $data);
    }

    function place_order() {
        if (empty($_SESSION['iduser'])) {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sesi Anda telah berakhir, Silahkan Login kembali.</div>');
            redirect('pages/login', 'refresh');
        } else {
            $idorder = $this->input->post('idorder');
            $idorder = decryption($idorder);
            $dataprofile = $this->M_company->data_company()->row();
            $cekinvoice = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
            #t_order
            $cek_order = $this->M_order->cek_order_id($idorder)->row();
            #count subtotal price cart
            $subtotal_cart = $cek_order->cartTotal;

            $iduser = $this->session->userdata('iduser');
            $idpartner = $this->session->userdata('idpartner');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $fulladdress = $this->input->post('fulladdress');
            $desa = $this->input->post('desa');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $codeProvinsi = $this->input->post('provinsi');
            $codeKabupaten = $this->input->post('kabupaten');
            $codeKecamatan = $this->input->post('kecamatan');
            $postalcode = $this->input->post('postalcode');
            $custphone = $this->input->post('customerphone');
            $custemail = $this->input->post('customeremail');

            $biayapengiriman = $this->input->post('biayapengiriman');
            $shipingdesc = $this->input->post('shipingdesc');
            $dropshippername = $this->input->post('dropshippername');
            $dropshipperphone = $this->input->post('dropshipperphone');
            $dropshipperaddress = $this->input->post('dropshipperaddress');

            $idbank = $this->input->post('idbank');
            $discountpartner = $this->input->post('discountpartner');
            $databank = $this->M_bank->data_bank_by_id($idbank)->row();

            $jumlahvoucher = $this->input->post('jumlahvoucher');
            $idvoucher = $this->input->post('idvoucher');

            #set numeric 0 empty post
            if (empty($discountpartner)) {
                $discountpartner = 0;
            }
            if (empty($jumlahvoucher)) {
                $jumlahvoucher = 0;
            }

            $datestring = 'Y-m-d H:i:s';
            $tanggalSekarang = date("Y-m-d H:i:s");
            #cek tanggal expired
            if (!empty($cekinvoice)) {
                if (!empty($cek_order)) {
                    if ($cek_order->orderDate != $tanggalSekarang) {
                        $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Order Sukses</strong>, Silahkan Cek kembali sebelum Anda melakukan Pemabayaran.</div>';
                        $daysdue = date('Y-m-d H:i:s', strtotime('+' . $dataprofile->daysDue . ' hour', strtotime($tanggalSekarang)));
                        $do = 1;
                    } else {
                        if ($cekinvoice->dueDate < $tanggalSekarang) {
                            $alert = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Order Anda EXPIRED.</div>';
                            $daysdue = $cekinvoice->dueDate;
                            $do = 1;
                        } else if ($cekinvoice->invoiceStatus == 'PAID') {
                            $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Order Anda sudah terkonfirmasi.</div>';
                            $daysdue = $cekinvoice->dueDate;
                            $do = 1;
                        } else {
                            $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Order Sukses</strong>, Silahkan Cek kembali sebelum Anda melakukan Pemabayaran.</div>';
                            $daysdue = date('Y-m-d H:i:s', strtotime('+' . $dataprofile->daysDue . ' hour', strtotime($tanggalSekarang)));
                            $do = 1;
                        }
                    }
                } else {
                    if ($cekinvoice->dueDate < $tanggalSekarang) {
                        $alert = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Order Anda EXPIRED.</div>';
                        $daysdue = $cekinvoice->dueDate;
                        $do = 1;
                    } else if ($cekinvoice->invoiceStatus == 'PAID') {
                        $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Order Anda sudah terkonfirmasi.</div>';
                        $daysdue = $cekinvoice->dueDate;
                        $do = 1;
                    } else {
                        $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Order Sukses</strong>, Silahkan Cek kembali sebelum Anda melakukan Pemabayaran.</div>';
                        $daysdue = date('Y-m-d H:i:s', strtotime('+' . $dataprofile->daysDue . ' hour', strtotime($tanggalSekarang)));
                        $do = 1;
                    }
                }
            } else {
                $alert = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Order Sukses</strong>, Silahkan Cek kembali sebelum Anda melakukan Pemabayaran.</div>';
                $daysdue = date('Y-m-d H:i:s', strtotime('+' . $dataprofile->daysDue . ' hour', strtotime($tanggalSekarang)));
                $do = 1;
            }

            # do 1
            if ($do == 1) {
                # generate uniq number
                $this->load->library('Generate_random');
                $rand = new Generate_random;
                $uniqcode = $rand->random_int(2);

                $discount = $jumlahvoucher + $discountpartner;
                $ordersummary = $biayapengiriman + $subtotal_cart;
                $ordersummary = $ordersummary - $discount;
                $totalshiping = $subtotal_cart + $biayapengiriman;

                #cek enable pajak
                if ($dataprofile->taxProduct != 0) {
                    #menghitung dengan pajak
                    $jumlah_pajak = ($ordersummary * $dataprofile->taxProduct) / 100;
                    $ordersummary = $ordersummary + $jumlah_pajak;
                } else {
                    $jumlah_pajak = 0;
                    $ordersummary = $ordersummary + $jumlah_pajak;
                }

                $ordersummary = $ordersummary + $uniqcode;

                #data tabel order
                $data_order = array(
                    'idorder' => $idorder,
                    'iduser' => $iduser,
                    'idvoucher' => $idvoucher,
                    'partnerDiscount' => $discountpartner,
                    'discountPrice' => $jumlahvoucher,
                    'orderSumary' => $ordersummary,
                    'status' => "place order",
                    'orderMethod' => "online",
                    'idbank' => $idbank,
                    'tax' => $jumlah_pajak,
                    'totalShiping' => $biayapengiriman,
                );

                if ($cek_order->idorder == $idorder) {
                    $this->M_order->update_data_order($idorder, $data_order);
                } else {
                    $this->M_order->store_order($data_oder);
                }

                #data shiping
                $data_shiping = array(
                    'iduser' => $iduser,
                    'firstName' => $firstname,
                    'lastName' => $lastname,
                    'codeProvinsi' => $codeProvinsi,
                    'codeKabupaten' => $codeKabupaten,
                    'codeKecamatan' => $codeKecamatan,
                    'namaProvinsi' => $this->get_nama_provinsi($codeProvinsi),
                    'namaKabupaten' => $this->get_nama_kota($codeKabupaten, $codeProvinsi),
                    'kecamatan' => $this->get_nama_kecamatan($codeKecamatan, $codeKabupaten),
                    'desa' => $desa,
                    'rt' => $rt,
                    'rw' => $rw,
                    'kodePos' => $postalcode,
                    'custEmail' => $custemail,
                    'fullAddress' => $fulladdress,
                    'custHp' => $custphone,
                    'shipingCarge' => $biayapengiriman,
                    'shipingName' => $shipingdesc,
                    'totalPrice' => $totalshiping,
                    'dropshipperName' => $dropshippername,
                    'dropshipperPhone' => $dropshipperphone,
                    'dropshipperAddress' => $dropshipperaddress,
                );
                if ($cek_order->idorder == $idorder) {
                    $this->M_order->update_data_order_shiping($idorder, $data_shiping);
                } else {
                    $this->M_order->store_shiping($data_shiping);
                }

                $datainvoice = array(
                    'idorder' => $idorder,
                    'bankAccountName' => $databank->accountName,
                    'paymentMethod' => "$databank->bankName-$databank->accountNumber",
                    'invoicePrice' => $ordersummary,
                    'tax' => $jumlah_pajak,
                    'invoiceStatus' => "closing unpaid",
                    'invoiceDate' => date($datestring),
                    'dueDate' => $daysdue
                );
                if (empty($cekinvoice)) {
                    $storeinvoice = $this->M_invoice->store_invoice($datainvoice);
                } else {
                    $storeinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);
                }
                $this->session->set_flashdata('MSG', '' . $alert . '');

                $response = array(
                    'status' => 1,
                    'redirect' => base_url('') . 'pages/cart/check-out?idorder=' . encryption($idorder) . ''
                );
            } else {
                $this->session->set_flashdata('MSG', '' . $alert . '');

                $response = array(
                    'status' => 0,
                    'redirect' => base_url('') . 'pages/product/search?category=0&price=asc&group=',
                    'message' => 'Order Anda Telah Expired, silahkan melakukan belanja lagi'
                );
            }
            header('Content-type: text/javascript');
            echo json_encode($response);
        }
    }

    function cancel_order() {
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $idorder = $this->input->post('id');
            $idorder = decryption($idorder);
            $data_order = array(
                'status' => 'canceled'
            );
            $data_invoice = array(
                'invoiceStatus' => 'canceled'
            );
            $updateorder = $this->M_order->update_data_order($idorder, $data_order);
            $updateinvoice = $this->M_invoice->update_invoice($idorder, $data_invoice);

            $return['status'] = 1;
            $return['message'] = "Success update data";
            header('Content-type: text/javascript');
            echo json_encode($return);
        }
    }

    function get_nama_provinsi($provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsiname = $rajaongkir->_api_ongkir('province?id=' . $provinsi . '');
        $data = json_decode($provinsiname, true);
        $result = json_encode($data['rajaongkir']['results']['province']);
        return str_replace('"', " ", $result);
    }

    function get_nama_kota($kota, $provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kotaname = $rajaongkir->_api_ongkir('city?id=' . $kota . '&province=' . $provinsi . '');
        $data = json_decode($kotaname, true);
        $result = json_encode($data['rajaongkir']['results']['city_name']);
        return str_replace('"', " ", $result);
    }

    function get_nama_kecamatan($kec, $kota) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kecname = $rajaongkir->_api_ongkir('subdistrict?id=' . $kec . '&city=' . $kota . '');
        $data = json_decode($kecname, true);
        $result = json_encode($data['rajaongkir']['results']['subdistrict_name']);
        return str_replace('"', " ", $result);
    }

    function update_stock_product($idorder) {
        $dataorderdetail = $this->M_order->data_detail_order_product($idorder)->result();
        $dataproduct = array();
        foreach ($dataorderdetail as $value) {
            if (($value->quantityStock - $value->productQty) < 1) {
                $productstatus = "Out Of Stock";
            } else {
                $productstatus = "In Stock";
            }
            $arraytmp = array(
                'idproduct' => $value->idproduct,
                'quantityStock' => $value->quantityStock - $value->productQty,
                'productStatus' => $productstatus
            );
            array_push($dataproduct, $arraytmp);
        }
        $this->M_product->update_stock_product($dataproduct);
    }

    function detail_order_history($idorder) {
        if (!empty($idorder)) {
            $idorder = decryption($idorder);
            $detailorder = $this->M_order->cek_order_id($idorder)->row();
            $idorder = encryption($idorder);
            if (!empty($detailorder)) {
                $status_order = $detailorder->status;
                if ($status_order == "process shiping") {
                    redirect('pages/order-search?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "add to cart") {
                    redirect('pages/cart/form-customer?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "insert data customer") {
                    redirect('pages/cart/shiping?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "insert shiping") {
                    redirect('/pages/cart/payment?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "closing unpaid") {
                    redirect('pages/invoice?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "closing paid") {
                    redirect('pages/invoice?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "payment method") {
                    redirect('pages/cart/payment?idorder=' . ($idorder) . '', 'refresh');
                } else if ($status_order == "place order") {
                    redirect('pages/cart/check-out/?idorder=' . ($idorder) . '', 'refresh');
                }
            } else {
                $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Id Order tidak ditemukan</div>');
                redirect('pages/profile', 'refresh');
            }
        } else {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Registrasi Sukses</strong> Id Order tidak ditemukan</div>');
            redirect('pages/profile', 'refresh');
        }
    }

    function finish_order() {
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $idorder = $this->input->post('id');
            $idorder = decryption($idorder);
            $cek_order = $this->M_order->cek_order_id($idorder)->row();
            if (empty($cek_order)) {
                $return['status'] = 0;
                $return['message'] = "IDorder tidak ditemukann";
                header('Content-type: text/javascript');
                echo json_encode($return);
            } else {
                $data_order = array(
                    'status' => 'selesai'
                );
                $data_invoice = array(
                    'invoiceStatus' => 'selesai'
                );
                $updateorder = $this->M_order->update_data_order($idorder, $data_order);
                $updateinvoice = $this->M_invoice->update_invoice($idorder, $data_invoice);
                $return['status'] = 1;
                $return['message'] = "Update Sukses, Terimakasih"
                        . "";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        }
    }

}
