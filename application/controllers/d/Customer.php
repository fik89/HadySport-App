<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_order'));
        $this->load->database();
    }

    function data_customer(){
        $data['data'] = $this->M_order->data_order()->result();
        $this->load->view('dashboard/customer/data_customer', $data);
    }
}
