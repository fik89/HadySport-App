<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_pages'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    #page gallery
    function page_gallery() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['datagallery'] = $this->M_pages->data_gallery()->result();
            $this->load->view('dashboard/pages/data_gallery', $data);
        }
    }

    function update_gallery() {
        $id = $this->input->post('id');
        $data['datagallery'] = $this->M_pages->data_gallery_id($id)->row();
        $this->load->view('dashboard/pages/update_gallery', $data);
    }

    function simpan_gallery() {
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $idbgalleryupdate = $this->uri->segment(4);
            #icon image update
            $path_folder = 'asset/img/uploads/pages/';
            $judul = $this->input->post('judulgallery');
            $link = $this->input->post('link');
            $deskripsi = $this->input->post('deskripsigallery');
            $judul_icon = str_replace('&', '-', $judul);
            $judul_icon = str_replace(' ', '-', $judul_icon);
            $judul_icon = strtolower($judul_icon);

            #file to upload , check empty file

            if (!empty($_FILES['file'])) {
                $file = $_FILES['file'];
                # get file extention
                $path = $_FILES['file']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $file_name_save = $path_folder . "gallery-".$judul_icon . "." . $ext;
                $file_name_save_path = "gallery-".$judul_icon;
            } else {
                $file_name_save = $this->input->post('currenticonimagegallery');
            }

            #initial action 
            if (empty($idbgalleryupdate)) {
                $action = array(
                    'id' => 0,
                    'post' => 'new'
                );
            } else {
                $datagallery = $this->M_pages->data_gallery_id($idbgalleryupdate)->row();
                $action = array(
                    'id' => $idbgalleryupdate,
                    'post' => 'update',
                    'iconimage' => $datagallery->icon
                );
            }

            $data_page = array(
                'title' => $judul,
                'link' => $link,
                'description' => $deskripsi,
                'icon' => $file_name_save,
            );
            if (empty($idbgalleryupdate)) {
                #save new blog
                $this->do_upload_photo_gallery($file, $path_folder, $file_name_save_path, $data_page, $action);
            } else if (!empty($_FILES['file'])) {
                #update blog new banner
                $this->do_upload_photo_gallery($file, $path_folder, $file_name_save_path, $data_page, $action);
            } else {
                #update blog null banner
                $update = $this->M_pages->update_gallery_save($action['id'], $data_page);

                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        }
    }

    function do_upload_photo_gallery($file, $path_folder, $file_name_save_path, $data_page, $action) {
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
                $configer = array(
                    'image_library' => 'gd2',
                    'maintain_ratio' => FALSE,
                    'quality' => '100%',
                    'width' => 500,
                    'height' => 333,
                    'new_image' => './'.$path_folder.$c['file_name'].'',
                    'source_image' => './'.$path_folder.$c['file_name'].''
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                if ($action['post'] == 'new') {
                    $save_post = $this->M_pages->simpan_gallery($data_page);
                } else if ($action['post'] == 'update') {

                    unlink($action['iconimage']);
                    $update = $this->M_pages->update_gallery_save($action['id'], $data_page);
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
    
    function hapus_gallery(){
        if (empty($_SESSION['iduser'])) {
            $return = "Sessi Login telah berakhir, Silahkan Login kembali";
            echo $return;
        } else {
            $id = $this->input->post('id');
            $datagallery = $this->M_pages->data_gallery_id($id)->row();
            $this->M_pages->hapus_gallery($id);
            unlink($datagallery->icon);
        }
    }

    #page service
    function data_page() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['dataservice'] = $this->M_pages->data_service()->result();
            $this->load->view('dashboard/pages/data_page', $data);
        }
    }

    function update_service() {
        $id = $this->input->post('id');
        $data['dataservice'] = $this->M_pages->data_service_id($id)->row();
        $this->load->view('dashboard/pages/update_service', $data);
    }

    function simpan_service() {
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $idbserviceupdate = $this->uri->segment(4);
            #icon image update
            $path_folder = 'asset/img/uploads/pages/';
            $judul = $this->input->post('judul');
            $deskripsi = $this->input->post('deskripsi');
            $judul_icon = str_replace('&', '-', $judul);
            $judul_icon = str_replace(' ', '-', $judul_icon);
            $judul_icon = strtolower($judul_icon);

            #file to upload , check empty file

            if (!empty($_FILES['file'])) {
                $file = $_FILES['file'];
                # get file extention
                $path = $_FILES['file']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $file_name_save = $path_folder . "service-".$judul_icon . "." . $ext;
                $file_name_save_path = "service-".$judul_icon;
            } else {
                $file_name_save = $this->input->post('currenticonimage');
            }

            #initial action 
            if (empty($idbserviceupdate)) {
                $action = array(
                    'id' => 0,
                    'post' => 'new'
                );
            } else {
                $dataservice = $this->M_pages->data_service_id($idbserviceupdate)->row();
                $action = array(
                    'id' => $idbserviceupdate,
                    'post' => 'update',
                    'iconimage' => $dataservice->icon
                );
            }

            $data_page = array(
                'title' => $judul,
                'description' => $deskripsi,
                'icon' => $file_name_save,
            );
            if (empty($idbserviceupdate)) {
                #save new blog
                $this->do_upload_photo($file, $path_folder, $file_name_save_path, $data_page, $action);
            } else if (!empty($_FILES['file'])) {
                #update blog new banner
                $this->do_upload_photo($file, $path_folder, $file_name_save_path, $data_page, $action);
            } else {
                #update blog null banner
                $update = $this->M_pages->update_service_save($action['id'], $data_page);

                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        }
    }

    function do_upload_photo($file, $path_folder, $file_name_save_path, $data_page, $action) {
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
                $configer = array(
                    'image_library' => 'gd2',
                    'maintain_ratio' => FALSE,
                    'quality' => '100%',
                    'width' => 500,
                    'height' => 333,
                    'new_image' => './'.$path_folder.$c['file_name'].'',
                    'source_image' => './'.$path_folder.$c['file_name'].''
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                if ($action['post'] == 'new') {
                    $save_post = $this->M_pages->simpan_service($data_page);
                } else if ($action['post'] == 'update') {

                    unlink($action['iconimage']);
                    $update = $this->M_pages->update_service_save($action['id'], $data_page);
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
    
    function hapus_service(){
        if (empty($_SESSION['iduser'])) {
            $return = "Sessi Login telah berakhir, Silahkan Login kembali";
            echo $return;
        } else {
            $id = $this->input->post('id');
            $dataservice = $this->M_pages->data_service_id($id)->row();
            $this->M_pages->hapus_service($id);
            unlink($dataservice->icon);
        }
    }


    #page Term & condition
    function page_term_condition(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['datatermcondition'] = $this->M_pages->data_term_condition()->row();
            $this->load->view('dashboard/pages/data_term_condition', $data);
        }
    }

    function update_term_condition(){
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $data = array(
                'description' => $this->input->post('deskripsi')
            );
            $update = $this->M_pages->update_term_condition($data);
           
                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
        }   
    }

    #page Privacy & Policy
    function page_privacy_policy(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['dataprivacypolicy'] = $this->M_pages->data_privacy_policy()->row();
            $this->load->view('dashboard/pages/data_privacy_policy', $data);
        }
    }

    function update_privacy_policy(){
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        } else {
            $data = array(
                'description' => $this->input->post('deskripsi')
            );
            $update = $this->M_pages->update_privacy_policy($data);
           
                $return['status'] = 1;
                $return['message'] = "Success Upload Document";
                header('Content-type: text/javascript');
                echo json_encode($return);
        }   
    }

}
