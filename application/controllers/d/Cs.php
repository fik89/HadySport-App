<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cs extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_cs'));
        $this->load->library(array());
        $this->load->database();
    }
    
    function data_cs(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_cs->data_cs()->result();
            $this->load->view('dashboard/cs/data_cs', $data);
        }
    }
    
    function update_cs() {
        $id = $this->input->post('id');
        $data = array(
            'csName' => $this->input->post('name'),
            'csPhone' => $this->input->post('phone'),
            'status' => $this->input->post('status')
        );
        $this->M_cs->update_data_cs($id, $data);
    }
    
    function f_store_cs(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/cs/f_store_cs');
        }
    }
    
    function store_cs() {
        $data = array(
            'csName' => $this->input->post('name'),
            'csPhone' => $this->input->post('phone'),
            'status' => "Active"
        );
        $this->M_cs->store_cs($data);
    }
    
    function add_action_order_cs(){
        $phone = $this->input->post('csphone');
        $id = $this->input->post('id');
        $count = $this->input->post('count');
        $addcount = $count + 1;
        $data = array(
            'count' => $addcount
        );
        $this->M_cs->update_data_cs($id, $data);
    }
}