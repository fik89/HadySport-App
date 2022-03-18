<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_company', 'M_bank', 'M_email_sender', 'M_shiping_gateway'));
        $this->load->database();
    }
    
    function f_update_company_profile(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['dataprofile'] = $this->M_company->data_company()->row();
            $this->load->view('dashboard/system/f_update_company_profile', $data);
        }
    }

    function setting_company_profile() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['profile'] = $this->M_company->data_company()->result();
            $this->load->view('dashboard/system/f_setting_company_profile', $data);
        }
    }

    function update_company() {
        $data = array(
            'companyName' => $this->input->post('companyname'),
            'address1' => $this->input->post('address1'),
            'phone1' => $this->input->post('phone1'),
            'phone2' => $this->input->post('phone2'),
            'email' => $this->input->post('email'),
            'fbLink' => $this->input->post('fb_link'),
            'igLink' => $this->input->post('ig_link'),
            'twittLink' => $this->input->post('twitt_link'),
            'ytLink' => $this->input->post('yt_link'),
            'waPhone' => $this->input->post('wa'),
            'owner' => $this->input->post('owner'),
            'companyDescription' => $this->input->post('companydesc'),
            'tagcompanyDescription' => $this->input->post('tagcompanydesc')
        );
        $this->M_company->update_company($data);
    }

    function store_data_bank(){
        $data =  array(
            'bankName' => $this->input->post('bankname'),
            'accountName' => $this->input->post('accountname'),
            'accountNumber' => $this->input->post('accountnumber'),
            'status' => $this->input->post('status')
            );
        $this->M_bank->store_data_bank($data);
    }

    function f_input_bank(){
        $this->load->view('dashboard/system/f_input_bank');
    }

    function data_bank(){
        $data['databank'] = $this->M_bank->data_bank()->result();
        $this->load->view('dashboard/system/data_bank', $data);
    }

    function update_status_bank(){
        $id = $this->input->post('id');
        $data =  array(
            'bankName' => $this->input->post('bankname'),
            'accountName' => $this->input->post('accountname'),
            'accountNumber' => $this->input->post('accountnumber'),
            'status' => $this->input->post('status')
            );
        $this->M_bank->update_data_bank($id, $data);
    }

    function delete_data_bank() {
        $this->M_bank->delete_bank($this->input->post('id'));
    }

    function data_email_sender(){
        $data['dataemailsender'] = $this->M_email_sender->data_email_sender()->result();
        $this->load->view('dashboard/system/data_email_sender', $data);
    }

    function update_email_sender(){
        $id = $this->input->post('id');
        $data =  array(
            'protocol' => $this->input->post('protocol'),
            'smtp_host' => $this->input->post('smtp_host'),
            'smtp_port' => $this->input->post('smtp_port'),
            'smtp_user' => $this->input->post('smtp_user'),
            'smtp_pass' => $this->input->post('smtp_pass'),
            'mailtype' => $this->input->post('mailtype'),
            'charset' => $this->input->post('charset')
            );
        $this->M_email_sender->update_email_sender($id, $data);
    }
    
    function data_shiping_gateway(){
        $data['datashipinggateway'] = $this->M_shiping_gateway->data_shiping_gateway()->result();
        $this->load->view('dashboard/system/data_shiping_gateway', $data);
    }
    
    function update_shiping_gateway(){
        $id = $this->input->post('id');
        $data =  array(
            'shipingGatewayName' => $this->input->post('name'),
            'apiToken' => $this->input->post('token'),
            'upCost' => $this->input->post('upcost')
            );
        $this->M_shiping_gateway->update_shiping_gateway($id, $data);
    }
    
    function data_order_setting(){
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->view('dashboard/system/data_order_setting', $data);
    }
    
    function update_order_setting(){
        $data = array(
            'daysDue' => $this->input->post('daysdue')
        );
        $this->M_company->update_company($data);
    }

    function data_setting_pajak(){
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->view('dashboard/system/data_setting_pajak', $data);
    }
    
    function update_setting_pajak(){
        $data = array(
            'taxProduct' => $this->input->post('tax')
        );
        $this->M_company->update_company($data);
    }
}