<?php 
class Error extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404');
        $this->data['heading'] = "Page not found"; 
        $this->data['message'] = "Please try again"; 
        $this->load->view('errors/html/error_404', $this->data);//loading in my template 
     } 
    } 
    ?>