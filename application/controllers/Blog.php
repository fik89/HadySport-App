<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_blog','M_widget','M_company', 'M_design', 'M_product', 'M_category', 'M_user', 'M_contact', 'M_ads'));
        $this->load->library('pagination');
        $this->load->database();
    }
    
    function blog(){
        $data['profile'] = $this->M_company->data_company()->row();
        $data['title'] = "blog | ".$data['profile']->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'blog' => "sale-noti", 'contact' => '', 'service' => '', 'terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['datacategory'] = $this->M_blog->data_kategori()->result();

        #pagination
        $jumlah_data = $this->M_blog->jumlah_data_blog();
        $config['base_url'] = base_url().'pages/blog/';
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
        $config['per_page'] = 5;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['datablog'] = $this->M_blog->data_blog_pagination($config['per_page'],$from);     
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/blog', $data);
    }

    function blog_detail($post_slug){
        $data['profile'] = $this->M_company->data_company()->row();
        $data['title'] = "blog | ".$data['profile']->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'blog' => "sale-noti", 'contact' => '', 'service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        
        $data['blogdetail'] = $this->M_blog->data_blog_slug($post_slug)->row();
        $data['datacategory'] = $this->M_blog->data_kategori()->result();
        
        #add read count
        $count = $data['blogdetail']->post_read+1;
        $data_read = array('post_read' => $count);
        $update_count = $this->M_blog->update_blog_save($data['blogdetail']->idblogpost, $data_read);
        $data['header'] = $this->load->view('header_blog', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/blog_detail', $data);
    }


    function blog_category(){
        $data['profile'] = $this->M_company->data_company()->row();
        $data['title'] = "blog | ".$data['profile']->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'blog' => "sale-noti", 'contact' => '','service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['datacategory'] = $this->M_blog->data_kategori()->result();

        #pagination
        $id = $this->uri->segment(3);
        $jumlah_data = $this->M_blog->jumlah_data_blog_category($id);
        $config['base_url'] = base_url().'pages/blog-category/'.$id.'/';
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
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data['datablog'] = $this->M_blog->data_blog_pagination_category($config['per_page'],$from, $id);     
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/blog', $data);
    }
    
    function search_blog(){
        $search = $this->input->get('post');
        $data['profile'] = $this->M_company->data_company()->row();
        $data['profile']  = $this->M_company->data_company()->row();
        $data['title'] = "blog | ".$data['profile'] ->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'blog' => "sale-noti", 'contact' => '','service' => '','terms'=>'', 'privacy' => '', 'cekresi' => '', 'gallery'=>'');
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['datacategory'] = $this->M_blog->data_kategori()->result();

        #pagination
        $jumlah_data = $this->M_blog->jumlah_data_blog_search($search);
        if($jumlah_data == 0){
            $jumlah_data = $jumlah_data - 1;   
        }
        $config['base_url'] = base_url().'pages/blog-search';
        $config['use_page_numbers'] = TRUE;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
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
        $config['per_page'] = 1;
        $config['uri_segment'] = 3;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['datablog'] = $this->M_blog->data_blog_search($config['per_page'],$from, $search);     
        
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/blog', $data);
    }
    
}