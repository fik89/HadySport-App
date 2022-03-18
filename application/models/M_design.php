<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_design extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function upload_img($data)
    {
        $this->db->insert('t_banner_image', $data);
        return $this->db->insert_id();
    }

    function data_banner_all()
    {
        return $this->db->get('t_banner_image');
    }

    function update_status_banner($id, $data)
    {
        $this->db->where('idbannerimage', $id);
        $this->db->update('t_banner_image', $data);
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

    function delete_banner($id)
    {
        $this->db->where('idbannerimage', $id);
        $this->db->delete('t_banner_image');
    }

    function delete_popup($id)
    {
        $this->db->where('idpopup', $id);
        $this->db->delete('t_popup');
    }

    function banner_by_id($id)
    {
        $this->db->select("*")
            ->where('idbannerimage', $id);
        return $this->db->get('t_banner_image');
    }

    function data_banner_by_id($id)
    {
        $this->db->select('*')
            ->from('t_banner_image')
            ->where('idbannerimage', $id);
        return $this->db->get();
    }

    function data_popup_by_id($id)
    {
        $this->db->select('*')
            ->from('t_popup')
            ->where('idpopup', $id);
        return $this->db->get();
    }

    function data_banner_by_type($pos, $sort)
    {
        $this->db->select('*')
            ->from('t_banner_image')
            ->where('bannerPosition', $pos)
            ->where('sortOrder', $sort);
        return $this->db->get();
    }

    function data_banner_by_pos($pos)
    {
        $this->db->select('*')
            ->from('t_banner_image')
            ->where('bannerPosition', $pos)
            ->where('status', 'active')
            ->order_by('sortOrder', 'DSC');
        return $this->db->get();
    }

    function data_pop_up()
    {
        return $this->db->get('t_popup');
    }

    function store_popup($data)
    {
        if (!empty($data['popupType'])) {
            $this->db->insert('t_popup', $data);
            $this->db->insert_id();
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Sukses Script " . $data['typeDescription'] . "  Tersimpan'
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

    function update_data_popup($id, $data)
    {
        $this->db->where('idpopup', $id);
        $this->db->update('t_popup', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function data_popup_by_status($status)
    {
        $this->db->select('*')
            ->where('popupStatus', $status);
        return $this->db->get('t_popup');
    }

    function data_footer_tagline()
    {
        return $this->db->get('t_footer_tagline');
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

    function delete_footer_tagline($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('t_footer_tagline');
    }

    function count_footer_tagline()
    {
        $this->db->select('COUNT(id) as id');
        return $this->db->get('t_footer_tagline');
    }

    function data_settingcod()
    {
        return $this->db->get('t_cod');
    }
}
