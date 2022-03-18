<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
    public function __construct() {
        parent::__construct(); 
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_invoice', 'M_user', 'M_company'));
        $this->load->database();
        $this->load->helper(array('date'));
    }

    function data_invoice_partner_all() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_invoice->data_invoice_partner_all()->result();
            $this->load->view('dashboard/partner/data_invoice_partner', $data);
        }
    }
    
    function data_invoice_unpaid(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_invoice->data_invoice_by_status("closing unpaid")->result();
            $this->load->view('dashboard/sales/data_invoice_unpaid', $data);
        }
    }

    function confirm_invoice_partner() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('idinvoice');
            $iduser = $this->input->post('iduser');
            $email = $this->input->post('email');
            $data = array(
                'dateConfirm' => date('Y-m-d H:i:s')
            );
            $this->M_invoice->update_status_invoice($id, $data);
            $datauser = $this->M_user->user_by_id($iduser)->row();
            $company = $this->M_company->data_company()->row();
            $mailto = $email;
            $subject = "Registrasi Akun " . $iduser . "";
            $msg = '<p><b>Selamat Bergabung Dengan Kami...</b><br></p><h2><u>Akun Anda Telah di verifikasi</u></h2><p>Silahkan Aktifasi Akun Anda</p><p>Nama :' . $datauser->username . '</p><p>iduser : ' . $iduser . '<br></p><br><p>Silahkan  aktivasi</p><p><a href="'.base_url().'User/verificationaccount/?iduser=' . $iduser . '&token=' . $datauser->password . '"><button style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Verifikasi</button></a> <br></p><p><b>Terimakasih</b><br></p><p>'.$company->companyName.'<br>'.$company->address1.'<br>'.$company->phone1.'</p>';
            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "back";
            $Mail->send($mailto, $subject, $msg, $loc);
        }
    }
    
    function send_email_remainder(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $company = $this->M_company->data_company()->row();
            $data = $this->M_invoice->data_invoice_by_id_order($id)->row();

            $mailto = $data->custEmail;
            $subject = "Remainder Payment " . $id . "";
            $msg = '<p><b><h2>Terimakasih Telah berbelanja dengan kami</h2></b><br></p><h3>Berikut Adalah Order yang belum terbayarkan</h3><p>Segera Lunasi atau konfimasi pembayaran order Anda sebelum '.$data->dueDate.'</p><p>Order Anda akan kami reject dan stok barang akan kami kembalikan jika dalam waktu tersebut belum terbayarkan.</p><p><a href="'.base_url('pages/invoice?idorder='.$id.'').'"><button style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Bayar Sekarang</button></a></p><br><br><p><b>Terimakasih</b><br></p><p>'.$company->companyName.'<br>'.$company->address1.'<br>'.$company->phone1.'</p>';
            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "back";
            $Mail->send($mailto, $subject, $msg, $loc);
        }
    }
}