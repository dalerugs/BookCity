<?php

class SIgn_Up extends CI_Controller {
    public function index(){
        session_destroy();
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => ""
        );
        $this->load->view('templates/header',$data);
        $this->load->view('pages/sign_up');
        $this->load->view('templates/footer');
    }
    
    public function register(){
        $data=$_POST;
        $data['token']= $this->generate_token();
        $this->load->model('sign_up_model');
        $this->sign_up_model->Register($data);
        
        $link=base_url().'my_account/confirm_email?token='.$data['token'];
        $subject = "Book City: Confirm Email";
	$Emessage = "Click this link to confirm your email: $link";
	$headers = 'From: BookCity@bookcity.com';
	mail($data['email'], $subject, $Emessage,$headers);
        
        echo '<script>alert("You have succesfully registered.");</script>';
               redirect(base_url().'my_account/index/profile', 'refresh');
    }
    
    private function generate_token(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $token = '';
        $length=32;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $token;
    }
}
