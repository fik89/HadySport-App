<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wishlist extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_product', 'M_wishlist'));
        $this->load->database();
    }
    function data_count_wishlist(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_wishlist->data_count_wishlist()->result();
            $data['dataall'] = $this->M_wishlist->data_wishlist()->result();
            $this->load->view('dashboard/data_wishlist', $data);
        }
    }

}
