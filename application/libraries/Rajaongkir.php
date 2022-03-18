<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rajaongkir {
  protected $CI;
  public function __construct() {
    $this->CI = & get_instance();
    $this->CI->load->model(array('M_shiping_gateway'));
    $this->CI->load->database();
  }

  function _api_waybill($resi,$cour)
  {
    $apikey =  $this->CI->M_shiping_gateway->data_shiping_gateway('Raja Ongkir')->row();
    $cour = strtolower($cour);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "waybill=".$resi."&courier=".$cour."",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: ".$apikey->apiToken.""
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
  }

  function _api_ongkir_post($origin,$des,$qty,$cour)
  {
    $apikey =  $this->CI->M_shiping_gateway->data_shiping_gateway('Raja Ongkir')->row();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=".$origin."&originType=city&destination=".$des."&destinationType=subdistrict&weight=".$qty."&courier=".$cour,   
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: ".$apikey->apiToken.""
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      return $err;
    } else {
      return $response;
    }
  }

  function _api_ongkir($data)
  {
    $apikey =  $this->CI->M_shiping_gateway->data_shiping_gateway('Raja Ongkir')->row();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/".$data,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",     
      CURLOPT_HTTPHEADER => array(
        "key: ".$apikey->apiToken.""
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return  $err;
    } else {
      return $response;
    }
  }
}