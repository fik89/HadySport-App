<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Create_cookie {
    protected $CI;
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model(array(''));
        $this->CI->load->database();
        $this->CI->load->helper('cookie');
    }

    function create_cookie($value) {
        $cookie=array(
            'name' => 'ci_odrid',
            'value' => $value,
            'expire' => 0,
            'domain' => '',
            'path' => '/',
            'prefix' => '',
            'httponly' => TRUE,
            'secure' => FALSE
            );
        set_cookie($cookie);
    }
}