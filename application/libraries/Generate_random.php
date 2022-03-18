<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Generate_random {
    protected $CI;
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model(array(''));
        $this->CI->load->database();
    }

    function random_string_integer($lenght) {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string = '';
        for ($i = 0; $i < $lenght; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    function random_int($lenght){
        $int = '123456789';
        $string = '';
        for ($i = 0; $i < $lenght; $i++) {
            $pos = rand(0, strlen($int) - 1);
            $string .= $int{$pos};
        }
        return $string;
    }
}