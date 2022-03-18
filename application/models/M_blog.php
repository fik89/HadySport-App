<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_blog extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function idblog()
    {
        $this->db->select('RIGHT(t_blog_post.idblogpost,4) as kode', FALSE);
        $this->db->order_by('idblogpost', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_blog_post');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kode = "post" . $kodemax;
        return $kode;
    }

    function data_kategori()
    {
        return $this->db->get('t_blog_category');
    }

    function kategori_by_name($name)
    {
        $this->db->where('blog_category_name', $name);
        return $this->db->get('t_blog_category');
    }

    function kategori_by_id($id)
    {
        $this->db->where('idblogcategory', $id);
        return $this->db->get('t_blog_category');
    }

    function simpan_kategori($data)
    {
        $this->db->insert('t_blog_category', $data);
        $this->db->insert_id();
    }
    function unggah_blog_save($data)
    {
        $this->db->insert('t_blog_post', $data);
        $this->db->insert_id();
    }

    function hapus_kategori($id)
    {
        $this->db->where('idblogcategory', $id);
        $this->db->delete('t_blog_category');
    }

    function simpan_edit_kategori($id, $data)
    {
        $this->db->set($data)
            ->where('idblogcategory', $id);
        $this->db->update('t_blog_category');
    }

    function data_blog()
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->join('t_user', 't_user.iduser=t_blog_post.post_by');
        $this->db->order_by('post_date', 'DESC');
        return $this->db->get('t_blog_post');
    }

    function data_blog_slug($post_slug)
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->join('t_user', 't_user.iduser=t_blog_post.post_by');
        $this->db->where('post_blog_slug', $post_slug);
        return $this->db->get('t_blog_post');
    }

    function jumlah_data_blog()
    {
        return $this->db->get('t_blog_post')->num_rows();
    }

    function jumlah_data_blog_category($idblogcategory)
    {
        $this->db->where('idblogcategory', $idblogcategory);
        return $this->db->get('t_blog_post')->num_rows();
    }

    function data_blog_pagination($number, $offset)
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->join('t_user', 't_user.iduser=t_blog_post.post_by');
        $this->db->order_by('post_date', 'DESC');
        return $query = $this->db->get('t_blog_post', $number, $offset)->result();
    }

    function data_blog_pagination_category($number, $offset, $idblogcategory)
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->join('t_user', 't_user.iduser=t_blog_post.post_by');
        $this->db->where('t_blog_category.idblogcategory', $idblogcategory);
        $this->db->order_by('post_date', 'DESC');
        return $query = $this->db->get('t_blog_post', $number, $offset)->result();
    }

    function data_blog_id($id)
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->where('idblogpost', $id);
        return $this->db->get('t_blog_post');
    }

    function update_blog_save($id, $data)
    {
        $this->db->set($data)
            ->where('idblogpost', $id);
        $this->db->update('t_blog_post');
    }

    function hapus_blog($id)
    {
        $this->db->where('idblogpost', $id);
        $this->db->delete('t_blog_post');
    }

    function jumlah_data_blog_search($search)
    {
        $this->db->like('blog_title', $search);
        return $this->db->get('t_blog_post')->num_rows();
    }

    function data_blog_search($number, $offset, $search)
    {
        $this->db->join('t_blog_category', 't_blog_post.idblogcategory=t_blog_category.idblogcategory');
        $this->db->join('t_user', 't_user.iduser=t_blog_post.post_by');
        $this->db->like('blog_title', $search);
        $this->db->order_by('post_date', 'DESC');
        return $query = $this->db->get('t_blog_post', $number, $offset)->result();
    }
}
