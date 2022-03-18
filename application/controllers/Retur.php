<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Retur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_order', 'M_retur', 'M_product'));
        $this->load->database();
        $this->load->library('');
        $this->load->library(array('session', 'image_lib', 'upload'));
    }

    function submit_retur() {
        if (empty($_SESSION['iduser'])) {
            $response['status'] = 0;
            $response['message'] = "Sesi Anda berakhir, Silahkan login kembali";
            header('Content-type: text/javascript');
            echo json_encode($response);
        } else {
            $idretur = $this->M_retur->generate_id();
            $iduser = $_SESSION['iduser'];
            $idorder = $this->input->post('idordervalr');
            $idproduct = $this->input->post('idproductr');
            $solution = $this->input->post('solution');
            $comment = $this->input->post('commentr');
            $qty = $this->input->post('qtyretur');

            $path_folder = 'asset/img/uploads/retur/';

            #file to upload , check empty file

            if (empty($_FILES['file'])) {
                $response['status'] = 0;
                $response['message'] = "Gagal Retur, Silahkan upload foto produk";
                header('Content-type: text/javascript');
                echo json_encode($response);
            } else {
                $file = $_FILES['file'];
                # get file extention
                $path = $_FILES['file']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $file_name_save = $idretur . "." . $ext;
                $file_name_save_path = $path_folder . $idretur. "." . $ext;
                
                $data_retur = array(
                    'idretur' => $idretur,
                    'comment_retur' => $comment,
                    'qty_retur' => $qty,
                    'request_retur_solution' => $solution,
                    'img_product_retur' => $file_name_save_path,
                    'iduser_submit' => $iduser,
                    'retur_status' => 'submit',
                    'idproduct_retur' => $idproduct,
                    'idorder_retur' => $idorder
                );
                $this->do_upload_photo($file, $path_folder, $idproduct, $data_retur, $file_name_save, $idorder, $idretur);
            }
        }
    }

    function do_upload_photo($file, $path_folder, $idproduct, $data_retur, $file_name_save, $idorder, $idretur) {
        $config['upload_path'] = './' . $path_folder . '';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG';
        $config['file_name'] = $file_name_save;
        $config['encrypt_name'] = FALSE;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($file['name'])) {
            if ($this->upload->do_upload('file')) {
                $c = $this->upload->data();
                $save_data = $this->M_retur->submit_retur($data_retur);
                $data_detail = array('idretur' => $idretur);
                $update_data = $this->M_order->update_data_order_detail_by_id($idorder,$idproduct , $data_detail);
                $response['status'] = 1;
                $response['message'] = "Success Submit Complain, Mohon tunggu akan kami proses terlebih dahulu.";
                header('Content-type: text/javascript');
                echo json_encode($response);
            } else {
                $response['status'] = 0;
                $response['message'] = "Error Submit Complain, ".$this->image_lib->display_errors()."";
                header('Content-type: text/javascript');
                echo json_encode($response);
                echo $this->image_lib->display_errors();
            }
        } else {
            echo $this->image_lib->display_errors();
        }
    }

    function detail_retur(){
        if (empty($_SESSION['iduser'])) {
            $response['status'] = 0;
            $response['message'] = "Sesi Anda berakhir, Silahkan login kembali";
            header('Content-type: text/javascript');
            echo json_encode($response);
        } else {
            $id = $this->input->post('id');
            $data_retur = $this->M_retur->retur_by_id($id)->row();
            $response['status'] = 1;
            $response['message'] = "OK";
            $response['data'] = $data_retur;
            header('Content-type: text/javascript');
            echo json_encode($response);
        }
    }

}
