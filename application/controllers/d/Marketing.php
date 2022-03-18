<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marketing extends CI_Controller {

    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_product', 'M_marketing', 'M_voucher'));
        $this->load->helper('date');
        $this->load->database();
    }

    function data_product_sale() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_marketing->data_product_sale()->result();
            $this->load->view('dashboard/marketing/data_product_sale', $data);
        }
    }

    function f_add_sale_product() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $cek = $this->M_marketing->data_product_sale_by_id($this->input->post('id'));
            if (($cek->num_rows()) > 0) {
                echo "<script> $.notify({
                    title: '<strong>Gagal <br></strong>',
                    message: 'Produk ini masih Diskon'
                        }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                        },placement: {from: 'top',align: 'right'
                        },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                        });
                        </script>";
            } else {
                $data['data'] = $this->M_product->product_by_id($this->input->post('id'))->row();
                $this->load->view('dashboard/marketing/f_add_sale', $data);
            }
        }
    }

    function store_sale_product() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data = array(
                'idproduct' => $this->input->post('idproduct'),
                'pricesale' => str_replace(".", "", $this->input->post('pricesale')),
                'startDate' => $this->input->post('startdate'),
                'endDate' => $this->input->post('enddate')
            );
            $this->M_marketing->store_sale_product($data);
        }
    }

    function update_product_sale() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data = array(
                'startDate' => $this->input->post('startdate'),
                'endDate' => $this->input->post('enddate')
            );
            $this->M_marketing->update_product_sale($id, $data);
        }
    }

    function delete_product_sale() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->M_marketing->delete_product_sale($this->input->post('id'));
        }
    }

    function f_voucher() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/marketing/f_add_voucher');
        }
    }

    function store_voucher() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data = array(
                'voucherName' => $this->input->post('vouchername'),
                'voucherPrice' => str_replace(".", "", $this->input->post('voucherprice')),
                'voucherCode' => $this->input->post('vouchercode'),
                'voucherDescription' => $this->input->post('voucherdesc'),
                'minTransaction' => str_replace(".", "", $this->input->post('mintransaction')),
                'startDate' => $this->input->post('startdate'),
                'endDate' => $this->input->post('enddate')
            );
            $this->M_voucher->store_voucher($data);
        }
    }

    function data_voucher() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_voucher->data_voucher()->result();
            $this->load->view('dashboard/marketing/data_voucher', $data);
        }
    }

    function update_voucher() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data = array(
                'voucherName' => $this->input->post('vouchername'),
                'voucherPrice' => str_replace(".", "", $this->input->post('voucherprice')),
                'voucherCode' => $this->input->post('vouchercode'),
                'voucherDescription' => $this->input->post('voucherdesc'),
                'minTransaction' => str_replace(".", "", $this->input->post('mintransaction')),
                'startDate' => $this->input->post('startdate'),
                'endDate' => $this->input->post('enddate')
            );
            $this->M_voucher->update_voucher($id, $data);
        }
    }

    function delete_voucher() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->M_voucher->delete_voucher($this->input->post('id'));
        }
    }

    function search_code_voucher() {
        $curdate = date('Y-m-d');
        $code = $this->input->post('voucher');
        $totalprice = $this->input->post('totalprice');
        $data = $this->M_voucher->get_voucher_by_code($code)->row();
        if (empty($data)) {
            $result = "<small style='color:red;'>Maaf, code voucher tidak di temukan</small>";
        }elseif($data->endDate < $curdate){
            $result = "<small style='color:red;'>Maaf, code voucher tidak di temukan atau sudah kadaluarsa</small>";
        }elseif($totalprice < $data->minTransaction){
            $result = "<small style='color:red;'>Maaf, Anda tidak dapat menggunakan voucher ini. Belanja minimum Rp. ".number_format($data->minTransaction)." <br>Total belanja Anda Rp. ".number_format($totalprice)."</small>";
        }else {
            $str = "'";
            $result = '<div class="bo21 p-l-10 p-t-10 p-r-10 p-b-10 fs-13">'
                    . 'Selamat, Voucher ' . $data->voucherName . '(' . $data->voucherCode . ') Tersedia <br>'
                    . 'Anda hemat s/d Rp. ' . number_format($data->voucherPrice) . ''
                    . '</div>'
                    . '<button class="btn-sm btn-block fs-13 btn-success" onclick="useVoucher(' . $str . '' . $data->voucherPrice . '' . $str . ',' . $str . '' . $data->idvoucher . '' . $str . ',' . $str . '' . $data->voucherName . '' . $str . ',' . $str . '' . $data->voucherCode . '' . $str . ',' . $str . '' . $data->voucherDescription . '' . $str . ');">Gunakan Voucher ini</button>';
        }
        echo $result;
    }

    function add_product_bestseller() {
        $id = $this->input->post('id');
        $cek = $this->M_product->data_product_bestseller_by_id($id);
        if (($cek->num_rows()) > 0) {
            echo "<script> $.notify({
                title: '<strong>Gagal <br></strong>',
                message: 'Produk ini masih dalam Kategori Bestseller'
                    }, {type: 'danger',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        } else {
            $data = array(
                'idproduct' => $id
            );
            $this->M_product->store_product_bestseller($data);
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Produk " . $data['idproduct'] . " berhasil di update'
                    }, {type: 'success',animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000,spacing: 10, z_index: 1031,
                    });
                    </script>";
        }
    }

    function data_product_bestseller() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_product->data_product_bestseller()->result();
            $this->load->view('dashboard/marketing/data_product_bestseller', $data);
        }
    }

    function delete_product_bestseller() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $this->M_product->delete_product_bestseller($id);
        }
    }
}