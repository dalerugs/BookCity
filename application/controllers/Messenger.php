<?php


class Messenger extends CI_Controller {
     public function __construct() {
        parent:: __construct();
        $this->load->model('messenger_model');
        if(!isset($_GET['token'])){
            show_404();
        }
        else if(!$this->messenger_model->check_token($_GET['token'])){
            show_404();
        } else {
            
        
        
        
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => "",
        );
        
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
    }
    
    public function mes(){
        $token=$_GET['token'];
        $data=$this->messenger_model->get_profile($token);
        $data['conversations']=$this->messenger_model->get_conversations($data['messenger_id'],$data['user_id']);
        $this->messenger_model->isSeen($data['messenger_id'],$data['user_id'],'seller');
        if(isset($_POST['send'])){
            $this->messenger_model->send_message($_POST,'messenger');
            redirect(current_url()."?token=$token");
        }
        
        
        $this->load->view('pages/messenger',$data);
        $this->load->view('templates/footer');
    }
    
}
