<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_cod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_settingcod()
    {
        return $this->db->get('t_cod');
    }


    function store_footer_tagline($data)
    {
        $this->db->insert('t_footer_tagline', $data);

        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item Terimpan'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
        return $this->db->insert_id();
    }

    function delete_cod($id)
    {
        $cek = $this->db->query("SELECT * from t_cod where idcod='" . $id . "'");
        if (($cek->num_rows()) > 0) {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Anda tidak Dapat Menghapus Lokasi COD'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        } else {
            $this->db->where('idcod', $id);
            $this->db->delete('t_cod');
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Lokasi COD Terhapus'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
        }
    }

    function count_footer_tagline()
    {
        $this->db->select('COUNT(id) as id');
        return $this->db->get('t_footer_tagline');
    }
}
