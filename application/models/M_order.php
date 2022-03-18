<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_order extends CI_Model
{
    var $column_order = array(null, 'idorder', 'iduser', 'ipaddress', 'orderDate', 'status', 'orderMethod', 'orderSumary', 'verifyBy', 'dateVerify');
    var $column_search = array('idorder', 'ipaddress', 'orderMethod', 'orderDate', 'orderSumary', 'status', 'iduser', 'verifyBy', 'dateVerify');
    var $order = array('orderDate' => 'desc');
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }

    function generate_id_order()
    {
        $this->db->select('RIGHT(t_order.idorder,5) as kode', FALSE);
        $this->db->order_by('idorder', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_order');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kode = "585758" . $kodemax;
        return $kode;
    }

    function store_cart($data)
    {
        return $this->db->insert_batch('t_order_detail', $data);
    }

    function store_shiping($data)
    {
        $this->db->insert('t_order_shiping', $data);
        return $this->db->insert_id();
    }

    function store_order($data)
    {
        $this->db->insert('t_order', $data);
        return $this->db->insert_id();
    }

    function data_order_by_id($id)
    { //relation all table
        $this->db->select('*')
            ->from('t_order')
            ->join('t_order_detail', 't_order_detail.idorder=t_order.idorder')
            ->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder')
            ->where('t_order.idorder', $id);
        return $this->db->get();
    }

    function data_order_shiping_by_id($id)
    {
        $this->db->select('*')
            ->from('t_order_shiping')
            ->where('idorder', $id);
        return $this->db->get();
    }

    function cek_order_id($id)
    {
        $this->db->where('idorder', $id);
        return $this->db->get('t_order');
    }

    function data_order_id($id)
    {
        $this->db->join('t_voucher', 't_order.idvoucher=t_voucher.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser=t_order.iduser', 'LEFT');
        $this->db->where('t_order.idorder', $id);
        return $this->db->get('t_order');
    }

    function data_order_id_check_out($id)
    {
        $this->db->select('*,t_order.idorder AS idorderorder');
        $this->db->join('t_voucher', 't_order.idvoucher=t_voucher.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser=t_order.iduser', 'LEFT');
        $this->db->join('t_invoice', 't_invoice.idorder=t_order.idorder', 'LEFT');
        $this->db->join('t_bank', 't_bank.idbank=t_order.idbank', 'LEFT');
        $this->db->where('t_order.idorder', $id);
        return $this->db->get('t_order');
    }

    function update_data_order_shiping($id, $data)
    {
        $this->db->where('idorder', $id);
        $this->db->update('t_order_shiping', $data);
        return "<script> $.notify({
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

    function update_data_order($id, $data)
    {
        $this->db->where('idorder', $id);
        $this->db->update('t_order', $data);
        return "<script> $.notify({
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

    function data_order_detail_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('t_product', 't_product.idproduct=t_order_detail.idproduct');
        $this->db->join('t_foto', 't_product.idupload=t_foto.idUpload');
        $this->db->where('idorder', $id);
        $this->db->where('fotoStatus', 1);
        return $this->db->get('t_order_detail');
    }

    function history_order($id)
    {
        $this->db->select('*, t_order_detail.idproduct AS idP');
        $this->db->join('t_order', 't_order.idorder=t_order_detail.idorder');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order_detail.idorder');
        $this->db->join('t_product', 't_product.idproduct=t_order_detail.idproduct');
        $this->db->join('t_foto', 't_product.idupload=t_foto.idUpload');
        $this->db->join('t_rating_product', 't_rating_product.idproduct=t_order_detail.idproduct', 'LEFT');
        $this->db->where('t_order_detail.idorder', $id);
        $this->db->where('fotoStatus', 1);
        return $this->db->get('t_order_detail');
    }

    function delete_data_order_detail($id)
    {
        $this->db->where('idorder', $id);
        $this->db->delete('t_order_detail');
    }

    function update_data_order_detail($id, $data)
    { //update an array
        $datadetail = $this->data_order_detail_by_id($id)->result();
        $i = 0;
        $NewArray = array();
        foreach ($datadetail as $value) {
            $NewArray[] = array_merge(array("idorderDetail" => $value->idorderDetail), $data[$i]);
            $i++;
        }
        $this->db->update_batch('t_order_deail', $NewArray, 'idorderDetail');
    }

    function data_order_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->get('t_order');
    }

    function data_order()
    {
        $this->db->select('*')
            ->from('t_order')
            ->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        return $this->db->get();
    }

    function data_detail_order_product($idorder)
    {
        $this->db->select('*')
            ->join('t_product', 't_product.idproduct=t_order_detail.idproduct')
            ->where('t_order_detail.idorder', $idorder);
        return $this->db->get('t_order_detail');
    }

    function data_order_shiping()
    {
        return $this->db->get('t_order_shiping');
    }

    function data_order_shiping_by_date($startdate, $enddate)
    {
        $this->db->select('*')
            ->where('dateCreate >=', $startdate)
            ->where('dateCreate <=', $enddate);
        return $this->db->get('t_order_shiping');
    }

    function count_new_order()
    {
        $this->db->select('COUNT(idorder) as neworder')
            ->where('status', 'closing paid');
        return $this->db->get('t_order');
    }

    function count_wishlist()
    {
        $this->db->select('COUNT(idproduct) as wishlist');
        return $this->db->get('t_wishlist');
    }

    function countshoping()
    {
        $this->db->select('SUM(orderSumary) as countshoping');
        $this->db->where('status', 'process shiping');
        return $this->db->get('t_order');
    }

    function delete_all_data_order($id)
    {
        $table = array('t_order', 't_order_detail', 't_order_shiping', 't_invoice');
        $this->db->where('idorder', $id);
        $this->db->delete($table);
    }

    function data_order_iduser($id)
    {
        $this->db->select('*');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        $this->db->where('t_order.iduser', $id);
        return $this->db->get('t_order');
    }

    function cek_order_not_finish($initial, $id)
    {
        $status = array('add to cart', 'insert data customer', 'insert shiping', 'payment method', 'closing unpaid', 'place order');
        if ($initial == 'id') {
            $this->db->where('iduser', $id);
        } else if ($initial == 'ip') {
            $this->db->where('ipaddress', $id);
        }
        $this->db->where_in('status', $status);
        return $this->db->get('t_order');
    }

    function update_data_order_detail_by_id($idorder, $idproduct, $data)
    {
        $this->db->where('idorder', $idorder);
        $this->db->where('idproduct', $idproduct);
        $this->db->update('t_order_detail', $data);
    }

    /**
     * Get data order  
     * Admin
     * */
    function _get_datatables_order()
    {

        if ($this->input->post('tglawal') && $this->input->post('tglakhir')) {
            $this->db->where('retur_date >=', $this->input->post('tglawal'));
            $this->db->where('retur_date <=', $this->input->post('tglakhir'));
        } else if ($this->input->post('statusorder')) {
            $this->db->where('status', $this->input->post('statusorder'));
        } else if ($this->input->post('ordermethod')) {
            $this->db->where('orderMethod', $this->input->post('ordermethod'));
        }

        $this->db->select('*');
        $this->db->from('t_order');
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

    function get_datatables_order()
    {
        $this->_get_datatables_order();
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
        $this->_get_datatables_order();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('t_product_retur');
        return $this->db->count_all_results();
    }
}
