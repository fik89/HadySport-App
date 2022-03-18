<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_rating extends CI_Model
{
    var $column_order = array(null, 'fotoName', 'productName', 'ratingProduct', 'comment', 'username', 'date_create');
    var $column_search = array('fotoName', 'productName', 'ratingProduct', 'comment', 'username', 'date_create');
    var $order = array('date_create' => 'desc');

    function __construct()
    {
        parent::__construct();
    }

    function rating_product_id($id, $user)
    {
        $this->db->where('idproduct', $id);
        $this->db->where('volunteerProduct', $user);
        return $this->db->get('t_rating_product');
    }

    function rating_idproduct($idproduct)
    {
        $this->db->where('idproduct', $idproduct);
        return $this->db->get('t_rating_product');
    }

    function sum_rating_idproduct($idproduct)
    {
        $this->db->select_sum('ratingProduct');
        $this->db->where('idproduct', $idproduct);
        return $this->db->get('t_rating_product');
    }

    function sum_row_volunteer_idproduct($idproduct)
    {
        $this->db->where('idproduct', $idproduct);
        return $this->db->get('t_rating_product');
    }

    function submit_rating($data)
    {
        #cek data rating to update first
        #insert rating t_rating_product
        $cek_rating = $this->rating_product_id($data['idproduct'], $data['volunteerProduct'])->row();
        if (!empty($cek_rating->idratingproduct)) {
            #do update
            $data_to_rating = array(
                'idproduct' => $data['idproduct'],
                'comment' => $data['comment'],
                'ratingProduct' => $data['ratingProduct'],
                'volunteerProduct' => $data['volunteerProduct']
            );
            $this->db->set($data_to_rating)
                ->where('idratingproduct', $cek_rating->idratingproduct);
            $this->db->update('t_rating_product');
        } else {
            $data_to_rating = array(
                'idproduct' => $data['idproduct'],
                'comment' => $data['comment'],
                'ratingProduct' => $data['ratingProduct'],
                'volunteerProduct' => $data['volunteerProduct']
            );
            #insert t_rating_product
            $this->db->insert('t_rating_product', $data_to_rating);
            $this->db->insert_id();
            #update_t_product_detail_user_was_give_rating
            $data_order_detail = array(
                'submitRating' => 'OK'
            );
            $this->db->set($data_order_detail)
                ->where('idorder', $data['idorder'])
                ->where('idproduct', $data['idproduct']);
            $this->db->update('t_order_detail');
        }

        #collect data rating
        $data_rating = $this->sum_rating_idproduct($data['idproduct'])->row()->ratingProduct;
        $data_volunteer = $this->sum_row_volunteer_idproduct($data['idproduct'])->num_rows();
        $average_rating = $data_rating / $data_volunteer;
        $data_product = array(
            'rating' => $average_rating,
            'volunteer' => $data_volunteer,
        );
        #update t_product
        $this->db->set($data_product)
            ->where('idproduct', $data['idproduct']);
        $this->db->update('t_product');
        $return['status'] = 1;
        $return['message'] = "Success";
        return $return;
    }

    function data_rating_detail_product($id)
    {
        $this->db->join('t_user', 't_user.iduser=t_rating_product.volunteerProduct');
        $this->db->where('idproduct', $id);
        $this->db->limit(5);
        $this->db->order_by('date_create', 'DESC');
        return $this->db->get('t_rating_product');
    }

    function data_all_rating()
    {
        $this->db->join('t_product', 't_product.idproduct=t_rating_product.idproduct');
        $this->db->join('t_foto', 't_product.idupload=t_foto.idUpload');
        $this->db->where('fotoStatus', 1);
        $this->db->join('t_user', 't_user.iduser=t_rating_product.volunteerProduct');
        $this->db->order_by('date_create', 'DESC');
        return $this->db->get('t_rating_product');
    }

    function delete_ulasan($id)
    {
        $this->db->where('idratingproduct', $id);
        $this->db->delete('t_rating_product');
    }

    /**
     * Get data rating 
     * Admin
     * */
    function _get_datatables_rating()
    {

        //        if ($this->input->post('tglawal') && $this->input->post('tglakhir')) {
        //            $this->db->where('retur_date >=', $this->input->post('tglawal'));
        //            $this->db->where('retur_date <=', $this->input->post('tglakhir'));
        //        } else if ($this->input->post('status')) {
        //            $this->db->where('retur_status', $this->input->post('status'));
        //        }

        $this->db->select('*');
        $this->db->from('t_rating_product');
        $this->db->join('t_product', 't_product.idproduct=t_rating_product.idproduct');
        $this->db->join('t_foto', 't_foto.idUpload=t_product.idupload');
        $this->db->join('t_user', 't_user.iduser=t_product.uploadBy');
        $this->db->where('fotoStatus', 1);
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

    function get_datatables_rating()
    {
        $this->_get_datatables_rating();
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
        $this->_get_datatables_rating();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('t_rating_product');
        return $this->db->count_all_results();
    }
}
