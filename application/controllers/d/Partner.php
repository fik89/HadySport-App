<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Partner extends CI_Controller {

    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_partner'));
        $this->load->database();
    }

    function data_partner_all() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_partner->data_partner_all()->result();
            $this->load->view('dashboard/partner/data_partner', $data);
        }
    }

    function store_partner() {
        $rule = $this->input->post('partnerrule');
        if ($rule == "discount per price") {
            $price = $this->input->post('discount');
            $percent = "";
        } elseif ($rule == "Admin") {
            $price = "";
            $percent = "";
        } elseif($rule == "discount per percen") {
            $price = "";
            $percent = $this->input->post('discount');
        }else{
            $price = "";
            $percent = "";  
        }
        $data = array(
            'partnerName' => $this->input->post('partnername'),
            'partnerRule' => $rule,
            'partnerPay' => $this->input->post('partnerpay'),
            'partnerAmountCost' => str_replace(".", "",$this->input->post('partneramountcost')),
            'partnerDiscountPrice' => $price,
            'partnerDiscountPercent' => $percent,
            'partnerDescription' => $this->input->post('partnerdescription'),
            'partnerStatus' => $this->input->post('status'),
        );
        $this->M_partner->store_partner($data);
    }

    function f_input_partner() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/partner/f_input_partner');
        }
    }

    function f_update_data_partner(){
        $id = $this->input->post('id');

        $data['partner'] = $this->M_partner->data_partner_by_id($id)->row();
        $this->load->view('dashboard/partner/update_data_partner', $data);
    }

    function update_status_partner() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data = array(
                'partnerStatus' => $this->input->post('status')
            );
            $this->M_partner->update_partner($id, $data);
        }
    }

    function delete_partner() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $this->M_partner->delete_partner($id);
        }
    }
    
    function data_partner_by_id($id){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->M_partner->data_partner_by_id($id)->row();
        }
    }

    function update_partner($id){
        $rule = $this->input->post('partnerrule');
        if ($rule == "discount per price") {
            $price = $this->input->post('discount');
            $percent = "";
        } elseif ($rule == "Admin") {
            $price = "";
            $percent = "";
        } elseif($rule == "discount per percen") {
            $price = "";
            $percent = $this->input->post('discount');
        }else{
          $price = "";
          $percent = "";  
        }
        $data = array(
            'partnerName' => $this->input->post('partnername'),
            'partnerRule' => $rule,
            'partnerPay' => $this->input->post('partnerpay'),
            'partnerAmountCost' => str_replace(".", "",$this->input->post('partneramountcost')),
            'partnerDiscountPrice' => $price,
            'partnerDiscountPercent' => $percent,
            'partnerDescription' => $this->input->post('partnerdescription'),
            'partnerStatus' => $this->input->post('status'),
        );
        $this->M_partner->update_partner($id, $data);
    }
}