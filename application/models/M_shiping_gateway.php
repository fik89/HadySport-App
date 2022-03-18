<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_shiping_gateway extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_shiping_gateway()
    {
        return $this->db->get('t_shiping_gateway');
    }

    function data_shiping_gateway_by_name($name)
    {
        $this->db->select('*')
            ->from('t_shiping_gateway')
            ->where('shipingGatewayName', $name);
        return $this->db->get();
    }

    function update_shiping_gateway($id, $data)
    {
        $this->db->set($data)
            ->where('id', $id);
        $this->db->update('t_shiping_gateway');
        echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Update Sukses'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
    }
}
