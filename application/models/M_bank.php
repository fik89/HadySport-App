<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_bank extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_bank()
    {
        return $this->db->get('t_bank');
    }

    function store_data_bank($data)
    {
        if (!empty($data['bankName']) || !empty($data['status']) || !empty($data['accountNumber'])) {
            $this->db->insert('t_bank', $data);
            $this->db->insert_id();
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Data Bank " . $data['bankName'] . "  Tersimpan'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
        } else {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Cek input data Anda'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        }
    }

    function update_data_bank($id, $data)
    {
        $this->db->where('idbank', $id);
        $this->db->update('t_bank', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item " . $data['bankName'] . "  Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function delete_bank($id)
    {
        $this->db->where('idbank', $id);
        $this->db->delete('t_bank');
    }

    function data_bank_by_id($id)
    {
        $this->db->select('*')
            ->where('idbank', $id);
        return $this->db->get('t_bank');
    }

    function data_bank_active()
    {
        $this->db->where('status', 'Active');
        return $this->db->get('t_bank');
    }
}
