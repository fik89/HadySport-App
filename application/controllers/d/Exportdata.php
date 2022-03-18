<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exportdata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_order', 'M_invoice', 'M_design', 'M_company', 'M_keuangan'));
        $this->load->library(array('session'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function export_invoice_pdf() {
        $idorder = $this->input->get('idorder');
        $cek_str = substr($idorder, 0,4);
        if($cek_str == 5857){
            $idorder == $idorder;
        }else{
            $idorder = decryption($idorder);
        }
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();

        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->library('pdf');
        $this->pdf->load_view('export_data/template_invoice', $data);
        $this->pdf->render();
        $this->pdf->stream("inv" . $idorder . ".pdf", array("Attachment" => 0));
    }

    function export_shiping_label_pdf() {
        $idorder = $this->input->get('idorder');
        $dataorder = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->library('pdf');
        if ($dataorder->dropshipperName == "") {
            $this->pdf->load_view('export_data/template_shiping_label', $data);
        } else {
            $this->pdf->load_view('export_data/template_shiping_label_dropship', $data);
        }
        $this->pdf->render();
        $this->pdf->stream("lbl" . $idorder . ".pdf", array("Attachment" => 0));
    }

    function export_struck() {
        $idorder = $this->input->get('idorder');
        $dataorder = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['profile'] = $this->M_company->data_company()->row();

            $this->load->view('export_data/template_struck', $data); 
    }

    function export_ltv_excel() {
        $startdate = $this->input->get('startdate');
        $enddate = $this->input->get('enddate');
        if (empty($startdate) && empty($enddate)) {
            $data['startdate'] = "";
            $data['enddate'] = "";
            $data['data'] = $this->M_order->data_order_shiping()->result();
        } else {
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['data'] = $this->M_order->data_order_shiping_by_date($startdate, $enddate)->result();
        }
        $this->load->view('export_data/template_ltv', $data);
    }

    function final_export_ltv() {
        $startdate = $this->input->get('startdate');
        $enddate = $this->input->get('enddate');
        if (empty($startdate) && empty($enddate)) {
            $data['startdate'] = "";
            $data['enddate'] = "";
            $data['data'] = $this->M_order->data_order_shiping()->result();
        } else {
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['data'] = $this->M_order->data_order_shiping_by_date($startdate, $enddate)->result();
        }
        $this->load->view('export_data/final_export_ltv', $data);
    }

    function export_penjualan() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $startdate = $this->input->get('startdate');
            $enddate = $this->input->get('enddate');
            $status = $this->input->get('status');
            if (empty($startdate) && empty($enddate)) {
                $data['startdate'] = "";
                $data['enddate'] = "";
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_status($status)->result();
            } else {
                $data['startdate'] = $startdate;
                $data['enddate'] = $enddate;
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_bydate_status($startdate, $enddate, $status)->result();
            }
            $data['profile'] = $this->M_company->data_company()->row();
            $this->load->view('export_data/template_penjualan', $data);
        }
    }

    function export_penjualan_excel() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $startdate = $this->input->get('startdate');
            $enddate = $this->input->get('enddate');
            $status = $this->input->get('status');
            if (empty($startdate) && empty($enddate)) {
                $data['startdate'] = "";
                $data['enddate'] = "";
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_status($status)->result();
            } else {
                $data['startdate'] = $startdate;
                $data['enddate'] = $enddate;
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_bydate_status($startdate, $enddate, $status)->result();
            }
            $data['profile'] = $this->M_company->data_company()->row();
            $this->load->view('export_data/template_penjualan_excel', $data);
        }
    }

    function export_penjualan_pdf() {
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $startdate = $this->input->get('startdate');
            $enddate = $this->input->get('enddate');
            $status = $this->input->get('status');
            if (empty($startdate) && empty($enddate)) {
                $data['startdate'] = "";
                $data['enddate'] = "";
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_status($status)->result();
            } else {
                $data['startdate'] = $startdate;
                $data['enddate'] = $enddate;
                $data['status'] = $status;
                $data['data'] = $this->M_keuangan->data_penjualan_bydate_status($startdate, $enddate, $status)->result();
            }
            $data['profile'] = $this->M_company->data_company()->row();

            $this->load->library('pdf');
            $this->pdf->load_view('export_data/template_penjualan_pdf', $data);
            $this->pdf->set_paper('A4', 'Landscape');
            $this->pdf->render();
            $this->pdf->stream("export-penjualan.pdf", array("Attachment" => 0));
        }
    }

}