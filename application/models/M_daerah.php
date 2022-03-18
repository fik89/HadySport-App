<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');
class M_daerah extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }

    public function getProv()
    {
        $this->db->select('*')
            ->from('provinsi')
            ->order_by('nama', 'ASC');
        return $this->db->get();
    }

    public function getKabList()
    {
        $this->db->select('*')
            ->from('kabupaten')
            ->order_by('nama_kab', 'ASC');
        return $this->db->get();
    }

    public function getKab($id_prov)
    {
        $this->db->select('*')
            ->where('id_prov_fk', $id_prov)
            ->order_by('nama_kab', 'ASC');
        return $this->db->get('kabupaten')->result();
    }

    public function getKec($id_kab)
    {
        $this->db->select('*')
            ->where('id_kab', $id_kab)
            ->order_by('nama', 'ASC');
        return $this->db->get('kecamatan')->result();
    }

    public function getKel($id_kec)
    {
        $this->db->select('*')
            ->where('id_kec', $id_kec)
            ->order_by('nama', 'ASC');
        return $this->db->get('kelurahan')->result();
    }

    public function getNamaProv($id_prov)
    {
        $sql = "SELECT nama FROM provinsi WHERE id_prov='$id_prov'";
        $query = $this->db->query($sql);

        return $query;
    }

    public function getNamaKab($id_kab)
    {
        $sql = "SELECT nama_kab FROM kabupaten WHERE id_kab='$id_kab'";
        $query = $this->db->query($sql);

        return $query;
    }

    public function getNamaKec($id_kec)
    {
        $sql = "SELECT nama FROM kecamatan WHERE id_kec='$id_kec'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getNamaKel($id_kel)
    {
        $sql = "SELECT nama FROM kelurahan WHERE id_kec='$id_kel'";
        $query = $this->db->query($sql);
        return $query;
    }
}
