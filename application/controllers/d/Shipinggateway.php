<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ShipingGateway extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_shiping_gateway', 'M_order'));
    }

    #cek resi
    function cek_resi() {
        $captcha_code = $this->input->post('captcha_code', TRUE);
        $current_captcha = $this->session->userdata('captcha_code');
        if($captcha_code != $current_captcha){
            $result['status'] = 0; 
            $result['message'] = "Wrong Captcha"; 
            $result['result'] = false; 
        }else{
            $resi = $this->input->post('resi', TRUE);
            $courier = $this->input->post('courier', TRUE);
            if(empty($resi) && empty($courier)){
                $result['status'] = 0; 
                $result['message'] = "Please, fill all field data"; 
                $result['result'] = false; 
            }else{

                $this->load->library('Rajaongkir');
                $rajaongkir = new Rajaongkir;
                $data = $rajaongkir->_api_waybill($resi, $courier);
                $data = json_decode($data, true);
                $result['status'] = 1; 
                $result['message'] = "Success"; 
                $result['result'] = $data['rajaongkir'];
            }

        }
        header('Content-type: text/javascript');
        echo json_encode($result);
    }

    function result_waybill(){
        $data = $this->input->post('data');
        $data['data'] = $data['result']['result'];
        $this->load->view('frontend/result_cek_resi', $data);
    }

    function get_provinsi() {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsi = $rajaongkir->_api_ongkir('province');
        $data = json_decode($provinsi, true);
        echo json_encode($data['rajaongkir']['results']);
    }

    function get_kota($provinsi = "") {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        if (!empty($provinsi)) {
            if (is_numeric($provinsi)) {
                $kota = $rajaongkir->_api_ongkir('city?province=' . $provinsi);
                $data = json_decode($kota, true);
                echo json_encode($data['rajaongkir']['results']);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    } 
    
    function get_kecamatan($kota = "") {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        if (!empty($kota)) {
            if (is_numeric($kota)) {
                $kec = $rajaongkir->_api_ongkir('subdistrict?city=' . $kota);
                $data = json_decode($kec, true);
                echo json_encode($data['rajaongkir']['results']);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }
    
    function get_nama_kecamatan($kec, $kota) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kecname = $rajaongkir->_api_ongkir('subdistrict?id='.$kec.'&city='.$kota.'');
        $data = json_decode($kecname, true);
        $result = json_encode($data['rajaongkir']['results']['subdistrict_name']);
        return str_replace('"', " ", $result);
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

    function store_origin_shiping() {
        $id = 1; //change by param if more than one gateway
        $idprovinsi = $this->input->post('provinsi');
        $idkota = $this->input->post('kotaorigin');

        $data = array(
            'originProvinceCode' => $idprovinsi,
            'originCityCode' => $idkota,
            'originProvinceName' => $this->get_nama_provinsi($idprovinsi),
            'originCityName' => $this->get_nama_kota($idkota, $idprovinsi)
        );
        $this->M_shiping_gateway->update_shiping_gateway($id, $data);
    }

    function get_cost($des, $weight, $cour) {
        $gatewayname = "Raja Ongkir";
        $origin = $this->M_shiping_gateway->data_shiping_gateway_by_name($gatewayname)->row();
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $tarif = $rajaongkir->_api_ongkir_post($origin->originCityCode, $des, $weight, $cour);
        $data = json_decode($tarif, true);
        echo json_encode($data);
    }
}