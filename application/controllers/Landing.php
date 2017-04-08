<?php

class Landing extends CI_Controller {
   
    
    public function index($data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => ""
        )){
        if(empty($_SESSION['user_id'])){
            $this->load->view('templates/header_landing',$data);
            $this->load->view('pages/landing');
        }
        else if (!empty($_SESSION['user_id'])){
            $this->load->view('templates/header_landing_user',$data);
            $this->load->view('pages/landing');
        }
    }
    
    public function login(){
        
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => ""
        );
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        $this->load->model('landing_model');
        $query=$this->landing_model->Login($username,$password);
        
        if(empty($username) || empty($password)){
            $data['error']='Please fill all fields.';
            $this->index($data);
        }
        else if($query){
            redirect(base_url().'bookshelf/my_books');
        }
        else{
            $data['error']='Incorrect username or password. Please try again.';
            $this->index($data);
        }
    }
    
    public function forgot(){
        
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => ""
        );
                
        $forgotten=$_POST['forgotten'];
        
        $this->load->model('landing_model');
        
        
        if(empty($forgotten)){
            $data['erMessage']='Enter your username or email.';
            $this->index($data);
        }
        else if($this->landing_model->Forgot($forgotten)){
            $data['success_message']='Account found';
            $data['message']='Your new password has been sent to your email.';
            $this->index($data);
        }
        else{
            $data['erMessage']='No account found.';
            $this->index($data);
        }
        
        
    }
    
}
