<?php


class Donate extends CI_Controller {
    public function __construct() {
        parent:: __construct();
        $this->load->model('donate_model');
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
    
    public function be_a_donor(){
        $data['success']=FALSE;
        if(isset($_POST['send'])){
            $this->donate_model->send_message($_POST);
            $data['success']=TRUE;
        }
        
        $this->load->view('pages/donate',$data);
        $this->load->view('templates/footer');
    }
}
