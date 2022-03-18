<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_widget', 'M_company', 'M_design', 'M_category', 'M_invoice', 'M_user', 'M_bank', 'M_order'));
        $this->load->database();
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('date', 'form', 'url', 'cookie'));
    }

    function index() {

            $company = $this->M_company->data_company()->row();

            $mailto = 'cs@dansdigitalmedia.com';
            $subject = "test smpt";
            $msg = 'test jam: '.date('Y-m-d H:i:s');

            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "front";
            $Mail->send($mailto, $subject, $msg, $loc);
        }

}
