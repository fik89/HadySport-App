 <?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Sendemail extends CI_Controller { 
   public function __construct() {
    parent::__construct();
    $this->load->model(array('M_email_sender'));
    $this->load->database();
    $this->load->library('cart');
  }

  public function send()
  {  
    $subject = $this->input->post('subject');
    $mailto = $this->input->post('mailto');
    $msg = $this->input->post('message');

    $dataemail =  $this->M_email_sender->data_email_sender()->row();
    {  
      $config = Array(  
        'protocol' => $dataemail->protocol,  
        'smtp_host' => $dataemail->smtp_host,  
        'smtp_port' => $dataemail->smtp_port,  
        'smtp_user' => $dataemail->smtp_user,   
        'smtp_pass' => $dataemail->smtp_pass,   
        'mailtype' => $dataemail->mailtype,   
        'charset' => $dataemail->charset  
        );  
      $this->load->library('email', $config);  
      $this->email->set_newline("\r\n");  
      $this->email->from('dansdmedia@gmail.com', 'Admin Re:Code');   
      $this->email->to('dahrianshor@gmail.com');   
      $this->email->subject('Percobaan email');   
      $this->email->message('');  
      if (!$this->email->send()) {  
        show_error($this->email->print_debugger());   
      }else{  
        echo 'Success to send email';   
      }  
    } 

  } 
}