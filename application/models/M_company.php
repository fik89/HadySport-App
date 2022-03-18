<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_company extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_company()
    {
        return $this->db->get('t_company');
    }

    function update_company($data)
    {
        $id = 1;
        $this->db->set($data)
            ->where('id', $id);
        $this->db->update('t_company');
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
