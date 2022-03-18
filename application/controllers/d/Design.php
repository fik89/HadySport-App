<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Design extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_design', 'M_category'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function f_banner_home() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['category'] = $this->M_category->get_select_category(0, "");
            $this->load->view('dashboard/design/f_banner', $data);
        }
    }

    function data_banner_all() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['category'] = $this->M_category->get_select_category(0, "");
            $data['data'] = $this->M_design->data_banner_all()->result();
            $this->load->view('dashboard/design/data_banner_all', $data);
        }
    }

    function sort_order_banner($position) {
        if ($position == "bannerhome") {
            echo '<option selected="" disabled="" value="">Sort Order (urutan)</option>
                <option value="1">ke -1</option>
                <option value="2">ke -2</option>
                <option value="3">ke -3</option>';
        } elseif ($position == "featuretop") {
            echo '<option selected="" disabled="" value="">Sort Order (urutan)</option>
                <option value="1">ke -1</option>
                <option value="2">ke -2</option>
                <option value="3">ke -3</option>';
        } elseif ($position == "featurebottom") {
            echo '<option selected="" disabled="" value="">Sort Order (urutan)</option>
                <option value="1">ke -1</option>
                <option value="2">ke -2</option>';
        } elseif ($position == "bannertitlepage") {
            echo '<option selected="" disabled="" value="">Sort Order (urutan)</option>
                <option value="1">ke -1</option>';
        }
    }

    function do_upload_banner() {
        $url = base_url('');
        $bannerpos = $this->input->post('bannerposition');
        $link = $this->input->post('link');
        if ($bannerpos == "bannerhome") {
            $desc = "Gambar ini untuk slider home, atur gambar <b>Active</b> maksimal 3.";
        } elseif ($bannerpos == "featuretop") {
            $desc = "Gambar ini untuk gambar promosi di atas product new arrival, berguna untuk produk sedang diskon";
        } elseif ($bannerpos == "featurebottom") {
            $desc = "Gambar ini untuk gambar promosi di bawah, berguna untuk produk terfavorit atau terlaris";
        } elseif ($bannerpos == "logo") {
            $desc = "Gambar ini digunakan untuk logo di semua posisi, sesuaikan ukuran yang telah ditetapkan";
        } elseif ($bannerpos == "bannertitlepage") {
            $desc = "Gambar ini digunakan untuk title page";
        }elseif ($bannerpos == "icontitle"){
            $desc = "iconpage";
        }
        if ($link == $url) {
            $linkbanner = $url;
        } else {
            $get_name = $this->M_category->data_category_by_id($link)->row();
            if (is_null($get_name)) {
                $linkbanner = $link;
            } else {
                $linkbanner = $get_name->idcategory;
            }
        }
        $config['upload_path'] = './asset/img/uploads/banner/';
        $nmfile = "ft_" . $bannerpos . " ";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/banner/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'maintain_ratio' => TRUE,
                    'new_image' => './asset/img/uploads/banner/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/banner/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $this->image_lib->watermark();
                $data = array(
                    'bannerPosition' => $bannerpos,
                    'status' => "inactive",
                    'image' => $c['file_name'],
                    'bannerdescription' => $desc,
                    'bannerText' => $this->input->post('bannertext'),
                    'sortOrder' => $this->input->post('sortorder'),
                    'bannerLink' => $linkbanner
                );
                $this->M_design->upload_img($data);
                echo '<script>swal({
                title: "Success!",
                text: "Unggah Foto sukses",
                    type: "success",
                    showConfirmButton: true
                    }, function(){
                    dataBanner();
                    });</script>';
            } else {
                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
                echo '<script>swal("Unggah gagal", "Foto Gagal di unggah", "warning")</script>';
            }
        }
    }

    function update_status_banner() {
        $id = $this->input->post('id');
        $url = base_url('');
        $bannerpos = $this->input->post('position');
        if ($bannerpos == "bannerhome") {
            $desc = "Gambar ini untuk slider home, atur gambar <b>Active</b> maksimal 3.";
        } elseif ($bannerpos == "featuretop") {
            $desc = "Gambar ini untuk gambar promosi di atas product new arrival, berguna untuk produk sedang diskon";
        } elseif ($bannerpos == "featurebottom") {
            $desc = "Gambar ini untuk gambar promosi di bawah, berguna untuk produk terfavorit atau terlaris";
        } elseif ($bannerpos == "logo") {
            $desc = "Gambar ini digunakan untuk logo di semua posisi, sesuaikan ukuran yang telah ditetapkan";
        }
        $link = $this->input->post('link');
        $sublink = substr($link, 0, 4);
        $reqsort = $this->input->post('sortorder');
        $cekcurrentsort = $this->M_design->data_banner_by_id($id)->row();
        $oldsort = $cekcurrentsort->sortOrder;
        $cekownsort = $this->M_design->data_banner_by_type($bannerpos, $reqsort)->row();
        if (empty($cekownsort)) {
            $idownsort = $id;
        } else {
            $idownsort = $cekownsort->idbannerimage;
        }
        if ($sublink == "http") {
            $linkbanner = $link;
        } elseif ($link == $url) {
            $linkbanner = $url;
        } else {
            $get_name = $this->M_category->data_category_by_id($link)->row();
            if (is_null($get_name)) {
                $linkbanner = $link;
            } else {
                $linkbanner = $get_name->idcategory;
            }
        }
        $data1 = array(
            'status' => $this->input->post('status'),
            'bannerPosition' => $this->input->post('position'),
            'bannerText' => $this->input->post('bannertext'),
            'sortOrder' => $oldsort,
            'bannerLink' => $linkbanner
        );
        $this->M_design->update_status_banner($idownsort, $data1);

        $data = array(
            'status' => $this->input->post('status'),
            'bannerPosition' => $this->input->post('position'),
            'bannerText' => $this->input->post('bannertext'),
            'sortOrder' => $reqsort,
            'bannerLink' => $linkbanner
        );
        $this->M_design->update_status_banner($id, $data);
    }

    function delete_banner() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $gambar = $this->M_design->banner_by_id($id)->row();
            unlink("asset/img/uploads/banner/" . $gambar->image);
            $this->M_design->delete_banner($id);
        }
    }

    function delete_popup() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $type = $this->input->post('type');
            if (($type == "Image Only") || ($type == "Header Image And Bottom Text")) {
                $gambar = $this->M_design->data_popup_by_id($id)->row();
                unlink("asset/img/uploads/popup/" . $gambar->popupImage);
            }
            $this->M_design->delete_popup($id);
        }
    }

    function data_popup() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_design->data_pop_up()->result();
            $this->load->view('dashboard/design/data_popup', $data);
        }
    }

    function f_upload_popup() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/design/f_upload_popup');
        }
    }

    function do_upload_popup() {
        $type = $this->input->post('tipepopup');
        $text = $this->input->post('popuptext');
        $button = $this->input->post('statusbutton');
        $image = $_FILES;
        if ($type == "Text Only") {
            $typedesc = "Pop up ini hanya berisikan text saja tanpa menggunakan gambar, button mengarah ke katalog produk";
            $this->do_upload_popup_text($type, $text, $typedesc, $button);
        } else if ($type == "Image Only") {
            $typedesc = "Pop ini hanya gambar, button mengarah ke katalog produk";
            $this->do_upload_popup_image($type, $image, $typedesc, $button);
        } else if ($type == "Header Image And Bottom Text") {
            $typedesc = "Pop ini memiliki header image dan keterangan text dibawahnya, button mengarah ke katalog produk";
            $this->do_upload_popup_text_image($type, $image, $text, $typedesc, $button);
        }
    }

    function do_upload_popup_text($type, $text, $typedesc, $button) {
        $data = array(
            'popupType' => $type,
            'popupText' => $text,
            'typeDescription' => $typedesc,
            'popupStatus' => "Inactive",
            'statusButton' => $button
        );
        $this->M_design->store_popup($data);
    }

    function do_upload_popup_image($type, $file, $typedesc, $button) {
        $config['upload_path'] = './asset/img/uploads/popup/';
        $nmfile = "ft_" . $type . " ";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($file['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/popup/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'new_image' => './asset/img/uploads/popup/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/popup/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $this->image_lib->watermark();
                $data = array(
                    'popupType' => $type,
                    'popupImage' => $c['file_name'],
                    'typeDescription' => $typedesc,
                    'popupStatus' => "Inactive",
                    'statusButton' => $button
                );
                $this->M_design->store_popup($data);
            } else {
                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
            }
        }
    }

    function do_upload_popup_text_image($type, $file, $text, $typedesc, $button) {
        $config['upload_path'] = './asset/img/uploads/popup/';
        $nmfile = "ft_" . $type . " ";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($file['filefotoheadline']['name'])) {
            if ($this->upload->do_upload('filefotoheadline')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/popup/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'new_image' => './asset/img/uploads/popup/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/popup/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $this->image_lib->watermark();
                $data = array(
                    'popupType' => $type,
                    'popupText' => $text,
                    'popupImage' => $c['file_name'],
                    'typeDescription' => $typedesc,
                    'popupStatus' => "Inactive",
                    'statusButton' => $button
                );
                $this->M_design->store_popup($data);
            } else {
                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
            }
        }
    }

    function update_status_popup() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($status == "Active") {
            $datapopup = $this->M_design->data_popup_by_status("Active");
            if ($datapopup->row() != "") {
                echo "<script> $.notify({
            title: '<strong>Gagal</strong>',
            message: 'System hanya memperbolehkan satu popup Active, ID popup " . $datapopup->row()->idpopup . "'
                }, {
                type: 'danger',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
            } else {
                $data = array(
                    'popupStatus' => $this->input->post('status')
                );
                $this->M_design->update_data_popup($id, $data);
            }
        } else {
            $data = array(
                'popupStatus' => $this->input->post('status')
            );
            $this->M_design->update_data_popup($id, $data);
        }
    }

    function preview_popup() {
        $id = $this->input->post('id');
        $data['datapopup'] = $this->M_design->data_popup_by_id($id)->row();
        $this->load->view('dashboard/design/preview_popup', $data);
    }

    function data_footer_tagline() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_design->data_footer_tagline()->result();
            $this->load->view('dashboard/design/data_footer_tagline', $data);
        }
    }

    function f_store_footer_tagline() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/design/f_upload_footer_tagline');
        }
    }

    function delete_footer_tagline() {
        $id = $this->input->post('id');
        unlink("asset/img/uploads/footer/" . $this->input->post('icon'));
        $this->M_design->delete_footer_tagline($id);
    }

     function store_footer_tagline() {
        $cek = $this->M_design->count_footer_tagline()->row();
        if ($cek->id > 2) {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Tagline maksimal 3, silahkan hapus salah satu'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        } else {
            $id = $this->input->post('id');
            $icon = $this->input->post('icon');
            $title = $this->input->post('title');
            $desc = $this->input->post('desc');
            $config['upload_path'] = './asset/img/uploads/footer/';
            $nmfile = "ft_" . $title . " ";
            $config['allowed_types'] = "*";
            $config['file_name'] = $nmfile;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!empty($_FILES['icon']['name'])) {
                if ($this->upload->do_upload('icon')) {
                    $c = $this->upload->data();
                    $configer = array(
                        'image_library' => 'gd2',
                        'source_image' => './asset/img/uploads/footer/' . $c['file_name'],
                        'maintain_ratio' => FALSE,
                        'width' => 60,
                        'height' => 60,
                    );
                    $this->load->library('image_lib', $configer);
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    $data = array(
                        'icon' => $c['file_name'],
                        'taglineTitle' => $this->input->post('title'),
                        'taglineDescription' => $this->input->post('desc')
                    );
                    $this->M_design->store_footer_tagline($data);
                    echo $this->image_lib->display_errors();
                    echo $this->upload->display_errors();
                } else {
                    echo $this->image_lib->display_errors();
                    echo $this->upload->display_errors();
                }
            }
        }
    }

}
