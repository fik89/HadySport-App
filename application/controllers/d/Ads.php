<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ads extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_ads'));
        $this->load->library(array('session'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function data_ads_fb_pixel() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_ads->data_ads_by_name("FB Pixel")->result();
            $this->load->view('dashboard/ads/data_ads_fb_pixel', $data);
        }
    }

    function f_ads_pixel() {
        $this->load->view('dashboard/ads/f_ads_pixel');
    }

    function store_ads() {
        $data = array(
            'adsName' => $this->input->post('adsname'),
            'adsScript' => $this->input->post('adsscript'),
            'adsStatus' => "Active"
        );
        $this->M_ads->store_ads($data);
    }

    function update_status_ads() {
        $id = $this->input->post('id');
        $data = array(
            'adsStatus' => $this->input->post('status')
        );
        $this->M_ads->update_data_ads($id, $data);
    }
    
    function update_ads() {
        $id = $this->input->post('id');
        $data = array(
            'adsName' => $this->input->post('adsname'),
            'adsScript' => $this->input->post('adsscript'),
            'adsStatus' => "Active"
        );
        $this->M_ads->update_data_ads($id, $data);
    }

    function delete_ads() {
        $this->M_ads->delete_ads($this->input->post('id'));
    }
    
    function f_update_ads(){
        $id = $this->input->post('id');
        $data['ads'] = $this->M_ads->data_ads_by_id($id)->row();
        $this->load->view('dashboard/ads/f_update_ads_pixel', $data);
    }
}