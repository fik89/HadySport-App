<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_user extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function id_user()
    {
        $this->db->select('RIGHT(t_user.iduser,4) as kode', FALSE);
        $this->db->order_by('iduser', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_user');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeuser = "usr5588" . $kodemax;
        return $kodeuser;
    }

    function cek_email($email)
    {
        $this->db->select('*')
            ->where('useremail', $email);
        return $this->db->get('t_user');
    }

    function cek_user($email, $pass)
    {
        $this->db->join('t_partner', 't_partner.idpartner=t_user.tipeuser', 'LEFT');
        $this->db->where('useremail', $email);
        $this->db->where('password', $pass);
        return $this->db->get('t_user');
    }

    function store_user($data)
    {
        $this->db->insert('t_user', $data);
        $this->db->insert_id();
    }

    function data_user_all()
    {
        $this->db->select('*')
            ->join('t_partner', 't_partner.idpartner=t_user.tipeuser', 'LEFT');
        return $this->db->get('t_user');
    }

    function update_user($id, $data)
    {
        $this->db->where('iduser', $id);
        $this->db->update('t_user', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Member " . $id . "  Terupdate'
                }, {
                type: 'success',
                animate: {
                enter: 'animated fadeInUp',
                exit: 'animated fadeOutRight'
                },
                placement: {
                from: 'top',
                align: 'right'
                },
                offset: 20,
                delay: 3000,
                timer: 500,
                spacing: 10,
                z_index: 1031,
                });
                </script>";
    }

    function delete_user($id)
    {
        $this->db->where('iduser', $id);
        $this->db->delete('t_user');
    }

    function user_by_id($id)
    {
        $this->db->select('*')
            ->join('t_partner', 't_partner.idpartner=t_user.tipeuser', 'LEFT')
            ->where('iduser', $id);
        return $this->db->get('t_user');
    }

    function activation_user($id, $data)
    {
        $this->db->where('iduser', $id);
        $this->db->update('t_user', $data);
    }

    function update_user_id($id, $data)
    {
        $this->db->where('iduser', $id);
        $this->db->update('t_user', $data);
    }
}
