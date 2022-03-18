<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_popup extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    function delete_ads($id)
    {
        $this->db->where('idpopup', $id);
        $this->db->delete('t_popup');
    }
}
