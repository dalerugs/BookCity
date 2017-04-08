<?php

class Pages extends CI_Controller {
    public function index($page='home'){
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => ""
        );
        
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
        if(empty($_SESSION['user_id'])){
            $this->load->view('templates/header',$data);
        }
        else if (!empty($_SESSION['user_id'])){
            $this->load->view('templates/header_user');
        }
        
        $this->load->view('templates/footer');
       
        
    }
    
    


    public function logout(){
        session_destroy();
        redirect(base_url());
        exit();
    }
}
