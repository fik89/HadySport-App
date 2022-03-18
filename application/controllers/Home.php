<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_voucher','M_pages','M_widget','M_company', 'M_design', 'M_product', 'M_category', 'M_user', 'M_contact', 'M_ads','M_order', 'M_bank'));
        $this->load->library(array('session', 'image_lib', 'upload', 'form_validation','pagination'));
        $this->load->helper(array('url', 'captcha'));
        $this->load->database();
    }

    function page_404(){
        $this->load->view('v_404');
    }

    function home() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = $profil->tagcompanyDescription." | ".$profil->companyName;
        $data['activemenu'] = array('home' => "sale-noti", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'blog'=>'', 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['datapopup'] = $this->M_design->data_popup_by_status("Active")->row();
        $data['bannerhome'] = $this->M_design->data_banner_by_pos("bannerhome")->result();
        $data['bannerftop'] = $this->M_design->data_banner_by_pos("featuretop")->result();
        $data['bannerfbottom'] = $this->M_design->data_banner_by_pos("featurebottom")->result();
        $data['newarrival'] = $this->M_product->data_product_newarival()->result();
        $data['productsale'] = $this->M_product->data_product_sale()->result();
        $data['productbest'] = $this->M_product->data_product_bestseller()->result();
        $data['footertagline'] = $this->M_design->data_footer_tagline()->result();
        $data['fbpixel'] = $this->M_ads->data_ads_by_name_active("FB Pixel")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['lastsale'] = $this->M_product->lastSale()->row();
        $data['bank'] = $this->M_bank->data_bank()->result();
        $data['header_home'] = $this->load->view('header_home', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/home', $data);
    }

    function d() {
        echo $this->M_category->get_breadcrumb(14, "");
    }

    function cart() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Keranjang Belanja | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "sale-noti",'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/cart', $data);
    }

    function checkout() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Checkout Belanja | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/v_checkout', $data);
    }

    function checkout_method() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Checkout Belanja | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/v_checkout_method', $data);
    }
    
    function about() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Tentang Kami | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "sale-noti", 'contact' => "", 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/about', $data);
    }
    
    function contact() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Pusat Bantuan | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "sale-noti", 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();

          #captcha
        $cap = $this->create_new_captcha();
        $data['cap_img'] = $cap['image'];
        $this->session->set_userdata('captcha_code', $cap['word']);

        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/contact', $data);

   
    }
    
    function store_contact(){
        $captcha = $this->input->post('captcha', TRUE);
        $current_captcha = $this->session->userdata('captcha_code');
        
        if ($captcha == $current_captcha) {
        $this->form_validation->set_rules('_name', 'Nama', 'required');
        $this->form_validation->set_rules('_phone', 'Nomor HP', 'required');
        $this->form_validation->set_rules('_email', 'Email', 'required');
        $this->form_validation->set_rules('_message', 'Pesan', 'required');
        if ($this->form_validation->run() != false) {
            if(isset($_POST['_name']) || isset($_POST['_phone']) || isset($_POST['_email']) || isset($_POST['_message'])){

                $name = $this->input->post('_name', TRUE);
                $phone = $this->input->post('_phone', TRUE);
                $email = $this->input->post('_email', TRUE);
                $message = $this->input->post('_message', TRUE);

                $name = htmlspecialchars($name);
                $email = strip_tags($email);
                $phone = htmlspecialchars($phone);
                $message = htmlspecialchars($message);

                $data = array(
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'message' => $message
                );
                $this->M_contact->store_contact($data); 
                
                $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Terimakasih Atas Partisipasi Anda</div>');
                redirect('pages/contact');
            }else{
                echo "You must access the form";
                die();
            }
        } else {
            $this->contact();
        }
        }else{
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error or expired captcha</div>');
            $this->contact();
        }
    }
    
    function data_profile_partner(){
        $id = $this->session->userdata('iduser');
        $data['title'] = "contact";
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['user'] = $this->M_user->user_by_id($id)->row();$data['activemenu'] = array('home' => "",  'blog'=>'','product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "sale-noti", 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();

        $data['dataorder'] = $this->M_order->data_order_iduser($id)->result();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/profile', $data);
    }

    function store_email_sub(){
        $data = array('email' => $this->input->post('email'));
        $this->M_contact->store_email_sub($data);
    }
    
    function search_global(){
        echo $this->M_product->fetch_data_autocomplete($this->uri->segment(3));
    }
    
    function service() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Service | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => "sale-noti",'terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        
        $data['dataservice'] = $this->M_pages->data_service()->result();
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/service', $data);
    }

    function term_condition() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Syarat & Ketentuan | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => "",'terms'=>'sale-noti', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        
        $data['datatermcondition'] = $this->M_pages->data_term_condition()->row();
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/term_condition', $data);
    }

    function privacy_policy() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Kebijakan Privacy | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => "",'terms'=>'', 'privacy' => 'sale-noti','cekresi'=>'', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        
        $data['dataprivacypolicy'] = $this->M_pages->data_privacy_policy()->row();
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/privacy_policy', $data);
    }


    function cek_resi() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Cek Resi | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => "",'terms'=>'', 'privacy' => '', 'cekresi' => 'sale-noti', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
          #captcha
        $cap = $this->create_new_captcha();
        $data['cap_img'] = $cap['image'];
        $this->session->set_userdata('captcha_code', $cap['word']);

        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/cek_resi', $data);
    }

    function create_new_captcha() {
        $vals = array(
            'img_path' => './asset/img/captcha/',
            'img_url' => base_url() . 'asset/img/captcha/',
            'font_path' => './font/timesbd.ttf',
            'img_width' => '120',
            'img_height' => 40,
            'expiration' => 1200,
            'word_length' => 4,
            'font_size' => 26,
            'img_id' => 'Imageid',
            'pool' => '0123456789'
        );
        $cap = create_captcha($vals);
        return $cap;
    }

    function recaptcha() {
          // Captcha configuration
       $vals = array(
            'img_path' => './asset/img/captcha/',
            'img_url' => base_url() . 'asset/img/captcha/',
            'font_path' => './font/timesbd.ttf',
            'img_width' => '120',
            'img_height' => 40,
            'expiration' => 1200,
            'word_length' => 4,
            'font_size' => 26,
            'img_id' => 'Imageid',
            'pool' => '0123456789'
        );
        $cap = create_captcha($vals);
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captcha_code');
        $this->session->set_userdata('captcha_code',$cap['word']);
        // Display captcha image
        echo $cap['image'];
    }
    
        
    function gallery(){
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Galeri | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'blog' => "", 'contact' => '', 'service' => '', 'terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'sale-noti');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();

        #pagination
        $jumlah_data = $this->M_pages->jumlah_data_gallery();
        $config['base_url'] = base_url().'pages/gallery/';
        $config['query_string_segment'] = 'start';
        $config['full_tag_open'] = '<div class="pagination flex-m flex-w p-r-50">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        $config['cur_tag_open'] = '<a class="item-pagination flex-c-m trans-0-4 active-pagination" style="color:#fff;">';
        $config['cur_tag_close'] = '</a>';
        $config['attributes'] = array('class' => 'item-pagination flex-c-m trans-0-4');
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 8;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['datagallery'] = $this->M_pages->data_gallery_pagination($config['per_page'],$from);     
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/gallery', $data);
    }

       function voucher_list() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Voucher List | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'blog'=>'', 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "", 'service' => "",'terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['voucherlist'] = $this->M_voucher->data_voucher()->result();

        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/voucher_list', $data);
    }
    
}