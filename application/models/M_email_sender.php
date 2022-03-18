<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_email_sender extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function data_email_sender()
    {
        return $this->db->get('t_email_sender');
    }

    function update_email_sender($id, $data)
    {
        $this->db->set($data)
            ->where('id', $id);
        $this->db->update('t_email_sender');
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
