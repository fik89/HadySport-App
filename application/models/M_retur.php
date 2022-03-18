<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_retur extends CI_Model
{
    var $column_order = array(null, 'idretur', 'comment_retur', 'qty_retur', 'img_product_retur', 'retur_date', 'comment_reply', 'date_confirm', 'retur_status', 'idproduct_retur', 'idorder_retur', 'iduser_submit');
    var $column_search = array('idretur', 'comment_retur', 'qty_retur', 'img_product_retur', 'retur_date', 'comment_reply', 'date_confirm', 'retur_status', 'idproduct_retur', 'idorder_retur', 'iduser_submit');
    var $order = array('retur_date' => 'desc');
    function __construct()
    {
        parent::__construct();
    }

    function generate_id()
    {
        $this->db->select('RIGHT(t_product_retur.idretur,4) as kode', FALSE);
        $this->db->order_by('idretur', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_product_retur');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kode = "R-58" . $kodemax;
        return $kode;
    }

    function submit_retur($data)
    {
        $this->db->insert('t_product_retur', $data);
        return $this->db->insert_id();
    }

    function retur_by_id($id)
    {
        $this->db->select('*, t_order_shiping.rt AS rtshiping, t_order_shiping.rw AS rwshiping, t_order_shiping.desa AS desashiping, t_order_shiping.namaKabupaten AS kabupatenshiping, t_order_shiping.namaProvinsi AS provinsishiping, t_order_shiping.kecamatan AS kecamatanshiping');
        $this->db->join('t_order', 't_order.idorder=t_product_retur.idorder_retur');
        $this->db->join('t_order_detail', 't_order_detail.idorder=t_product_retur.idorder_retur');
        $this->db->join('t_product', 't_product.idproduct=t_product_retur.idproduct_retur', 'LEFT');
        $this->db->join('t_product_sale', 't_product_sale.idproduct=t_product_retur.idproduct_retur', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_product_retur.idorder_retur', 'LEFT');
        $this->db->join('t_invoice', 't_invoice.idorder=t_product_retur.idorder_retur', 'LEFT');
        $this->db->join('t_user', 't_user.iduser=t_product_retur.iduser_submit', 'LEFT');
        $this->db->where('t_product_retur.idretur', $id);
        return $this->db->get('t_product_retur');
    }

    function update_retur_id($id, $data)
    {
        $this->db->where('idretur', $id);
        $this->db->update('t_product_retur', $data);
    }

    function delete_data_retur($id)
    {
        $this->db->where('idretur', $id);
        $this->db->delete('t_product_retur');
    }


    /**
     * Get data transaksi Offline / input admin 
     * Admin
     * */
    function _get_datatables_retur()
    {

        if ($this->input->post('tglawal') && $this->input->post('tglakhir')) {
            $this->db->where('retur_date >=', $this->input->post('tglawal'));
            $this->db->where('retur_date <=', $this->input->post('tglakhir'));
        } else if ($this->input->post('status')) {
            $this->db->where('retur_status', $this->input->post('status'));
        }

        $this->db->select('*');
        $this->db->from('t_product_retur');
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_retur()
    {
        $this->_get_datatables_retur();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Count Data
     */
    function count_filtered()
    {
        $this->_get_datatables_retur();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('t_product_retur');
        return $this->db->count_all_results();
    }
}
