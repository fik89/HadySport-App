<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_category'));
        $this->load->database();
    }

    function f_category() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['category'] = $this->M_category->get_select_category(0, "");
            $this->load->view('dashboard/category/f_input_category', $data);
        }
    }

    function store_category() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idcategory = $this->input->post('parent');
            $cekparent = $this->M_category->data_category_by_id($idcategory)->row();
            if (empty($cekparent) || $cekparent->idparent == 0) {
                $catname = $this->input->post('categoryname');
                $fixlink = str_replace(" ", "-", $catname);
                $link = strtolower($fixlink);
            } else {
                $dataparent = $this->M_category->data_category_by_id($cekparent->idcategory)->row();
                $catname = $this->input->post('categoryname');
                $prelink = "$dataparent->categoryName-$catname";
                $fixlink = str_replace(" ", "-", $prelink);
                $link = strtolower($fixlink);
            }
            $data = array(
                'categoryName' => $catname,
                'idparent' => $this->input->post('parent'),
                'categoryDescription' => $this->input->post('categorydesc'),
                'categoryLink' => "$link.html",
                'categoryMetaTag' => $this->input->post('metatagtitle'),
                'categoryMetaDescription' => $this->input->post('metatagdesc'),
                'categoryStatus' => $this->input->post('status')
            );
            $this->M_category->store_category($data);
        }
    }

    function subcategory_by($idcat) {
        $sub = $this->M_category->get_sub_by($idcat);
        if (empty($sub)) {
            echo "<option disable='' selected=''>Subsubkategori Kosong</option>";
        } else {
            echo "<option>Pilih Subkategori</option>";
            foreach ($sub as $k) {
                echo "<option value='{$k->idsubcategory}'>{$k->subcategoryName}</option>";
            }
        }
    }

    function data_category() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['category'] = $this->M_category->get_list_category(0, "");
            $this->load->view('dashboard/category/data_category', $data);
        }
    }

    function menu() {
        echo $this->cat1(0, "");
    }

    function tree_menu_home($parent = 0, $hasil) {
        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($w->num_rows()) > 0) {
            $hasil .= "<ul>";
        }
        foreach ($w->result() as $h) {

            $hasil .= "<li>" . $h->categoryName;
            $hasil = $this->tree_menu_m($h->idcategory, $hasil);
            $hasil .= "</li>";
        }
        if (($w->num_rows) > 0) {
            $hasil .= "</ul>";
        }
        return $hasil;
    }

    function delete_category() {
        $this->M_category->delete_category($this->input->post('idcategory'));
    }

    function f_update_category() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idcategory = $this->input->post('id');
            $data['data'] = $this->M_category->data_category_by_id($idcategory)->row();
            $data['dataparent'] = $this->M_category->data_parent_by_id($idcategory);
            $data['category'] = $this->M_category->get_select_category(0, "");
            $this->load->view('dashboard/category/f_update_category', $data);
        }
    }

    function update_category() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idcategory = $this->input->post('idcategory');
            $cekparent = $this->M_category->data_category_by_id($idcategory)->row();
            if ($cekparent->idparent == 0) {
                $catname = $this->input->post('categoryname');
                $fixlink = str_replace(" ", "-", $catname);
                $link = strtolower($fixlink);
            } else {
                $dataparent = $this->M_category->data_category_by_id($cekparent->idparent)->row();
                $catname = $this->input->post('categoryname');
                $prelink = "$dataparent->categoryName-$catname";
                $fixlink = str_replace(" ", "-", $prelink);
                $link = strtolower($fixlink);
            }
            $data = array(
                'categoryName' => $catname,
                'idparent' => $this->input->post('parent'),
                'categoryDescription' => $this->input->post('categorydesc'),
                'categoryLink' => "$link.html",
                'categoryMetaTag' => $this->input->post('metatagtitle'),
                'categoryMetaDescription' => $this->input->post('metatagdesc'),
                'categoryStatus' => $this->input->post('status')
            );
            $this->M_category->update_category($idcategory, $data);
       }
    }
}