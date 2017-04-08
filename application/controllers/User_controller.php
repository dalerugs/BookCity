<?php

class User_controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function login(){
    
        $username=$this->input->post['username'];
        $password=$this->input->post['password'];
        
        $query=$this->user_model->Login($username,$password);
        
        if($query){
            $data=array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('pages/home');
        }
        else{
            $data['error']='Incorrect username or password. Pleas try again.';
            $this->load->view('templates/header_landing',$data);
            $this->load->view('pages/landing',$data);    
        }
    }
}
