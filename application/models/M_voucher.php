<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_voucher extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_voucher()
    {
        return $this->db->get('t_voucher');
    }

    function store_voucher($data)
    {
        if (!empty($data['voucherName']) || !empty($data['voucherCode']) || !empty($data['voucherPrice'])) {
            $this->db->insert('t_voucher', $data);
            $this->db->insert_id();
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Data Voucher " . $data['voucherName'] . "  Tersimpan'
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

    function update_voucher($id, $data)
    {
        $this->db->where('idvoucher', $id);
        $this->db->update('t_voucher', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item  Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function delete_voucher($id)
    {
        $this->db->where('idvoucher', $id);
        $this->db->delete('t_voucher');
    }

    function get_voucher_by_code($code)
    {
        $this->db->select('*')
            ->where('voucherCode', $code);
        return $this->db->get('t_voucher');
    }

    function voucher_id($id)
    {
        $this->db->where('idvoucher', $id);
        return $this->db->get('t_voucher');
    }
}
