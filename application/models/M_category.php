<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_category extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html'));
    }

    function data_category()
    {
        return $this->db->get('t_category');
    }

    function store_category($data)
    {
        if (!empty($data['categoryName']) || !empty($data['idparent']) || !empty($data['categoryDescription']) || !empty($data['categoryLink']) || !empty($data['categoryMetaTag']) || !empty($data['categoryMetaDescription']) || !empty($data['categoryStatus'])) {
            $this->db->insert('t_category', $data);
            $this->db->insert_id();
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Kategori " . $data['categoryName'] . "  Tersimpan'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
        } else {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Cek input data Anda'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        }
    }

    function data_category_all()
    {
        $this->db->select('*')
            ->grup_by('idparent');
        return $this->db->get();
    }

    function delete_category($id)
    {
        $cek = $this->db->query("SELECT * from t_category where idparent='" . $id . "'");
        if (($cek->num_rows()) > 0) {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Anda tidak Dapat Menghapus Kategory yang memiliki subkategory'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        } else {
            $this->db->where('idcategory', $id);
            $this->db->delete('t_category');
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Kategory Terhapus'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
        }
    }

    function data_category_by_id($idcategory)
    {
        $this->db->select('*')
            ->where('idcategory', $idcategory);
        return $this->db->get('t_category');
    }

    function data_parent_by_id($idcategory)
    {
        $idparent = $this->db->query("SELECT idparent from t_category where idcategory='" . $idcategory . "'");
        foreach ($idparent->result() as $value) {
            $dataparent = $this->db->query("SELECT categoryName, idcategory from t_category where idcategory='" . $value->idparent . "'");
            foreach ($dataparent->result() as $value) {
                $data = array(
                    'idcategory' => $value->idcategory,
                    'categoryName' => $value->categoryName,
                );
                return $data;
            }
        }
    }

    function update_category($id, $data)
    {
        $this->db->where('idcategory', $id);
        $this->db->update('t_category', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Kategori " . $id . "  Terupdate'
                }, {type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10, z_index: 1031,
                });
                </script>";
    }

    function get_select_category($parent = 0, $hasil)
    {
        $parent1 = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($parent1->num_rows()) > 0) {
            foreach ($parent1->result() as $a) {
                $hasil .= "<option value=" . $a->idcategory . ">";
                $hasil .= "" . $a->categoryName . "";
                $hasil .= "</option>";
                $parent2 = $this->db->query("SELECT * from t_category where idparent='" . $a->idcategory . "'");
                foreach ($parent2->result() as $b) {
                    $hasil .= "<option value=" . $b->idcategory . ">";
                    $hasil .= $a->categoryName . " > " . $b->categoryName;
                    $hasil .= "</option>";
                    $parent3 = $this->db->query("SELECT * from t_category where idparent='" . $b->idcategory . "'");
                    if ($parent3->num_rows() > 0) {
                        foreach ($parent3->result() as $c) {
                            $hasil .= "<option value=" . $c->idcategory . ">";
                            $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName;
                            $hasil .= "</option>";
                            $parent4 = $this->db->query("SELECT * from t_category where idparent='" . $c->idcategory . "'");
                            if ($parent4->num_rows() > 0) {
                                foreach ($parent4->result() as $d) {
                                    $hasil .= "<option value=" . $d->idcategory . ">";
                                    $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName . " > " . $d->categoryName;
                                    $hasil .= "</option>";
                                    $parent5 = $this->db->query("SELECT * from t_category where idparent='" . $d->idcategory . "'");
                                    if ($parent5->num_rows() > 0) {
                                        foreach ($parent5->result() as $e) {
                                            $hasil = $this->get_list_category($e->idcategory, $hasil);
                                            $hasil .= "<option value=" . $e->idcategory . ">";
                                            $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName . " > " . $d->categoryName . " > " . $e->categoryName;
                                            $hasil .= "</option>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $hasil;
    }

    function get_list_category($parent = 0, $hasil)
    {
        $parent1 = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($parent1->num_rows()) > 0) {
            foreach ($parent1->result() as $a) {
                $hasil .= "<tr><td>";
                $hasil .= "" . $a->categoryName . "";
                $hasil .= "</td>";
                $hasil .= "<td align='center'>";
                $hasil .= '<span class="btn btn-sm btn-danger" onclick="deleteCategory(' . $a->idcategory . ');"><i class="fa fa-trash"></i></span>';
                $hasil .= '<span class="btn btn-sm btn-warning" onclick="fupdateCategory(' . $a->idcategory . ');"><i class="fa fa-pencil"></i></span>';
                $hasil .= "</td></tr>";
                $parent2 = $this->db->query("SELECT * from t_category where idparent='" . $a->idcategory . "'");
                foreach ($parent2->result() as $b) {
                    $hasil .= "<tr><td>";
                    $hasil .= $a->categoryName . " > " . $b->categoryName;
                    $hasil .= "</td>";
                    $hasil .= "<td align='center'>";
                    $hasil .= "<span class='btn btn-sm btn-danger' onclick=deleteCategory('" . $b->idcategory . "')><i class='fa fa-trash'></i></span>";
                    $hasil .= "<span class='btn btn-sm btn-warning' onclick=fupdateCategory('" . $b->idcategory . "')><i class='fa fa-pencil'></i></span>";
                    $hasil .= "</td></tr>";
                    $parent3 = $this->db->query("SELECT * from t_category where idparent='" . $b->idcategory . "'");
                    if ($parent3->num_rows() > 0) {
                        foreach ($parent3->result() as $c) {
                            $hasil .= "<tr><td>";
                            $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName;
                            $hasil .= "</td>";
                            $hasil .= "<td align='center'>";
                            $hasil .= "<span class='btn btn-sm btn-danger' onclick=deleteCategory('" . $c->idcategory . "')><i class='fa fa-trash'></i></span>";
                            $hasil .= "<span class='btn btn-sm btn-warning' onclick=fupdateCategory('" . $c->idcategory . "')><i class='fa fa-pencil'></i></span>";
                            $hasil .= "</td></tr>";
                            $parent4 = $this->db->query("SELECT * from t_category where idparent='" . $c->idcategory . "'");
                            if ($parent4->num_rows() > 0) {
                                foreach ($parent4->result() as $d) {
                                    $hasil .= "<tr><td>";
                                    $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName . " > " . $d->categoryName;
                                    $hasil .= "</td>";
                                    $hasil .= "<td align='center'>";
                                    $hasil .= "<span class='btn btn-sm btn-danger' onclick=deleteCategory('" . $d->idcategory . "')><i class='fa fa-trash'></i></span>";
                                    $hasil .= "<span class='btn btn-sm btn-warning' onclick=fupdateCategory('" . $d->idcategory . "')><i class='fa fa-pencil'></i></span>";
                                    $hasil .= "</td></tr>";
                                    $parent5 = $this->db->query("SELECT * from t_category where idparent='" . $d->idcategory . "'");
                                    if ($parent5->num_rows() > 0) {
                                        foreach ($parent5->result() as $e) {
                                            $hasil = $this->get_list_category($e->idcategory, $hasil);
                                            $hasil .= "<tr><td>";
                                            $hasil .= $a->categoryName . " > " . $b->categoryName . " > " . $c->categoryName . " > " . $d->categoryName . " > " . $e->categoryName;
                                            $hasil .= "</td>";
                                            $hasil .= "<td align='center'>";
                                            $hasil .= "<span class='btn btn-sm btn-danger' onclick=deleteCategory('" . $e->idcategory . "')><i class='fa fa-trash'></i></span>";
                                            $hasil .= "<span class='btn btn-sm btn-warning' onclick=fupdateCategory('" . $e->idcategory . "')><i class='fa fa-pencil'></i></span>";
                                            $hasil .= "</td></tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $hasil;
    }

    function get_breadcrumb($cat)
    {
        $path = "";
        $base_url = base_url('');
        $div = '<span class="s-text16"><i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i></span>';
        while ($cat != 0) {
            $row = $this->db->query("SELECT * FROM t_category WHERE idcategory='$cat'");
            $path = $div . '<a class="s-text16" href="' . $base_url . '/pages/product/search?category=' . $row->row()->idcategory . '&price=ASC&group=" >' . $row->row()->categoryName . '</a>' . $path;
            $cat = $row->row()->idparent;
        }
        if ($path != "") {
            $path = substr($path, strlen($div));
        }
        return $path;
    }

    function tree_menu_home($parent = 0, $hasil)
    {
        $base_url = base_url('');
        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($w->num_rows()) > 0) {
            $hasil .= "<ul class='sub_menu'>";
        }
        foreach ($w->result() as $h) {

            $hasil .= "<li><a href='" . $base_url . "pages/product/search?category=" . $h->idcategory . "&price=ASC" . "'>" . $h->categoryName . "</a>";
            $hasil = $this->tree_menu_home($h->idcategory, $hasil);
            $hasil .= "</li>";
        }
        if (($w->num_rows) > 0) {
            $hasil .= "</ul>";
        }
        return $hasil;
    }

    function get_category_product($parent = 0, $hasil)
    {
        $base_url = base_url('');
        $limit = "6";
        $start = "0";
        $price = "'ASC'";
        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($w->num_rows()) > 0) {
            $hasil .= '<ul id="tree1">';
        }
        foreach ($w->result() as $h) {
            $hasil .= '<li>'
                . '<a style="color:#000;" href="JavaScript:void(0);" onclick="url_replace(' . $limit . ', ' . $start . ', ' . $h->idcategory . ', ' . $price . ')">' . $h->categoryName . '</a>';
            $hasil = $this->get_category_product($h->idcategory, $hasil);
            $hasil .= "</li>";
        }
        if (($w->num_rows) > 0) {
            $hasil .= "</ul>";
        }
        return $hasil;
    }


    function tree_menu_mobile($parent = 0, $hasil)
    {
        $base_url = base_url('');
        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        if (($w->num_rows()) > 0) {
            $hasil .= "<ul class='sub-menu'>";
        }
        foreach ($w->result() as $h) {
            $hasil .= "<li><a href='" . $base_url . "pages/product/search?category=" . $h->idcategory . "&price=ASC" . "'>"  . $h->categoryName . "</a>";
            $hasil = $this->tree_menu_mobile($h->idcategory, $hasil);
            $hasil .= "</li>";
        }
        if (($w->num_rows) > 0) {
            $hasil .= "</ul>";
            $hasil .= "<i class='arrow-main-menu fa fa-angle-right' aria-hidden='true'></i>";
        }
        return $hasil;
    }

    function get_id_parent_by_link($link)
    {
        $this->db->select('idparent, idcategory')
            ->where('categoryLink', $link);
        return $this->db->get('t_category');
    }

    function get_category_by_parent($idparent)
    {
        $this->db->select('*')
            ->where('idparent', $idparent);
        return $this->db->get('t_category');
    }
}
