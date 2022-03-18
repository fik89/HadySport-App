<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daerah extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_daerah'));
        $this->load->database();
    }

    function listKab($id_prov) {
        $kab = $this->M_daerah->getKab($id_prov);
        echo "<option>Pilih Kabupaten / Kota</option>";
        foreach ($kab as $k) {
            echo "<option value='{$k->nama_kab}'>{$k->nama_kab}</option>";
        }
    }
    function listKabu($id_prov) {
        $kab = $this->M_daerah->getKab($id_prov);
        echo "<option>Pilih Kabupaten / Kota</option>";
        foreach ($kab as $k) {
            echo "<option value='{$k->id_kab}'>{$k->nama_kab}</option>";
        }
    }
    
     public function listKec($id_kec) {
        $kab = $this->M_daerah->getKec($id_kec);
        echo "<option disabled selected>Pilih Kecamatan</option>";
        foreach ($kab as $k) {
            echo "<option value='{$k->id_kec}'>{$k->nama}</option>";
        }
    }

    public function listKel($id_kel) {
        $kel = $this->M_daerah->getKel($id_kel);
        echo "<option disabled selected>Pilih Kelurahan</option>";
        foreach ($kel as $k) {
            echo "<option value='{$k->nama}'>{$k->nama}</option>";
        }
    }
}