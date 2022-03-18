<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_statistic extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function store_statistic($data)
    {
        $this->db->insert('t_statistic', $data);
        $this->db->insert_id();
    }
}
