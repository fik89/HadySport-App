<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_widget','M_company', 'M_design', 'M_product', 'M_category'));
        $this->load->database();
        $this->load->library('');
    }
    function index() {
        $data['title'] = "title";
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "",  'blog'=>'','product' => "",'cart' => "", 'trackorder' => "", 'payment' => "sale-noti", 'sale' => "", 'about' => "", 'contact' => "", 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/checkout', $data);
    }
}