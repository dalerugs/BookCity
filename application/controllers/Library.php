<?php

class Library extends CI_Controller {
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
        $this->load->view('pages/library',$data);
       
    }
    

    public function home(){
        $data['search']="";
        $this->load->model('library_model');
        $data['latest']=$this->library_model->latest_uploads();
        $data['onSale']=$this->library_model->books_onSale();
        $data['on_Auction']=$this->library_model->books_onAuction();
        $this->load->view('templates/search',$data);
        $this->load->view('pages/library/home',$data);
        $this->load->view('templates/footer');
    }
    
    public function book($book_id){
        if($this->library_model->is_inactive($book_id)){
            show_404();
        }else{
        $data=$this->library_model->view_book($book_id);
        $data['reviews']=$this->library_model->Get_Reviews($book_id);
        $data['search']="";
        $data['confirmation']=FALSE;
        $data['message']=FALSE;
        $data['gen_code']='';
        $data['m_gen_code']='';
        $data['b_name']="";
        $data['b_email']="";
        $data['b_contact']="";
        $data['gen_code']="";
        $data['m_name']="";
        $data['m_email']="";
        $data['m_contact']="";
        
        if(isset($_POST['join'])){
            $data['confirmation']=TRUE;
            $data['b_name']=$_POST['b_name'];
            $data['b_email']=$_POST['b_email'];
            $data['b_contact']=$_POST['b_contact'];
            $data['gen_code']= $this->gen_confirm_code($data['b_email'],'Bid');
        }
        
        if(isset($_POST['continue'])){
            $data['message']=TRUE;
            $data['m_name']=$_POST['m_name'];
            $data['m_email']=$_POST['m_email'];
            $data['m_contact']=$_POST['m_contact'];
            $data['m_gen_code']= $this->gen_confirm_code($data['m_email'],'Message');
        }
        
        $this->load->view('templates/search',$data);
        $this->load->view("pages/library/book",$data);
        $this->load->view('templates/footer');
    }
    
        }
    
    function gen_confirm_code($email,$type){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';
        $length=6;
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $subject = "Book City: $type Confirmation Code";
	$Emessage = "Your $type confirmation code: \n\n
				code: '$code' ";
	$headers = 'From: mail.bookcity@gmail.com';
	mail($email, $subject, $Emessage,$headers);
        
        return $code;
    }
    
    public function new_messenger(){
        $data=$_POST;
        $data['token']= $this->generate_token();
        $this->library_model->new_messenger($data);
        
        $link=base_url().'messenger/mes?token='.$data['token'];
        $subject = "Book City: Messenger Link";
	$Emessage = "You can always go to this link to see the messages: $link";
				
	$headers = 'From: BookCity@bookcity.com';
	mail($data['email'], $subject, $Emessage,$headers);
        
        redirect($link);
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


    public function post_review(){
        $data['user_id']=$_POST['user_id'];
        $data['book_id']=$_POST['book_id'];
        $data['type']="comment";
        $data['notif_date']=date("Y-m-d H:i:s");
        $data['photo']=$_POST['photo'];
        $data['title']=$_POST['title'];
        $data['description']="posted a comment/review on your book";
        
        if(empty($_SESSION['user_id'])){
            $data['name']=$_POST['name'];
            $this->load->model('landing_model');
            $this->landing_model->update_notif($data);
        }else{
            if($_POST['user_id']!=$_SESSION['user_id']){
                $data['name']=$_SESSION['name'];
                $this->load->model('landing_model');
                $this->landing_model->update_notif($data);
            }
        }
        
        $this->library_model->Post_Review($_POST);
        echo '<script>alert("Your Comment/Review was succesfully posted");</script>';
               redirect(base_url().'library/book/'.$_POST['book_id'], 'refresh');
    }
    
    public function post_reply(){
        $data['user_id']=$_POST['user_id'];
        $data['book_id']=$_POST['book_id'];
        $data['type']="comment";
        $data['notif_date']=date("Y-m-d H:i:s");
        $data['photo']=$_POST['photo'];
        $data['title']=$_POST['title'];
        $data['description']="replied to a post on your book";
        
        if(empty($_SESSION['user_id'])){
            $data['name']=$_POST['name'];
            $this->load->model('landing_model');
            $this->landing_model->update_notif($data);
        }else{
            if($_POST['user_id']!=$_SESSION['user_id']){
                $data['name']=$_SESSION['name'];
                $this->load->model('landing_model');
                $this->landing_model->update_notif($data);
            }
        }
        $this->library_model->Post_Reply($_POST);
        echo '<script>alert("Your Reply was succesfully posted");</script>';
               redirect(base_url().'library/book/'.$_POST['book_id'], 'refresh');
    }
    
    public function Genre($genre){
        $books=array();
        $books['genre']=urldecode($genre);
        $data['search']="";
        
        if($this->library_model->record_count_genre($books['genre'])==0){
            $books['error']="No books to display";
        }
        
        $config = array();
        $config["base_url"] = base_url()."library/genre/".$books['genre'];
        $config["total_rows"] = $this->library_model->record_count_genre($books['genre']);
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $books["results"] = $this->library_model->Get_Books_Genre($config["per_page"], $page,$books['genre']);
        $books["links"] = $this->pagination->create_links();
        
        $this->load->view('templates/search',$data);
        $this->load->view("pages/library/genre",$books);
        $this->load->view('templates/footer');
    }
    
    public function search_book(){
        $books=array();
        
        if(isset($_GET['search'])){
            $_SESSION['search']=$_GET['search'];
        }
        
        $data['search']=$_SESSION['search'];
   
        
        
        
        if($this->library_model->record_count_search($data['search'])==0){
            $books['error']="No books to display";
        }
        
        $config = array();
        $config["base_url"] = base_url()."library/search_book";
        $config["total_rows"] = $this->library_model->record_count_search($data['search']);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $books["results"] = $this->library_model->Get_Book_Search($config["per_page"], $page,$data['search']);
        $books["links"] = $this->pagination->create_links();
        
        $this->load->view('templates/search',$data);
        $this->load->view("pages/library/search_book",$books);
        $this->load->view('templates/footer');
    }
    
    public function rate_seller(){
        $this->library_model->rate_seller($_POST);
        redirect(base_url().'library/book/'.$_POST['book_id'], 'refresh');
    }
    
    public function report_seller(){
        $this->library_model->report_seller($_POST);
        redirect(base_url().'library/book/'.$_POST['book_id'].'?r_success=1', 'refresh');
    }

    




    public function logout(){
        session_destroy();
        if(isset($_GET['login'])){
            redirect(base_url().'?login=1');
        }else{
            redirect(base_url());
        }
        
    }
    
   
    
    
}
