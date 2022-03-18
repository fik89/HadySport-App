<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_transaksi', 'M_product', 'M_user', 'M_daerah', 'M_company', 'M_order', 'M_invoice', 'M_keuangan'));
        $this->load->library('cart');
        $this->load->database();
    }

    function input_transaksi() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data_product'] = $this->M_product->data_product()->result();
            $data['data_user'] = $this->M_user->data_user_all()->result();
            $data['profile'] = $this->M_company->data_company()->row();
            $data['kurir'] = $this->db->get('t_cod')->result_array();
            $this->load->view('dashboard/transaksi/input_transaksi', $data);
        }
    }

    function tambah_barang() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $idproduct = $this->input->post('idproduct');
            $qty = $this->input->post('jumlah');

            $data_product = $this->M_product->product_by_id($idproduct)->row();
            if($data_product->quantityStock < $qty){
                $result['status'] = 0;
                $result['message'] = 'Anda melebih stok, stok = '.$data_product->quantityStock;
                echo json_encode($result);
            }else{
                $data = array(
                    'id' => $idproduct,
                    'name' => $data_product->productName,
                    'price' => $data_product->price,
                    'qty' => $qty,
                    'options' => array(
                        'weight' => $data_product->productWeight,
                        'image' => $data_product->fotoName
                    )
                );
                $this->cart->insert($data);
                $subweight = array();
                foreach ($this->cart->contents() as $key) {
                    $tmp['weight'] = $key['options']['weight'] * $key['qty'];
                    array_push($subweight, $tmp);
                }
                $totalweight = array_sum(array_column($subweight, 'weight'));
                $result['status'] = 1;
                $result['data'] = $this->data_cart("add");
                $result['totalweight'] = $totalweight;
                echo json_encode($result);
            }
        }
    }

    function data_cart($action) {
        $output = '';
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            $str = "'";
            $output .= '
            <tr>
            <td>
            <img src="' . site_url('asset/img/uploads/product/' . $items['options']['image'] . '') . '" alt="' . $items['name'] . '" style="max-width:80px">
            </td>
            <td>' . $items['id'] . '</td>
            <td>' . $items['name'] . '</td>
            <td>Rp. <span class="money">' . $this->cart->format_number($items['price']) . '</span></td>
            <td>
            <input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="form-control" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '" min="1">
            </td>
            <td>Rp. ' . $this->cart->format_number($items['subtotal']) . '</td>
            <td><button class="remove-cart btn btn-sm btn-danger" id="' . $items['rowid'] . '" title="Hapus"><i class="fa fa-trash"></i></button></td>
            </tr>
            ';
        }
        if (empty($this->cart->contents())) {
            $output = "<h6 class='text-center'>Data Belanja Kosong</h6>";
        } else {
            $output = $output;
        }
        if ($action == "add") {
            return $output;
        } else {
            echo $output;
        }
    }

    function subtotal_cart() {
        $return['data'] = $this->cart->total();
        echo json_encode($return);
    }

    function total_weight() {
        $subweight = array();
        foreach ($this->cart->contents() as $key) {
            $tmp['weight'] = $key['options']['weight'] * $key['qty'];
            array_push($subweight, $tmp);
        }
        $totalweight = array_sum(array_column($subweight, 'weight'));
        $result['status'] = 1;
        $result['totalweight'] = $totalweight;
        echo json_encode($result);
    }

    function submit_transaksi() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $idorder = $this->input->post('idorder');
            if(empty($idorder)){
                $idorder = $this->M_order->generate_id_order();
            }else{
                $idorder = $idorder;
            }

            $iduser = $_SESSION['iduser'];
            $dataprofile = $this->M_company->data_company()->row();
            $cekinvoice = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
            #t_order
            $cek_order = $this->M_order->cek_order_id($idorder)->row();
            $datestring = 'Y-m-d H:i:s';
            $time = date('H:i:s');

            $tanggal = $this->input->post('tanggal');
            $idpembeli = $this->input->post('datapembeli');
            $firstname = $this->input->post('namadepan');
            $lastname = $this->input->post('namabelakang');
            $custphone = $this->input->post('telepon');
            $codeProvinsi = $this->input->post('provinsi');
            $codeKabupaten = $this->input->post('kabupaten');
            $codeKecamatan = $this->input->post('kecamatan');
            $desa = $this->input->post('desa');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $postalcode = $this->input->post('kodepos');
            $custemail = $this->input->post('email');
            $usekurir = $this->input->post('usekurir');
            $kurir = $this->input->post('kurir');
            $shiping = $this->input->post('shiping');
            $totalweight = $this->input->post('totalweight');
            $subtotalvalue = $this->input->post('subtotalvalue');
            $biayapengiriman = $this->input->post('ongkirvalue');
            $ppnvalue = $this->input->post('ppnvalue');
            $shipingdesc = $this->input->post('shipingdesc');
            $grandtotalvalue = $this->input->post('grandtotalvalue');

            if($idpembeli == 'umum'){
                $firstname = 'Umum';
                $namaProvinsi = 0;
                $namaKota = 0;
                $namaKecamatan = 0;
                $codeProvinsi = 0;
                $codeKabupaten = 0;
                $codeKecamatan = 0;
            }else{
                $namaProvinsi = $this->get_nama_provinsi($codeProvinsi);
                $namaKota = $this->get_nama_kota($codeKabupaten, $codeProvinsi);
                $namaKecamatan = $this->get_nama_kecamatan($codeKecamatan, $codeKabupaten);
            }
            #set status order
            $status_order = 'process shiping';
            # tanggal not null 
            if(!empty($tanggal)){
                $tanggal = $tanggal.' '.$time;
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
                    'subtotalWeight' => $items['options']['weight'] * $items['qty']
                ));
            }

            if (!empty($cekorderdetail->idorder)) {
                $this->M_order->delete_data_order_detail($idorder);
                $this->M_order->store_cart($data_order_detail);
            } else {
                $this->M_order->store_cart($data_order_detail);
            }


            $data_oder = array(
                'idorder' => $idorder,
                'iduser' => $iduser,
                'orderMethod' => 'Offline',
                'tax' => $ppnvalue,
                'totalShiping' => $biayapengiriman,
                'idpartner' => 0,
                'partnerDiscount' => 0,
                'cartTotal' => $this->cart->total(),
                'orderSumary' => $grandtotalvalue,
                'status' => $status_order,
                'orderDate' => $tanggal
            );

            if (!empty($cekorder->idorder)) {
                $this->M_order->update_data_order($idorder, $data_oder);
            } else {
                $this->M_order->store_order($data_oder);
            }


            #data shiping
            $data_shiping = array(
                'idorder' => $idorder,
                'iduser' => $iduser,
                'firstName' => $firstname,
                'lastName' => $lastname,
                'codeProvinsi' => $codeProvinsi,
                'codeKabupaten' => $codeKabupaten,
                'codeKecamatan' => $codeKecamatan,
                'namaProvinsi' => $namaProvinsi,
                'namaKabupaten' => $namaKota,
                'kecamatan' => $namaKecamatan,
                'desa' => $desa,
                'rt' => $rt,
                'rw' => $rw,
                'kodePos' => $postalcode,
                'custEmail' => $custemail,
                'custHp' => $custphone,
                'shipingCarge' => $biayapengiriman,
                'shipingName' => $shipingdesc,
                'totalPrice' => $biayapengiriman+$subtotalvalue,
                'dateCreate' => $tanggal
            );
            if (!empty($cek_order->idorder)) {
                $this->M_order->update_data_order_shiping($idorder, $data_shiping);
            } else {
                $this->M_order->store_shiping($data_shiping);
            }
            
            #invoice
            $datainvoice = array(
                'idorder' => $idorder,
                'bankAccountName' => 'Input By Admin',
                'paymentMethod' => "Input By Admin",
                'invoicePrice' => $grandtotalvalue,
                'tax' => $ppnvalue,
                'invoiceStatus' => "closing paid",
                'invoiceDate' => date($datestring),
                'dateConfirmPayment' => date($datestring),
            );
            if (empty($cekinvoice)) {
                $storeinvoice = $this->M_invoice->store_invoice($datainvoice);
            } else {
                $storeinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);
            }

            #transaksi
            $data_keuangan = array(
                'idorder' => $idorder,
                'price' => $grandtotalvalue,
                'iduser' => $iduser,
                'type' => 'debet offline',
                'keterangan' => 'Pembelian Product',
                'date_create' => $tanggal
            );
            $storekeuangan = $this->M_keuangan->store_keuangan($data_keuangan);
            $this->update_stock_product($idorder);

            $result['status'] = 1;
            $result['message'] = "Success";
            $result['idorder'] = $idorder;
            echo json_encode($result);

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
     public function getKurirCod(){
       $id = $this->input->post('id');
       $ongkir = $this->db->get_where('t_cod',['idcod'=>$id])->result_array();
       // echo $this->rupiah($ongkir);
       // var_dump($id);
       $ar = array();
       foreach ($ongkir as $value) {
          array_push($ar, $ongkir);
       }
       echo json_encode($ongkir);
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
        $kecname = $rajaongkir->_api_ongkir('subdistrict?id='.$kec.'&city='.$kota.'');
        $data = json_decode($kecname, true);
        $result = json_encode($data['rajaongkir']['results']['subdistrict_name']);
        return str_replace('"', " ", $result);
    }

    function remove_cart() {
        $newarray = [];
        foreach ($this->cart->contents() as $key) {
            $tmp['rowid'] = $key['rowid'];
            $tmp['qty'] = 0;
            array_push($newarray, $tmp);
        }
        $this->cart->update($newarray);
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
        $this->remove_cart();
    }

    function get_data_transaksi(){
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $str = "'";
            $list = $this->M_transaksi->get_datatables_transaksi_offline();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $result) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $result->idorder;
                $row[] = $result->firstName." ".$result->lastName;
                $row[] = "Rp. ".number_format($result->orderSumary);
                $row[] = $result->orderDate;
                $row[] = '
                <button class="btn btn-sm btn-info" onclick="detail_order('.$result->idorder.')"><i class="fa fa-eye"></i></button>
                <button class="btn btn-sm btn-danger" onclick="delete_order('.$result->idorder.')"><i class="fa fa-trash"></i></button>
                ';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->M_transaksi->count_all(),
                "recordsFiltered" => $this->M_transaksi->count_filtered(),
                "data" => $data,
            );
            echo json_encode($output);
        }
    }

    function data_transaksi(){
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $this->load->view('dashboard/transaksi/data_transaksi');
        }
    }
}