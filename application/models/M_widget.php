<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_widget extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function data_widget_by_name($name)
    {
        $this->db->select('*')
            ->from('t_widget')
            ->where('widgetName', $name);
        return $this->db->get();
    }

    function data_widget_by_id($id)
    {
        $this->db->select('*')
            ->from('t_widget')
            ->where('id', $id);
        return $this->db->get();
    }

    function update_data_widget($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('t_widget', $data);
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

    function data_widget_by_name_active($name)
    {
        $this->db->select('*')
            ->from('t_widget')
            ->where('widgetName', $name)
            ->where('widgetStatus', 'Active');
        return $this->db->get();
    }
}
