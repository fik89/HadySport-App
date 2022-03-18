<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_blog'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function f_unggah_blog() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['datakategori'] = $this->M_blog->data_kategori()->result();
            $this->load->view('dashboard/blog/f_unggah_blog', $data);
        }
    }

    function simpan_kategori() {
        $kategori = $this->input->post('kategori');
        $data = array('blog_category_name' => $kategori);

        $cek_kategori = $this->M_blog->kategori_by_name($kategori)->row();
        if (!empty($cek_kategori->idblogcategory)) {
            echo "<script> $.notify({
                title: '<strong>Gagal <br></strong>',
                message: 'Duplikat Nama kategori'
                }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                });
                </script>";
        } else {

            $save = $this->M_blog->simpan_kategori($data);
            if ($save) {
                echo "<script> $.notify({
                        title: '<strong>Sukses <br></strong>',
                        message: 'Data Tersimpan'
                        }, {type: 'success',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                        },placement: {from: 'top',align: 'right'
                        },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                        });
                        </script>";
            }
        }
    }

    function hapus_kategori() {
        $id = $this->input->post('id');
        $hapus = $this->M_blog->hapus_kategori($id);
        if ($hapus) {
            echo "<script> $.notify({
                        title: '<strong>Sukses <br></strong>',
                        message: 'Sukses Hapus Data'
                        }, {type: 'success',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                        },placement: {from: 'top',align: 'right'
                        },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                        });
                        </script>";
        }
    }

    function get_data_kategori_id() {
        $id = $this->input->post('id');
        $data_kategori = $this->M_blog->kategori_by_id($id)->row();

        if (empty($data_kategori)) {
            $output = array(
                "status" => "0",
                "message" => "Data Permohoan tidak di temukan",
                "data" => null
            );
        } else {
            $output = array(
                "status" => "1",
                "message" => "OK",
                "data" => $data_kategori,
            );
        }

        header('Content-type: text/javascript');
        echo json_encode($output);
    }

    function simpan_edit_kategori() {
        $id = $this->input->post('id_kategori');
        $nama = $this->input->post('nama_kategori');

        $data = array('blog_category_name' => $nama);
        $update = $this->M_blog->simpan_edit_kategori($id, $data);
    }

    function unggah_blog_save() {
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
        } else {
            $idblogupdate = $this->uri->segment(4);
            
            $path_folder = 'asset/img/uploads/blog/';
            $iduser = $_SESSION['iduser'];
            $idblog = $this->M_blog->idblog();
            $kategori = $this->input->post('kategori');
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $tag = $this->input->post('tag');
            $metatitle = $this->input->post('metatitle');
            $metatag = $this->input->post('metatag');
            $metadesc = $this->input->post('metadesc');
            #slug 
            $preslugtitle = str_replace(' ', '-', $judul);
            $slug = $preslugtitle . $idblog . ".html";
            
            #file to upload , check empty file
            
            if(!empty($_FILES['file'])){
            $file = $_FILES['file'];
            # get file extention
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_name_save = $path_folder . $preslugtitle . $idblog . "." . $ext;
            $file_name_save_path = $preslugtitle . $idblog;
            }else{
                $file_name_save = $this->input->post('currentbanner');
            }
            
            #initial action 
            if(empty($idblogupdate)){
                $action = array(
                    'id' => 0,
                    'post' => 'new' 
                );
                $idblog = $idblog;
            }else{
                $action = array(
                    'id' => $idblogupdate,
                    'post' => 'update'
                );
                $idblog = $idblogupdate;
            }
            
            $data_blog = array(
                'idblogpost' => $idblog,
                'idblogcategory' => $kategori,
                'blog_title' => $judul,
                'blog' => $isi,
                'post_tag' => $tag,
                'metatitle' => $metatitle,
                'metatag' => $metatag,
                'metadesc' => $metadesc,
                'banner_image' => $file_name_save,
                'post_by' => $iduser,
                'post_date' => date('Y-m-d H:i:s'),
                'post_blog_slug' => strtolower($slug),
            );
            if(empty($idblogupdate)){
                #save new blog
                $this->do_upload_photo($file, $path_folder, $file_name_save_path, $data_blog, $action);
            }else if(!empty($_FILES['file'])){
                #update blog new banner
                $this->do_upload_photo($file, $path_folder, $file_name_save_path, $data_blog, $action);
            }else{
                #update blog null banner
                $update = $this->M_blog->update_blog_save($action['id'], $data_blog);
                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        }
    }

    function do_upload_photo($file, $path_folder, $file_name_save_path, $data_blog, $action) {
        $config['upload_path'] = './' . $path_folder . '';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG';
        $config['file_name'] = $file_name_save_path;
        $config['encrypt_name'] = FALSE;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($file['name'])) {
            if ($this->upload->do_upload('file')) {
                $c = $this->upload->data();
                $this->_create_thumbs($c['file_name'], $path_folder);
                
                if($action['post'] == 'new'){
                    $save_post = $this->M_blog->unggah_blog_save($data_blog);
                    
                }else if($action['post'] == 'update'){
                    $update = $this->M_blog->update_blog_save($action['id'], $data_blog);
                }
                
                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
            } else {

                $return['status'] = 0;
                $return['message'] = "Error Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
                echo $this->image_lib->display_errors();
            }
            echo $this->image_lib->display_errors();
        } else {
            echo $this->image_lib->display_errors();
        }
    }

    function _create_thumbs($file_name, $path_folder) {
        // Image resizing config
        $config = array(
            // Large Image
            array(
                'image_library' => 'GD2',
                'overwrite' => TRUE,
                'source_image' => './' . $path_folder . '' . $file_name,
                'maintain_ratio' => TRUE,
                'quality' => '98%',
                'width' => 400,
                'height' => 400,
                'new_image' => './' . $path_folder . '' . "400x400-" . $file_name
            ),
            // Small Image
            array(
                'image_library' => 'GD2',
                'overwrite' => TRUE,
                'source_image' => './' . $path_folder . '' . $file_name,
                'maintain_ratio' => TRUE,
                'width' => 80,
                'height' => 67,
                'new_image' => './' . $path_folder . '' . "80x67-" . $file_name
        ));
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item) {
            $this->image_lib->initialize($item);
            if (!$this->image_lib->resize()) {
                return false;
            }
            $this->image_lib->clear();
        }
    }
    
    function data_blog(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['datablog'] = $this->M_blog->data_blog()->result();
            $this->load->view('dashboard/blog/data_blog', $data);
        }
    }
    
    function update_blog(){
        $id = $this->input->post('id');
        $data['datablog'] = $this->M_blog->data_blog_id($id)->row();
        $this->load->view('dashboard/blog/update_blog', $data);
    }
    
    function hapus_blog(){
        if (empty($_SESSION['iduser'])) {
            $return = "Sessi Login telah berakhir, Silahkan Login kembali";
            echo $return;
        } else {
            $id = $this->input->post('id');
            $datablog = $this->M_blog->data_blog_id($id)->row();
            $this->M_blog->hapus_blog($id);
            unlink($datablog->banner_image);
        }
    }
    
}