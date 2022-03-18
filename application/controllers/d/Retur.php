<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Retur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_order', 'M_retur', 'M_product', 'M_keuangan', 'M_company','M_invoice'));
        $this->load->database();
        $this->load->library('');
        $this->load->library(array('session'));
    }

    function get_data_retur() {
        if (valid_admin()['status'] == 0) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $str = "'";
            $list = $this->M_retur->get_datatables_retur();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $result) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $result->idretur;
                $row[] = $result->idproduct_retur;
                $row[] = $result->idorder_retur;
                $row[] = $result->qty_retur;
                $row[] = $result->comment_retur;
                $row[] = date_ind($result->retur_date) . " " . get_time($result->retur_date);
                $row[] = $result->retur_status;
                $row[] = $result->email_status == "" ?
                        'Belum Mengirim Email' : $result->email_status . '<br>
                        <button class="btn btn-sm btn-success" onclick="send_email_confirm(' . $str . $result->idretur . $str . ')">Resend Email</button>';
                $row[] = $result->retur_status == "submit" ?
                        ' <button class="btn btn-sm btn-info" onclick="detail_retur(' . $str . $result->idretur . $str . ')"> detail & proses</button> ' :
                        '<button class="btn btn-sm btn-success" onclick="send_email_confirm(' . $str . $result->idretur . $str . ')">Kirim Email</button>
                <button class="btn btn-sm btn-warning" onclick="detail_retur(' . $str . $result->idretur . $str . ')">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="delete_retur(' . $str . $result->idretur . $str . ')">Hapus</button>'

                ;
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->M_retur->count_all(),
                "recordsFiltered" => $this->M_retur->count_filtered(),
                "data" => $data,
            );
            echo json_encode($output);
        }
    }

    function data_retur() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/sales/data_retur');
        }
    }

    function detail_retur() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data['detailretur'] = $this->M_retur->retur_by_id($id)->row();
            $this->load->view('dashboard/sales/data_detail_retur', $data);
        }
    }

    function confirm_retur() {
        if (valid_admin()['status'] == 0) {
            $result['status'] = valid_admin()['status'];
            $result['message'] = valid_admin()['message'];
            echo json_encode($result);
        } else {
            $idretur = $this->input->post('idretur');
            $returstatus = $this->input->post('returstatus');
            $solution = $this->input->post('solution');
            $idorder = $this->input->post('idorder');
            $moneyback = $this->input->post('moneyback');
            $commentreply = $this->input->post('commentreply');
            $statusordernew = $this->input->post('statusordernew');

            $data_retur = array(
                'money_back' => $moneyback,
                'comment_reply' => $commentreply,
                'confirm_retur_solution' => $solution,
                'retur_status' => 'confirmed',
                'date_confirm' => date('Y-m-d H:i:s'),
                'confirm_by' => $_SESSION['iduser']
            );
            $update = $this->M_retur->update_retur_id($idretur, $data_retur);

            if (!empty($moneyback)) {
                $data_keuangan = array(
                    'price' => $moneyback,
                    'idorder' => $idorder,
                    'idretur' => $idretur,
                    'iduser' => $_SESSION['iduser'],
                    'type' => 'kredit online',
                    'keterangan' => 'Retur Product id retur ' . $idretur . ''
                );
                if ($returstatus == 'confirmed') {
                    $updatekeuangan = $this->M_keuangan->update_keuangan_idretur($idretur, $data_keuangan);
                } else {
                    $storekeuangan = $this->M_keuangan->store_keuangan($data_keuangan);
                }
            }
            #data tabel order
            $data_order = array(
                'status' => $statusordernew
            );
            $this->M_order->update_data_order($idorder, $data_order);
            $datainvoice = array(
                    'invoiceStatus' => $statusordernew,
                );
            $storeinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);

            $result['status'] = 1;
            $result['message'] = 'Success Confirm';

            echo json_encode($result);
        }
    }

    function send_email_konfirmasi() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $idretur = $this->input->post('id');

            $dataretur = $this->M_retur->retur_by_id($idretur)->row();

            $company = $this->M_company->data_company()->row();

            $mailto = $dataretur->useremail . ', ' . $dataretur->custEmail;
            $subject = "Konfirmasi Retur Product " . $idretur . "";
            $msg = '
                    <p>Hai,' . $dataretur->username . ' ' . $dataretur->lastName . ' </p>
                    <p><b>Informasi Retur dengan ID : ' . $idretur . ' </b><br>
                    Product : ' . $dataretur->idproduct_retur . '<br>
                    Qty : ' . $dataretur->qty_retur . '<br>
                    Pilihan Solusi : ' . $dataretur->request_retur_solution . '</p>
                    <hr>
                    <p>' . $dataretur->comment_reply . '</p>


                    <br><p><b>Terimakasih</b><br></p><p>' . $company->companyName . '<br>' . $company->address1 . '<br>' . $company->phone1 . '</p>';

            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "back";
            $Mail->send($mailto, $subject, $msg, $loc);
            $data_retur = array(
                'email_status' => 'sent at ' . date('Y-m-d H:i:s'),
            );
            $update = $this->M_retur->update_retur_id($idretur, $data_retur);
        }
    }

    function delete_data_retur() {
        if (valid_admin()['status'] == 0) {
            $result['status'] = 0;
            $result['message'] = 'Access Forbidden';
            echo json_encode($result);
        } else {
            $idretur = $this->input->post('id');

            $dataretur = $this->M_retur->retur_by_id($idretur)->row();
            $delete_retur = $this->M_retur->delete_data_retur($idretur);

            $data_order_detail = array(
                'idretur' => null
            );
            $delete_retur = $this->M_order->update_data_order_detail_by_id($dataretur->idorder, $dataretur->idproduct_retur, $data_order_detail);
            $delete_keuangan = $this->M_keuangan->delete_data_keuangan_idretur($idretur);

            $result['status'] = 1;
            $result['message'] = 'Success Delete Data';
            echo json_encode($result);
        }
    }

}
