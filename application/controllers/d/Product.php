<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_product', 'M_category', 'M_rating'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function f_upload() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idproduct = $this->M_product->id_product();
            $session = $this->session->userdata('iduser');
            $cektemp = $this->M_product->data_temp_idupload_temp($session, "temp");
            if ($cektemp->num_rows() > 0) {
                $data['idproduct'] = $cektemp->row()->idproduct;
                $data['session'] = $session;
            } else {
                $data['idproduct'] = $this->M_product->id_product();
                $data['session'] = $this->session->userdata('iduser');
                $this->temp_upload_product($idproduct, $idproduct.$session, $session);
            }
            $data['category'] = $this->M_category->get_select_category(0, "");
            $this->load->view('dashboard/product/f_upload_product', $data);
        }
    }

    function do_upload_product() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idProduct = $this->input->post('idproduct');
            $idUpload = $this->input->post('idupload');
            $session = $this->session->userdata('iduser');
            $cekfoto = $this->M_product->photo_count($idUpload);
            if ($cekfoto < 2) {
                echo '<script>swal("Unggah gagal", "Anda Belum Mengunggah minimal 2 foto", "warning")</script>';
            } else {
                $product_name = $this->input->post('productname');
                $string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $product_name);
                $trim = trim($string);
                $pre_slug = strtolower(str_replace(" ", "-", $trim));
                $slug = "$pre_slug-$idProduct" . '.html';
                $data = array(
                    'idproduct' => $idProduct,
                    'idcategory' => $this->input->post('category'),
                    'idupload' => $idUpload,
                    'productName' => ucwords($product_name),
                    'productDescription' => ucwords($this->input->post('productdescription')),
                    'price' => str_replace(".", "", $this->input->post('productprice')),
                    'quantityStock' => $this->input->post('productqty'),
                    'size' => $this->input->post('productsize'),
                    'material' => $this->input->post('productmaterial'),
                    'productWeight' => $this->input->post('productweight'),
                    'postSlug' => $slug,
                    'productStatus' => "In Stock",
                    'uploadBy' => $session
                );
                $this->M_product->update_product($data, $idProduct);
                
                echo '<script>swal({
                    title: "Success!",
                    text: "Produk ' . $this->input->post('productname') . ' Tersimpan dengan Stok ' . $this->input->post('productqty') . '",
                        type: "success",
                        showConfirmButton: true
                        }, function(){
                        dataProduct();
                        });</script>';
            }
        }
    }

    function temp_upload_product($idP, $idU, $session) {
        $data = array(
            'idproduct' => $idP,
            'idcategory' => "NULL",
            'idupload' => $idU,
            'productName' => "NULL",
            'productDescription' => "NULL",
            'price' => "NULL",
            'quantityStock' => 0,
            'size' => "NULL",
            'material' => "NULL",
            'productWeight' => "NULL",
            'postSlug' => "NULL",
            'productStatus' => "temp",
            'uploadBy' => $session
        );
        $cek = $this->M_product->product_by_id($idP)->num_rows();
        if ($cek == 0) {
            $this->M_product->store_product($data);
        } else {
            $this->M_product->update_product($data, $idP);
        }
    }

    function do_upload_photo() {
        $idP = $this->input->post('idproduct');
        $a = $this->input->post('idupload');
        $session = $this->session->userdata('iduser');
        $b = $this->M_product->photo_count($a);
        $cek = $this->M_product->product_by_id($idP)->num_rows();
        if ($cek == 0) {
            $b = $cek;
        }
        $e = $b + 1;
        $config['upload_path'] = './asset/img/uploads/product/';
        $nmfile = "ft_" . $a . " ";
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG';
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/product' . $c['file_name'],
                    'maintain_ratio' => FALSE,
                    'quality' => '99%',
                    'width' => 400,
                    'height' => 400,
                    'new_image' => './asset/img/uploads/product/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/product/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $this->image_lib->watermark();
                $data = array(
                    'idUpload' => $a,
                    'fotoName' => $c['file_name'],
                    'fotoStatus' => $e
                );
                $this->M_product->upload_img($data);
                echo '<script>swal("Sukses", "Unggah Sukses foto ke - ' . $e . '", "success")</script>';
            } else {
                echo $this->image_lib->display_errors();
                echo '<script>swal("Unggah gagal", "Foto Gagal di unggah", "warning")</script>';
            }
                echo $this->image_lib->display_errors();
            
        }
        $cek = $this->M_product->product_by_id_cek($idP)->num_rows();
        if ($cek == 0) {
            $this->temp_upload_product($idP, $a, $session);
        }
    }

    function load_photo($idU) {
        $gambar = $this->M_product->load_photo($idU)->result();
        foreach ($gambar as $value) {
            $id = "'$value->idFoto'";
            $status = "$value->fotoStatus";
            echo ' <div class="col-md-6 border-grey">
        <img class="img-responsive" src="' . site_url('asset/img/uploads/product/' . $value->fotoName . '') . '" />
        <span class="col-md-4 btn btn-sm bg-border-blue border-grey" style="display: block; color: #dd4b39; margin-top:7px;" onClick="del(' . $id . ')"><i class="fa fa-trash"></i> Hapus</span>'
                . '<span class="label label-success">' . $status . '</span> 
        </div>
        <div class="clearfix visible-xs"></div>';
        }
    }

    function imgDel($id) {
        $gambar = $this->M_product->foto_by_id($id)->row();
        unlink("asset/img/uploads/product/" . $gambar->fotoName);
        $this->M_product->do_delete_foto($id);
    }

    function update_stock() {
        $id = $this->input->post('id');
        $stock = $this->input->post('stock');
        if ($stock == 0) {
            $data = array(
                'quantityStock' => $stock,
                'productStatus' => "Out Of Stock"
            );
            $this->M_product->update_product($data, $id);
        } else if ($stock > 0) {
            $data = array(
                'quantityStock' => $stock,
                'productStatus' => "In Stock"
            );
            $this->M_product->update_product($data, $id);
        }
        echo "<script> $.notify({title: '<strong>Sukses</strong>',message: 'Update Stok " . $id . " -> " . $stock . "'}, {
                    type: 'success',animate: {enter: 'animated fadeInUp', exit: 'animated fadeOutRight'
                    },
                    placement: {from: 'top',align: 'right'
                    },
                    offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031, });
                    </script>";
    }

    function delete_product() {
        $idproduct = $this->input->post('idproduct');
        $idupload = $this->input->post('idupload');
        $this->M_product->delete_by_idproduct($idproduct);
        $gambar = $this->M_product->foto_by_idupload($idupload)->result();
        foreach ($gambar as $value) {
            unlink("asset/img/uploads/product/" . $value->fotoName);
            $this->M_product->do_delete_foto($value->idFoto);
        }
    }

    function f_update_product() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_product->product_by_id_all($this->input->post('id'))->row();
            $data['category'] = $this->M_category->get_select_category(0, "");   
            $this->load->view('dashboard/product/f_update_product', $data);
        }
    }

    function cek_qty() {
        $id = $this->input->post('id');
        $product = $this->M_product->product_by_id($id)->row();
        echo $product->quantityStock;
    }
    
    function delete_ulasan(){
        $this->M_rating->delete_ulasan($this->input->post('id'));
    }

    function get_detail_product($id){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $product = $this->M_product->product_by_id($id)->row();
            if(empty($product)){
                $result['status'] = 0;
                $result['message'] = "Data Product Kosong";
            }else{
                $result = array(
                    'status' => 1,
                    'message' => 'OK',
                    'data' => array(
                        'harga' => intval($product->price),
                        'qty' => $product->quantityStock,
                    ),
                );
            }
            echo json_encode($result);
        }
    }

    function get_data_product(){
        if (valid_admin()['status'] == 0) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $str = "'";
            $list = $this->M_product->get_datatables_product();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $result) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<img src="'.site_url("asset/img/uploads/product/").''.$result->fotoName.'" style="max-width:120px;">';
                $row[] = $result->productName;
                $row[] = "Rp. ".number_format($result->price);
                $row[] = '<input class="form-control" type="number" id="stock'.$result->idproduct.'" value="'.$result->quantityStock.'">';
                $row[] = $result->username;
                $row[] = $result->productStatus;
                $row[] = ' <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update stok" id="'.$result->idproduct.'" onclick="updateStock('.$str.$result->idproduct.$str.');"><i class="fa fa-refresh"></i></button>
                          <button class="btn btn-sm btn-warning" data-toggle="tooltip" title="update produk" onclick="fUpdate('.$str.$result->idproduct.$str.');"><i class="fa fa-pencil"></i></button>
                          <button class="delproduct btn btn-sm btn-danger" data-toggle="tooltip" title="hapus produk" data-idupload="'.$result->idupload.'" data-idproduct="'.$result->idproduct.'"><i class="fa fa-trash"></i></button> |
                          <button class="saleproduct btn btn-sm btn-success" data-toggle="tooltip" title="atur diskon" onclick="fAddSale('.$str.$result->idproduct.$str.');"><i class="fa fa-dollar"></i></button>
                          <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="atur best seller" onclick="AddBestSeller('.$str.$result->idproduct.$str.');"><i class="fa fa-heart"></i></button>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->M_product->count_all(),
                "recordsFiltered" => $this->M_product->count_filtered(),            
                "data" => $data,
            );
            echo json_encode($output);
        }
    }

    function data_product(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/product/data_product');
        }
    }

    function get_data_ulasan(){
        if (valid_admin()['status'] == 0) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $str = "'";
            $list = $this->M_rating->get_datatables_rating();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $result) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<img src="'.site_url("asset/img/uploads/product/").''.$result->fotoName.'" style="max-width:120px;">';
                $row[] = $result->productName;
                $row[] = $this->star($result->ratingProduct);
                $row[] = $result->comment;
                $row[] = $result->username;
                $row[] = $result->date_create;
                $row[] = '<button class="delproduct btn btn-sm btn-danger" data-toggle="tooltip" title="hapus data" data-idrating="'.$result->idratingproduct.'"><i class="fa fa-trash"></i></button>';
               
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->M_rating->count_all(),
                "recordsFiltered" => $this->M_rating->count_filtered(),            
                "data" => $data,
            );
            echo json_encode($output);
        }
    }

    
    function data_ulasan() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/product/data_ulasan');
        }
    }

    function star($count){
        $star = '';
        if($count == 1){
            $star = '<i class="fa fa-star text-yellow"></i>';
        }else if($count == 2){

            $star = '<i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>';
        }else if($count == 3){

            $star = '<i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>';
        }else if($count == 4){

            $star = '<i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>';
        }else if($count == 5){

            $star = '<i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>';
        }else{

            $star = '';
        }
        return $star;

    }
}
