<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_marketing extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_product_sale()
    {
        $this->db->select('*')
            ->from('t_product_sale')
            ->join('t_product', 't_product.idproduct=t_product_sale.idproduct');
        return $this->db->get();
    }

    function data_product_sale_by_id($id)
    {
        $this->db->select('*')
            ->from('t_product_sale')
            ->where('idproduct', $id);
        return $this->db->get();
    }

    function store_sale_product($data)
    {
        if (empty($data['pricesale']) || empty($data['startDate']) || empty($data['endDate'])) {
            echo "<script> $.notify({
                title: '<strong>Gagal <br></strong>',
                message: 'Input semua data'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        } else {
            if ($data['startDate'] > $data['endDate']) {
                echo "<script> $.notify({
                title: '<strong>Gagal <br></strong>',
                message: 'Tanggal mulai lebih besar dari tanggal Awal diskon'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
            } else {
                $this->db->insert('t_product_sale', $data);
                $this->db->insert_id();
                echo "<script> $.notify({
                title: '<strong>Sukses <br></strong>',
                message: 'update " . $data['idproduct'] . "  Tersimpan'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
            }
        }
    }

    function update_product_sale($id, $data)
    {
        $this->db->where('idproductsale', $id);
        $this->db->update('t_product_sale', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item " . $id . "  Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function delete_product_sale($id)
    {
        $this->db->where('idproductsale', $id);
        $this->db->delete('t_product_sale');
    }
}
