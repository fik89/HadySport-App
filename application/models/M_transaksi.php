<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_transaksi extends CI_Model
{

	var $column_order = array(null, 't_order.idorder', 'firstName', 'lastName', 'orderSumary', 'orderDate');
	var $column_search_order = array('t_order_shiping.idorder', 'orderDate', 'tax', 'discountPrice', 'orderSumary', 'cartTotal', 'status', 'totalShiping');
	var $order_order = array('orderDate' => 'desc');

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get data transaksi Offline / input admin 
	 * Admin
	 * */
	function _get_datatables_transaksi_offline()
	{

		if ($this->input->post('orderMethod')) {
			$this->db->where('t_order.orderMethod', $this->input->post('orderMethod'));
		}
		$this->db->select('*');
		$this->db->from('t_order');
		$this->db->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder', 'LEFT');
		$i = 0;

		foreach ($this->column_search_order as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search_order) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_order)) {
			$order_order = $this->order_order;
			$this->db->order_by(key($order_order), $order_order[key($order_order)]);
		}
	}

	function get_datatables_transaksi_offline()
	{
		$this->_get_datatables_transaksi_offline();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Count Data
	 */
	function count_user_status($status)
	{
		$this->db->select('COUNT(iduser) as countuser');
		$this->db->where('user_status', $status);
		return $this->db->get('t_user');
	}

	function count_filtered()
	{
		$this->_get_datatables_transaksi_offline();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('t_order');
		return $this->db->count_all_results();
	}
}
