<?php

class My_account extends CI_Controller{
    public function index($view='profile'){
        if(!file_exists(APPPATH.'views/pages/my_account/'.$view.'.php')){
            show_404();
        }
        
        $data=array(
        'error'=>"",
        'erMessage' => "",
        'success_message' => "",
        'message' => "",
        );
        
        if(empty($_SESSION['user_id'])){
            redirect(base_url());
        }
        else if (!empty($_SESSION['user_id'])){
            $this->load->model('landing_model');
            $data['is_change_password']=$this->landing_model->is_change_password();
            $data['is_confirmed']=$this->landing_model->is_confirmed();
            $data['notif']=$this->landing_model->get_notif();
            $data['notif']=$this->landing_model->get_notif();
            $this->load->model('messenger_model');
            $data['mes_notif']=$this->messenger_model->get_mes_notif();
            $this->load->view('templates/header_user',$data);
        }
        
        
        $this->load->view('pages/my_account');
        $this->load->model('my_account_model');
        $Account=$this->my_account_model->My_account();
        
        
        
        switch ($view) {
            case 'profile':
                $this->load->view('pages/my_account/profile',$Account);
                $this->load->view('templates/footer');
                break;
            case 'edit_profile':
                $this->load->view('pages/my_account/edit_profile',$Account);
                $this->load->view('templates/footer');
                break;
            case 'account_settings':
                $data=array(
                    'er_change_username' => "",
                    'er_change_email' => "",
                    'er_change_password' => ""
                );
                $this->load->view('pages/my_account/account_settings',$data+$Account);
                $this->load->view('templates/footer');
                break;
        }
        
        
        
    }
    
    public function edit_profile() {
        $getPost=$_POST;
        $this->load->model('my_account_model');
        $this->my_account_model->Edit_Account($getPost);
        echo '<script>alert("Update succesful.");</script>';
        redirect('profile', 'refresh');
           
        
        
        
    }
    
    public function change_username(){
        $this->load->model('my_account_model');
        $this->my_account_model->Change_Username($_POST['username']);
        echo '<script>alert("Update succesful.");</script>';
               redirect('account_settings', 'refresh');
    }
    public function change_email(){
        $this->load->model('my_account_model');
        $this->my_account_model->Change_Email($_POST['email']);
        
        
        $data['token']= $this->generate_token();
        $this->my_account_model->update_token($data['token']);
        $link=base_url().'my_account/confirm_email?token='.$data['token'];
        $subject = "Book City: Confirm Email";
	$Emessage = "Click this link to confirm your email: $link";
	$headers = 'From: BookCity@bookcity.com';
	mail($_POST['email'], $subject, $Emessage,$headers);
        
        
        echo '<script>alert("Update succesful.");</script>';
               redirect('account_settings', 'refresh');
    }
    public function change_password(){
        $this->load->model('my_account_model');
        $this->my_account_model->Change_Password($_POST['con_pass']);
        echo '<script>alert("Update succesful.");</script>';
               redirect('account_settings', 'refresh');
    }
    
    public function confirm_email(){
        $this->load->model('my_account_model');
        $confirm_email=$this->my_account_model->confirm_email($_GET['token'],$_SESSION['user_id']);
        if($confirm_email){
            echo '<script>alert("Your email was succesfully confirmed.");</script>';
            redirect(base_url().'my_account/index/profile', 'refresh');
        } else {
            show_404();
        }
    }
    
    public function resend_confirmation(){
        $this->load->model('my_account_model');
        $data=$this->my_account_model->My_Account();
        $data['token']= $this->generate_token();
        $this->my_account_model->update_token($data['token']);
        $link=base_url().'my_account/confirm_email?token='.$data['token'];
        $subject = "Book City: Confirm Email";
	$Emessage = "Click this link to confirm your email: $link";
	$headers = 'From: BookCity@bookcity.com';
	mail($data['email_address'], $subject, $Emessage,$headers);
        
        echo '<script>alert("Confirmation link was send to your email.");</script>';
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
