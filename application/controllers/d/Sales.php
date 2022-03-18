<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_wishlist', 'M_order', 'M_invoice', 'M_company', 'M_product'));
        $this->load->database();
        $this->load->helper(array('date'));
        $this->load->library(array('session'));
    }

    function data_count_wishlist() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_wishlist->data_count_wishlist()->result();
            $data['dataall'] = $this->M_wishlist->data_wishlist()->result();
            $this->load->view('dashboard/sales/data_wishlist', $data);
        }
    }

    function data_order() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $status = $this->input->post('status');
            if (empty($status)) {
                $data['dataorder'] = $this->M_order->data_order()->result();
            } else {
                $data['dataorder'] = $this->M_order->data_order_by_status($status)->result();
            }
            $this->load->view('dashboard/sales/data_order_by_status', $data);
        }
    }

    function detail_order() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idorder = $this->input->post('id');
            $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
            $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
            $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
            $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
            $this->load->view('dashboard/sales/data_detail_order', $data);
        }
    }

    function confirm_order() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idorder = $this->input->post('id');
            $resi = $this->input->post('resi');
            $mailto = $this->input->post('email');
            $kurir = $this->input->post('kurir');
            $company = $this->M_company->data_company()->row();
            $subject = "Order " . $idorder . " Terkonfirmasi";
            $msg = "<p>Konfirmasi Order .</p><p><br></p><p>Order Anda Dengan Nomor Order " . $idorder . " Sudah Kita Proses.</p><p>Id Order : " . $idorder . "</p><p>nomor Resi : " . $resi . "<br></p><p>Jasa Kurir : " . $kurir . "<br></p><p>Cetak Invoice Anda klik link dibawah ini</p><p><a href='".base_url('d/Exportdata/export_invoice_pdf?idorder='.$idorder.'')."'><button style='background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Cetak Invoice</button></a></p><p><br></p><p><b>Terimakasih</b><br></p><p>$company->companyName<br>$company->address1<br>$company->phone1</p>";
            $datestring = 'Y-m-d H:i:s';
            $dataorder = array(
                'status' => 'process shiping',
                'verifyBy' => $this->session->userdata('iduser'),
                'dateVerify' => date($datestring)
            );
            $updateorder = $this->M_order->update_data_order($idorder, $dataorder);
            echo $updateorder;
            $datashiping = array(
                'receiptNumber' => $resi
            );
            $updateshiping = $this->M_order->update_data_order_shiping($idorder, $datashiping);
            echo $updateshiping;
            $datainvoice = array(
                'invoiceStatus' => 'process shiping'
            );
            $updateinvoice = $this->M_invoice->update_data_invoice($idorder, $datainvoice);
            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "back";
            $Mail->send($mailto, $subject, $msg, $loc);
        }
    }

    function reject_restock_product() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idorder = $this->input->post('id');
            $dataorderdetail = $this->M_order->data_detail_order_product($idorder)->result();
            $dataproduct = array();
            foreach ($dataorderdetail as $value) {
                if(($value->quantityStock-$value->productQty) < 1){$productstatus = "Out Of Stock";}else{$productstatus = "In Stock";}
                $arraytmp = array(
                    'idproduct' => $value->idproduct,
                    'quantityStock' => $value->quantityStock+$value->productQty,
                    'productStatus' => $productstatus
                );
                array_push($dataproduct, $arraytmp);
            }
            $updatestock = $this->M_product->update_stock_product($dataproduct);
            $this->update_reject_order($idorder);
        }
    }

    function update_reject_order($idorder){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $dataorder = array(
                'status' => 'reject'
            );
            $updateorder = $this->M_order->update_data_order($idorder, $dataorder);

            $datainvoice = array(
                'invoiceStatus' => "reject"
            );
            $updateinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);
        }
    }

    function delete_data_order(){
        if (empty($_SESSION['iduser'])) {
            $return['status'] = 0;
            $return['message'] = "Sessi Login telah berakhir, Silahkan Login kembali";
            header('Content-type: text/javascript');
            echo json_encode($return);
        }else if($_SESSION['tipeuser'] != 1 ){
            $return['status'] = 0;
            $return['message'] = "Anda tidak memiliki akses";
            header('Content-type: text/javascript');
            echo json_encode($return);
        }else {
            $id = $this->input->post('id');
            $cek_data_order = $this->M_order->cek_order_id($id)->row();
            if(empty($cek_data_order->idorder)){
                $return['status'] = 0;
                $return['message'] = "ID Order tidak di temukan";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }else{
                $delete  = $this->M_order->delete_all_data_order($id);
                $return['status'] = 1;
                $return['message'] = "Data Terhapus";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        } 
    }

    function data_order_all(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/sales/data_order');
        }
    }

    function get_data_order_all(){
        if (valid_admin()['status'] == 0) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $str = "'";
            $list = $this->M_order->get_datatables_order();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $result) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $result->idorder;
                $row[] = $result->iduser;
                $row[] = $result->ipaddress;
                $row[] = $result->orderDate;
                $row[] = $result->status;
                $row[] = '<button class="btn btn-sm btn-success" onclick="detailOrder('.$str.$result->idorder.$str.')"><i class="fa fa-send"></i> Proses</button>'
                        . '<button class="btn btn-sm btn-danger" onclick="delete_order('.$str.$result->idorder.$str.')"><i class="fa fa-trash"></i> Hapus</button>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->M_order->count_all(),
                "recordsFiltered" => $this->M_order->count_filtered(),            
                "data" => $data,
            );
            echo json_encode($output);
        }
    }
    
       function finish_order() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $idorder = $this->input->post('id');
            $idorder = decryption($idorder);
            $cek_order = $this->M_order->cek_order_id($idorder)->row();
            if (empty($cek_order)) {
                $return['status'] = 0;
                $return['message'] = "IDorder tidak ditemukann";
                header('Content-type: text/javascript');
                echo json_encode($return);
            } else {
                $data_order = array(
                    'status' => 'selesai'
                );
                $data_invoice = array(
                    'invoiceStatus' => 'selesai'
                );
                $updateorder = $this->M_order->update_data_order($idorder, $data_order);
                $updateinvoice = $this->M_invoice->update_invoice($idorder, $data_invoice);
                $return['status'] = 1;
                $return['message'] = "Update Sukses, Terimakasih"
                        . "";
                header('Content-type: text/javascript');
                echo json_encode($return);
            }
        }
    }
}