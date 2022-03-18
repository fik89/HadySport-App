<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maintenance extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_ads'));
        $this->load->database();
    }
    function list_exportdata(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
    	   $this->load->view('dashboard/maintenance/list_exportdata');
        }
    }
}
