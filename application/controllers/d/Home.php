<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/User');
        }
        $this->load->model(array('M_company', 'M_order', 'M_partner', 'M_invoice', 'M_product', 'M_design', 'M_cod', 'M_keuangan'));
        $this->load->database();
    }

    function index() {
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->view('dashboard/home', $data);
    }


    function blank() {
        $data['title'] = "title";
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('v_404', $data);
    }

    function report_home() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
            $data['keuanganbulananonline'] = $this->M_keuangan->statistik_bulanan_online();
            $data['keuanganbulananoffline'] = $this->M_keuangan->statistik_bulanan_offline();
            $data['neworder'] = $this->M_order->count_new_order()->row();
            $data['neworderunpaid'] = $this->M_invoice->count_new_order_unpaid()->row();
            $data['wishlist'] = $this->M_order->count_wishlist()->row();
            $data['newpartner'] = $this->M_partner->count_new_partner()->row();
            $data['countshoping'] = $this->M_order->countshoping()->row();
            $data['countproduct'] = $this->M_product->countproduct()->row();
            $data['countproductoutstock'] = $this->M_product->countproductoutstock()->row();
            $data['countproductinstock'] = $this->M_product->countproductinstock()->row();
            $this->load->view('dashboard/report_home', $data);
        }
    }

    function documentation() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $this->load->view('dashboard/documentation');
        }
    }

    function settingcod() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_design->data_settingcod()->result();
            $this->load->view('dashboard/cod/settingcod', $data);
        }
    }

    function upload_cod() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_cod->data_partner_all()->result();
            $this->load->view('dashboard/cod/uploadcod', $data);
        }
    }

    function f_edit_cod(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data['datacod'] = $this->M_cod->user_by_id($id)->row();
            $this->load->view('dashboard/cod/f_update_cod', $data);
        }
    }

    function delete_cod() {
        $this->M_cod->delete_cod($this->input->post('idcod'));
    }

    function update_cod() {
        $id = $this->input->post('id');
        $codeProvinsi = $this->input->post('provinsi');
        $codeKabupaten = $this->input->post('kabupaten');

        if(!empty($codeProvinsi)){
            $codeProvinsi = $this->get_nama_provinsi($codeProvinsi);
        }
        else{
            $codeProvinsi = 0;
        }
        if(!empty($codeKabupaten)){
            $codeKabupaten = $this->get_nama_kota($codeKabupaten, $codeProvinsi);
        }else{
            $codeKabupaten = 0;
        }

        $password = $this->input->post('password');
        $data_user = $this->M_user->user_by_id($id)->row();

        if($data_user->password != $password){
            $password = md5($password);
        }else{
            $password = $password;
        }
        $data = array(
            'username' => $this->input->post('username'),
            'useremail' => $this->input->post('email'),
            'userHp' => $this->input->post('hp'),
            'tipeuser' => $this->input->post('tipeuser'),
            'password' => $password,
            'provinsi' => $codeProvinsi,
            'kabupaten' => $codeKabupaten,
        );
        $this->M_user->update_user($id, $data);
    }
    public function create_cod_m(){

        $data = [
            'name'      => 'COD',
            'lokasi'    => $this->input->post('lokasi'),
            'ongkir'    => $this->input->post('ongkir'),
            'deskripsi' => $this->input->post('desc'),
            'status'    => $this->input->post('Act')
        ];

        $this->db->insert('t_cod',$data);
        echo $this->load_Cod();
    }
    public function load_Cod(){
        $cod = $this->db->get('t_cod')->result();
        $tb = '';
        foreach ($cod as $value) {
            $tb .= '<tr>';
            $tb .= '<td>'.$value->idcod.'</td>';
            $tb .= '<td>'.$value->lokasi.'</td>';
            $tb .= '<td>'.$value->ongkir.'</td>';
            $tb .= '<td>'.$value->deskripsi.'</td>';
            $tb .= '<td>'.$value->status.'</td>';
            $tb .= '<td align="center">';
            $tb .= '<button class="btn btn-sm btn-danger" title="delete" onclick="DeleteCod('.$value->idcod.')"><i class="fa fa-trash"></i></button>';
            $tb .= '<button class="btn btn-sm btn-warning" title="update" onclick="showEdit('.$value->idcod.')" style="margin-left:3px;"><i class="fa fa-pencil"></i></button>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
        return $tb;
    }
    public function showEdit(){
        $data = $this->db->get_where('t_cod',['idcod'=>$this->input->post('id')])->row_array();
        echo json_encode($data);
    }
    public function Update_Cod_m(){
        $data = [
            'name'      => 'COD',
            'lokasi'    => $this->input->post('lokasi'),
            'ongkir'    => $this->input->post('ongkir'),
            'deskripsi' => $this->input->post('desc'),
            'status'    => $this->input->post('Act')
        ];
        $this->db->where('idcod',$this->input->post('id'));
        $this->db->update('t_cod',$data);
        echo $this->load_Cod();
    }
    public function delete_cod_m(){
        $id = $this->input->post('id');
        $this->db->delete('t_cod',['idcod'=>$id]);
        echo $this->load_Cod();
    }

}
