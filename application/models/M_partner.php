<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_partner extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function store_partner($data)
    {
        if (!empty($data['partnerName']) && !empty($data['partnerRule']) && !empty($data['partnerStatus'])) {
            $this->db->insert('t_partner', $data);
            $this->db->insert_id();
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Partner " . $data['partnerName'] . "  Terdaftar'
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
        } else {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Cek input data Anda'
                    }, {
                    type: 'danger',
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
    }

    function data_partner_all()
    {
        return $this->db->get('t_partner');
    }

    function update_partner($id, $data)
    {
        $this->db->where('idpartner', $id);
        $this->db->update('t_partner', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Partner " . $id . "  Terupdate. status " . $data['partnerStatus'] . "'
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

    function delete_partner($id)
    {
        $this->db->where('idpartner', $id);
        $this->db->delete('t_partner');
    }

    function data_partner_ex_admin()
    {
        $this->db->select('*')
            ->where_not_in('partnerName', 'Admin');
        return $this->db->get('t_partner');
    }

    function data_partner_by_id($id)
    {
        $this->db->select("*")
            ->where('idpartner', $id);
        return $this->db->get('t_partner');
    }

    function count_new_partner()
    {
        $this->db->select('COUNT(iduser) as newpartner')
            ->where('invoicePartnerStatus', 'UNPAID');
        return $this->db->get('t_invoice_partner');
    }
}
