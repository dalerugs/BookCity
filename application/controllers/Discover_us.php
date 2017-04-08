<?php

class Discover_us extends CI_Controller {
    public function __construct() {
        parent:: __construct();
        $this->load->library('pagination');
        $this->load->model('library_model');
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => "",
        );
        
        $data['genres']=$this->library_model->get_genres();
        if(empty($_SESSION['user_id'])){
            $this->load->view('templates/header',$data);
        }
        else if (!empty($_SESSION['user_id'])){
            $this->load->model('landing_model');
            $data['is_change_password']=$this->landing_model->is_change_password();
            $data['is_confirmed']=$this->landing_model->is_confirmed();
            $data['notif']=$this->landing_model->get_notif();
            $this->load->model('messenger_model');
            $data['mes_notif']=$this->messenger_model->get_mes_notif();
            $this->load->view('templates/header_user',$data);
            
        }
        
        
    }
    
    public function dis(){
        $this->load->view('pages/discover_us');
        $this->load->view('templates/footer');  
    }
}
