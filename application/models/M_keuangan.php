<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_keuangan extends CI_Model
{

    var $column_order = array(null, 'idorder', 'price', 'date_create', 'type', 'keterangan', 'iduser');
    var $column_search = array('idorder', 'price', 'date_create', 'type', 'keterangan', 'iduser');
    var $order = array('date_create' => 'desc');

    var $column_order_penjualan = array(null, 'idorder', 'productName', 'productQty', 'productPrice', 'subtotalPrice', 'firstName', 'fullAddress', 'orderDate', 'status');
    var $column_search_penjualan = array('idorder', 'productName', 'productQty', 'productPrice', 'subtotalPrice', 'firstName', 'fullAddress', 'orderDate', 'status');
    var $order_penjualan = array('orderDate' => 'desc');

    function __construct()
    {
        parent::__construct();
    }

    function store_keuangan($data)
    {
        $this->db->insert('t_keuangan', $data);
        $this->db->insert_id();
    }

    function update_keuangan_idretur($id, $data)
    {
        $this->db->where('idretur', $id);
        $this->db->update('t_keuangan', $data);
    }


    function delete_data_keuangan_idretur($id)
    {
        $this->db->where('idretur', $id);
        $this->db->delete('t_keuangan');
    }

    function delete_keuangan($id)
    {
        $this->db->where('idtransaksi', $id);
        $this->db->delete('t_keuangan');
    }

    /**
     * Get data transaksi Offline / input admin 
     * Admin
     * */
    function _get_datatables_keuangan()
    {

        if ($this->input->post('tglawal') && $this->input->post('tglakhir')) {
            $this->db->where('date_create >=', $this->input->post('tglawal'));
            $this->db->where('date_create <=', $this->input->post('tglakhir'));
        } else if ($this->input->post('type')) {
            $this->db->where('type', $this->input->post('type'));
        }

        $this->db->select('*');
        $this->db->from('t_keuangan');
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

    function get_datatables_keuangan()
    {
        $this->_get_datatables_keuangan();
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
        $this->_get_datatables_keuangan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('t_order');
        return $this->db->count_all_results();
    }

    function statistik_harian()
    {
        $str = "'";
        $bulan = date('m');
        $periode = date_ind(date('Y-m-d'));
        $this->db->select('DAY(date_create) AS dayto, SUM(price) AS price, type');
        $this->db->where("DATE_FORMAT(date_create,'%m')", $bulan);
        $this->db->group_by("DAY(date_create)");
        $this->db->order_by("DAY(date_create)", "ASC");
        $query = $this->db->get('t_keuangan');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $data1['periode'] = $periode;
                $data1['day'] = $data->dayto;
                if ($data->type == 'debet offline') {
                    $data1['type'] = $data->type;
                    $data1['priceoffline'] = intval($data->price);
                    $data1['priceonline'] = null;
                } else {
                    $data1['type'] = $data->type;
                    $data1['priceoffline'] = null;
                    $data1['priceonline'] = intval($data->price);
                }

                $hasil[] = $data1;
            }

            return $hasil;
        }
    }

    function statistik_bulanan()
    {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT SUM(price) AS price FROM t_keuangan WHERE LEFT(date_create, 7)='" . $date . "'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function statistik_bulanan_online()
    {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT SUM(price) AS price FROM t_keuangan WHERE LEFT(date_create, 7)='" . $date . "' AND type='debet online'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function statistik_bulanan_offline()
    {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT SUM(price) AS price FROM t_keuangan WHERE LEFT(date_create, 7)='" . $date . "' AND type='debet offline' ");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }
    /**
     * Get data penjualan 
     * Admin
     * */
    function _get_datatables_penjualan()
    {

        if ($this->input->post('tglawal') && $this->input->post('tglakhir')) {
            $this->db->where('orderDate >=', $this->input->post('tglawal'));
            $this->db->where('orderDate <=', $this->input->post('tglakhir'));
        } else if ($this->input->post('status')) {
            $this->db->where('status', $this->input->post('status'));
        }

        $this->db->select('*');
        $this->db->from('t_order_detail');
        $this->db->join('t_order', 't_order_detail.idorder=t_order.idorder');
        $this->db->join('t_voucher', 't_voucher.idvoucher = t_order.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser = t_order.iduser', 'LEFT');
        $this->db->join('t_partner', 't_user.tipeuser = t_partner.idpartner', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        $i = 0;

        foreach ($this->column_search_penjualan as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_penjualan) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_penjualan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_penjualan)) {
            $order = $this->order_penjualan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_penjualan()
    {
        $this->_get_datatables_penjualan();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Count Data
     */
    function count_filtered_penjualan()
    {
        $this->_get_datatables_penjualan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_penjualan()
    {
        $this->db->from('t_order_detail');
        return $this->db->count_all_results();
    }

    function data_penjualan()
    {
        $this->db->select('*');
        $this->db->from('t_order_detail');
        $this->db->join('t_order', 't_order_detail.idorder=t_order.idorder');
        $this->db->join('t_voucher', 't_voucher.idvoucher = t_order.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser = t_order.iduser', 'LEFT');
        $this->db->join('t_partner', 't_user.tipeuser = t_partner.idpartner', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        return $this->db->get();
    }

    function data_penjualan_bydate($start, $end)
    {
        $this->db->select('*');
        $this->db->from('t_order_detail');
        $this->db->join('t_order', 't_order_detail.idorder=t_order.idorder');
        $this->db->join('t_voucher', 't_voucher.idvoucher = t_order.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser = t_order.iduser', 'LEFT');
        $this->db->join('t_partner', 't_user.tipeuser = t_partner.idpartner', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        $this->db->where('orderDate >=', $start);
        $this->db->where('orderDate <=', $end);
        return $this->db->get();
    }

    function data_penjualan_status($status)
    {
        $this->db->select('*');
        $this->db->from('t_order_detail');
        $this->db->join('t_order', 't_order_detail.idorder=t_order.idorder');
        $this->db->join('t_voucher', 't_voucher.idvoucher = t_order.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser = t_order.iduser', 'LEFT');
        $this->db->join('t_partner', 't_user.tipeuser = t_partner.idpartner', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        return $this->db->get();
    }

    function data_penjualan_bydate_status($start, $end, $status)
    {
        $this->db->select('*');
        $this->db->from('t_order_detail');
        $this->db->join('t_order', 't_order_detail.idorder=t_order.idorder');
        $this->db->join('t_voucher', 't_voucher.idvoucher = t_order.idvoucher', 'LEFT');
        $this->db->join('t_user', 't_user.iduser = t_order.iduser', 'LEFT');
        $this->db->join('t_partner', 't_user.tipeuser = t_partner.idpartner', 'LEFT');
        $this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        $this->db->where('orderDate >=', $start);
        $this->db->where('orderDate <=', $end);
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        return $this->db->get();
    }

    function data_keuangan()
    {
        $this->db->select('*');
        $this->db->from('t_keuangan');
        return $this->db->get();
    }

    function data_keuangan_bydate($start, $end)
    {
        $this->db->select('*');
        $this->db->from('t_keuangan');
        $this->db->where('date_create >=', $start);
        $this->db->where('date_create <=', $end);
        return $this->db->get();
    }
}
