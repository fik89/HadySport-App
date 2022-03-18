<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_daerah', 'M_user', 'M_partner', 'M_design', 'M_company'));
        $this->load->database();
    }

    function index(){
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $this->f_login();
    }

    function f_login() {
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->view('dashboard/login', $data);
    }

    function store_user() {
        $email = $this->input->post('email');
        $cekemail = $this->M_user->cek_email($email)->row();
        if ($cekemail != NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendaftaran Gagal, Email ' . $email . ' sudah terdaftar. <br> <a href="' . base_url('') . '">lupa password?</a>"</div>');
            redirect('d/User/login');
        } else {
            $iduser = $this->M_user->id_user();
            $prov = $this->M_daerah->getNamaProv($this->input->post('provinsi'))->row();
            $data = array(
                'iduser' => $iduser,
                'username' => $this->input->post('username'),
                'provinsi' => $prov->nama,
                'kabupaten' => $this->input->post('kabupaten'),
                'useremail' => $email,
                'password' => md5($this->input->post('password')),
                'userHp' => $this->input->post('userhp'),
                'tipeuser' => $this->input->post('tipeuser'),
                'userstatus' => "Inactive"
            );
            $this->M_user->store_user($data);
            redirect('d/User/login');
        }
    }

    function store_user_back() {
        $email = $this->input->post('email');
        $cekemail = $this->M_user->cek_email($email)->row();
        if ($cekemail != NULL) {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Member " . $email . "  Sudah Terdaftar'
                    }, { type: 'danger',animate: 
                    {enter: 'animated fadeInUp',
                    exit: 'animated fadeOutRight'
                    },placement: { from: 'top',align: 'right'
                    },offset: 20,delay: 3000,timer: 500, spacing: 10,z_index: 1031,
                    });
                    </script>";
        } else {
            $iduser = $this->M_user->id_user();
            $prov = $this->M_daerah->getNamaProv($this->input->post('provinsi'))->row();
            $data = array(
                'iduser' => $iduser,
                'username' => $this->input->post('username'),
                'provinsi' => $prov->nama,
                'kabupaten' => $this->input->post('kabupaten'),
                'useremail' => $email,
                'password' => md5($this->input->post('password')),
                'userHp' => $this->input->post('userhp'),
                'tipeuser' => $this->input->post('tipeuser'),
                'userstatus' => "Inactive"
            );
            $this->M_user->store_user($data);
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Member " . $email . "  Terdaftar'
                    }, {
                    type: 'success',
                    animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    }, placement: {from: 'top',align: 'right'
                    }, offset: 20,delay: 3000, timer: 500, spacing: 10,z_index: 1031,
                    });
                    </script>";
        }
    }

    function do_login() {
        $email = $this->input->post('email');
        $pre_pass = $this->input->post('password');
        $pass = md5($pre_pass);

        $cek = $this->M_user->cek_user($email, $pass);
        if ($cek->num_rows() == 1) {
            if ($cek->row()->userStatus != "Active") {
                $this->session->set_flashdata('MSG', 'Login Gagal","data user ' . $email . ' belum aktif');
                redirect('d/User/f_login');
            } elseif ($cek->row()->tipeuser != "1") {
                $this->session->set_flashdata('MSG', 'Login Gagal","data user ' . $email . ', tidak memiliki akses ke dashboard');
                redirect('d/User/f_login');
            } else {
                $sess_data = array(
                    'iduser' => $cek->row()->iduser,
                    'username' => $cek->row()->username,
                    'useremail' => $cek->row()->useremail,
                    'tipeuser' => $cek->row()->tipeuser
                );
                $this->session->set_userdata($sess_data);
                redirect('d/Home/');
            }
        } else {
            $this->session->set_flashdata('MSG', 'Login Gagal, Cek e-mail atau password Anda');
            redirect('d/User/f_login');
        }
    }

    function logout() {
        $this->session->unset_userdata('iduser');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('useremail');
        $this->session->unset_userdata('tipeuser');
        session_destroy();
        redirect('d/User/f_login');
    }

    function data_user_all() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['data'] = $this->M_user->data_user_all()->result();
            $this->load->view('dashboard/partner/data_user', $data);
        }
    }

    function update_status_user() {
        $id = $this->input->post('id');
        $data = array(
            'userStatus' => $this->input->post('status')
        );
        $this->M_user->update_user($id, $data);
    }

    function f_input_user() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $data['partner'] = $this->M_partner->data_partner_all()->result();
            $data['provinsi'] = $this->M_daerah->getProv()->result();
            $this->load->view('dashboard/partner/f_input_user', $data);
        }
    }

    function delete_user() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $this->M_user->delete_user($id);
        }
    }

    function update_user() {
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

    function user_by_id() {
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data['data'] = $this->M_user->user_by_id($id)->row();
            $this->load->view('dashboard/profile/data_profile', $data);
        }
    }

    function f_edit_user(){
        if (valid_admin()['status'] == 0) {
            echo valid_admin()['message'];
        } else {
            $id = $this->input->post('id');
            $data['datauser'] = $this->M_user->user_by_id($id)->row();
            $data['partner'] = $this->M_partner->data_partner_all()->result();
            $this->load->view('dashboard/partner/f_update_user', $data);
        }
    }

    function get_nama_provinsi($provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsiname = $rajaongkir->_api_ongkir('province?id=' . $provinsi . '');
        $data = json_decode($provinsiname, true);
        $result = json_encode($data['rajaongkir']['results']['province']);
        return str_replace('"', " ", $result);
    }

    function get_nama_kota($kota, $provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kotaname = $rajaongkir->_api_ongkir('city?id=' . $kota . '&province=' . $provinsi . '');
        $data = json_decode($kotaname, true);
        $result = json_encode($data['rajaongkir']['results']['city_name']);
        return str_replace('"', " ", $result);
    }

    function get_detail_user($id){
        if (empty($_SESSION['iduser'])) {
            $result['status'] = 0;
            $result['message'] = "Sesi Anda berakhir, Silahkan login kembali";
            echo json_encode($result);
        } else {
            $data_user = $this->M_user->user_by_id($id)->row();
            if(empty($data_user)){
                $result['status'] = 0;
                $result['message'] = "Data User tidak ditemukan";
                echo json_encode($result);
            }else{
                $datauser = array(
                    'username' => $data_user->username,
                    'lastname' => $data_user->lastName,
                    'kabupaten' => $data_user->kabupaten,
                    'provinsi' => $data_user->provinsi,
                    'codeKabupaten' => $data_user->codeKabupaten,
                    'codeProvinsi' => $data_user->codeProvinsi,
                    'codeKecamatan' => $data_user->codeKecamatan,
                    'desa' => $data_user->desa,
                    'kecamatan' => $data_user->kecamatan,
                    'rt' => $data_user->rt,
                    'rw' => $data_user->rw,
                    'kodepos' =>$data_user->kodepos,
                    'useremail' => $data_user->useremail,
                    'userHp' => $data_user->userHp,
                    'tipeuser' => $data_user->tipeuser
                );


                $result['status'] = 1;
                $result['message'] = "OK";
                $result['data'] = $datauser;
                echo json_encode($result);
            }
        }
    }

}
