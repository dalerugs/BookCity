<?php


class Admin extends CI_Controller {
     public function __construct() {
        parent:: __construct();
        $this->load->model('admin_model');
        $this->load->view('pages/admin/head');
        
    }
    
    public function admin_login(){
        if(isset($_GET['token'])){
            if($_GET['token']==$this->admin_model->login_token()){
                $this->load->view('pages/admin/login');
                if(isset($_POST['login'])){
                    
                    if($this->admin_model->login($_POST)){
                        redirect(base_url().'admin/stat');
                    } else {
                        redirect(base_url().'admin/admin_login?token=scrum178c&invalid=1');
                    }
                }
            } else {
                show_404();
            }   
        } else {
            show_404();
        }
        $this->load->view('pages/admin/foot');
    }
    
    public function users(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $this->load->view('pages/admin/users_nav');
            $this->load->view('pages/admin/users');
            $this->load->view('pages/admin/foot');
        }
    }
    public function reported(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data['users']= $this->admin_model->get_reported_users();
            $this->load->view('pages/admin/users_nav');
            $this->load->view('pages/admin/reported_users',$data);
            $this->load->view('pages/admin/foot');
        }
    }
    public function report($user_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data= $this->admin_model->get_reported_user($user_id);
            $this->load->view('pages/admin/users_nav');
            $this->load->view('pages/admin/reported_user',$data);
            $this->load->view('pages/admin/foot');
        }
    }
    
     public function top(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data['users']= $this->admin_model->get_top_users();
            $this->load->view('pages/admin/users_nav');
            $this->load->view('pages/admin/top_users',$data);
            $this->load->view('pages/admin/foot');
        }
    }


    public function stat(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data=$this->admin_model->get_stats();
            $this->load->view('pages/admin/statistics',$data);
            $this->load->view('pages/admin/foot');
        }
    }
    

        public function admins(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $data['admins']= $this->admin_model->get_admins();
                $data['token']=$this->admin_model->login_token();
                if(isset($_POST['create'])){
                    $this->admin_model->create_admin($_POST);
                    redirect(base_url().'admin/admins');
                }
                
                
                $this->load->view('pages/admin/nav_sa');
                $this->load->view('pages/admin/admins',$data);
            } else {
                show_404();
            }
            $this->load->view('pages/admin/foot');
        }
        
    }
    
    public function books(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data=$this->admin_model->get_stats();
            $this->load->view('pages/admin/books',$data);
            $this->load->view('pages/admin/foot');
        }
    }
    
    
    
    public function book($book_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data=$this->admin_model->get_book($book_id);
            $data['reviews']=$this->admin_model->Get_Reviews($book_id);
            $this->load->view('pages/admin/book',$data);
            $this->load->view('pages/admin/foot');
        }
    }


    public function edit($admin_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $data = $this->admin_model->get_admin($admin_id);
                if(isset($_POST['save'])){
                    $this->admin_model->edit_admin($_POST);
                    redirect(base_url().'admin/admins');
                }
                
                
                $this->load->view('pages/admin/nav_sa');
                $this->load->view('pages/admin/edit_admin',$data);
            } else {
                show_404();
            }
            $this->load->view('pages/admin/foot');
        }
        
    }


    public function ac_admin($admin_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->admin_model->change_admin_status(FALSE,$admin_id);
                redirect(base_url().'admin/admins');
            } else {
                show_404();
            }
        }
    }
    public function deac_admin($admin_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->admin_model->change_admin_status(TRUE,$admin_id);
                redirect(base_url().'admin/admins');
            } else {
                show_404();
            }
        }
    }
    
    public function ac_user($user_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
                $this->admin_model->change_user_status(FALSE,$user_id);
                
                if(isset($_GET['users'])){
                    redirect(base_url().'admin/reported');
                }else if(isset($_GET['user'])){
                    redirect(base_url().'admin/report/'.$user_id);
                }else{
                    redirect(base_url().'admin/users');
                }
        }
    }
    public function deac_user($user_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
                $this->admin_model->change_user_status(TRUE,$user_id);
                if(isset($_GET['users'])){
                    redirect(base_url().'admin/reported');
                }else if(isset($_GET['user'])){
                    redirect(base_url().'admin/report/'.$user_id);
                }else{
                    redirect(base_url().'admin/users');
                }
        }
    }
    
    public function gen_link(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $token = '';
        $length=32;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $this->admin_model->update_token($token);
        redirect(base_url().'admin/admins');
    }
    
    public function donors(){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data['donors']=$this->admin_model->get_donors();
            $this->load->view('pages/admin/donors',$data);
            $this->load->view('pages/admin/foot');
        }
    }
    
    public function donor($donor_id){
        if(empty($_SESSION['admin_id'])){
            show_404();
        }else{
            if($_SESSION['admin_type']=='SA'){
                $this->load->view('pages/admin/nav_sa');
                
            } else {
                $this->load->view('pages/admin/nav_ad');
            }
            $data=$this->admin_model->get_donor($donor_id);
            $this->load->view('pages/admin/donor',$data);
            $this->load->view('pages/admin/foot');
        }
    }

    public function logout(){
        session_destroy();
        redirect(base_url().'admin/admin_login?token='.$this->admin_model->login_token());
    }
}
