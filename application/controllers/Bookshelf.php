<?php

class Bookshelf extends CI_Controller {
    public function __construct() {
        parent:: __construct();
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
            $this->load->model('messenger_model');
            $data['mes_notif']=$this->messenger_model->get_mes_notif();
            $this->load->view('templates/header_user',$data);
        }
        
        
        
        $this->load->helper("url");
        $this->load->model('bookshelf_model');
        $this->load->library('pagination');
        $this->load->view('pages/bookshelf');
    }
    
    public function my_books(){
        $data['keyword']="";
        $data['error']="";
        $filter="";
        
        if(isset($_POST['all'])){ $filter="all"; }
        if(isset($_POST['auction'])){ $filter="auction"; }
        if(isset($_POST['sell'])){ $filter="sell"; }
        
        if (isset($_POST['search'])){ $data['keyword']=$_POST['keyword'];  }
        
        
        
        if($this->bookshelf_model->record_count($filter,$data['keyword'])==0){
            $data['error']="No books to display";
        }
        
        $config = array();
        $config["base_url"] = base_url() . "bookshelf/my_books";
        $config["total_rows"] = $this->bookshelf_model->record_count($filter,$data['keyword']);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->bookshelf_model->Get_Books($config["per_page"], $page,$filter,$data['keyword']);
        $data["links"] = $this->pagination->create_links();
        $data['book_id']="";
        $data['title']="";
        $data['remove']=FALSE;
        
        if(isset($_POST['remove'])){
            $book=$this->bookshelf_model->view_book($_POST['book_id']);
            $data['title']=$book['title'];
            $data['book_id']=$_POST['book_id'];
            $data['remove']=TRUE;
        }

        $this->load->view("pages/bookshelf/my_books", $data);
        $this->load->view('templates/footer');
    }
    
    
    public function add_book(){
          $this->load->model('bookshelf_model');
                $data['genres']=$this->bookshelf_model->get_genres();
                $this->load->view('pages/bookshelf/add_book',$data);
                $this->load->view('templates/footer');
    }
    
    public function remove_book($book_id){
        
        $this->bookshelf_model->remove_book($book_id); 
        echo '<script>alert("Book was succesfully removed from your bookshelf.");</script>';
               redirect(base_url().'bookshelf/my_books', 'refresh');
    }
    
    

    public function add_book_action(){
          $book=$_POST;
          $url= $this->do_upload();
          $this->load->model('bookshelf_model');
          $this->bookshelf_model->Add_Book($book,$url);
          echo '<script>alert("Book was succesfully added to your bookshelf.");</script>';
               redirect(base_url().'bookshelf/my_books', 'refresh');
    }

        private function do_upload(){
        $get_type1 = explode('.', $_FILES["photo1"]["name"]);
        $type1 = strtolower($get_type1[count($get_type1)-1]);
        $url1 = "./uploads/a".uniqid(rand()).'.'.$type1;
        move_uploaded_file($_FILES["photo1"]["tmp_name"],$url1);
        $url[]=$url1;
        if(!empty($_FILES["photo2"]["tmp_name"])){
            $get_type2 = explode('.', $_FILES["photo2"]["name"]);
            $type2 = strtolower($get_type2[count($get_type2)-1]);
            $url2 = "./uploads/b".uniqid(rand()).'.'.$type2;
            move_uploaded_file($_FILES["photo2"]["tmp_name"],$url2);
            $url[]=$url2;
          }
        if(!empty($_FILES["photo3"]["tmp_name"])){
            $get_type3 = explode('.', $_FILES["photo3"]["name"]);
            $type3 = strtolower($get_type3[count($get_type3)-1]);
            $url3 = "./uploads/c".uniqid(rand()).'.'.$type3;
            move_uploaded_file($_FILES["photo3"]["tmp_name"],$url3);
            $url[]=$url3;
          }
          return $url;
          
          
    }
    
    public function book($book_id){
        
        if(isset($_GET['from_notification'])){
            $this->load->model('landing_model');
            $this->landing_model->seen_notif($book_id,$_GET['type']);
            redirect(current_url());
        }
        
        
        if($this->bookshelf_model->is_inactive($book_id)){
            show_404();
        }else{
        $data=$this->bookshelf_model->view_book($book_id);
        $data['remove']=FALSE;
        $data['photos']=FALSE;
        $data['confirm_remove']=FALSE;
        $data['err_message']="";
        $data['remove_photo']="";
        $data['reviews']=$this->bookshelf_model->Get_Reviews($book_id);
        
        if(empty($data['photo2'])){
            $data['photo2']="";
        }
        if(empty($data['photo3'])){
            $data['photo3']="";
        }
        
        
        
        if(isset($_POST['remove'])){
            $data['remove']=TRUE;
        }
        
        if(isset($_POST['change_photos'])){
            $data['photos']=TRUE;
        }
        
        if(isset($_POST['change_photo1'])){
            if(empty($_FILES['photo1']['name'])){
                $data['photos']=TRUE;
                $data['err_message']="Please choose an image first";
            }
            else{
                $data['photos']=FALSE;
                $this->change_photos('a' ,'photo1', $data['photo1'],$book_id);
            }  
        }
        if(isset($_POST['change_photo2'])){
            if(empty($_FILES['photo2']['name'])){
                $data['photos']=TRUE;
                $data['err_message']="Please choose an image first";
            }
            else{
                $data['photos']=FALSE;
                $this->change_photos('b' ,'photo2', $data['photo2'],$book_id);
            }  
        }
        if(isset($_POST['change_photo3'])){
            if(empty($_FILES['photo3']['name'])){
                $data['photos']=TRUE;
                $data['err_message']="Please choose an image first";
            }
            else{
                $data['photos']=FALSE;
                $this->change_photos('c' ,'photo3', $data['photo3'],$book_id);
            }  
        }
        
        if(isset($_POST['remove_photo2'])){
            $data['remove_photo']=$data['photo2'];
            $data['confirm_remove']=TRUE;
        }
        if(isset($_POST['remove_photo3'])){
            $data['remove_photo']=$data['photo3'];
            $data['confirm_remove']=TRUE;
        }
        
        if(isset($_POST['close'])){
            $this->bookshelf_model->update_auction_status(TRUE,$book_id);
            redirect(base_url()."bookshelf/book/".$book_id, 'refresh');
        }
        if(isset($_POST['open'])){
            $this->bookshelf_model->update_auction_status(FALSE,$book_id);
            redirect(base_url()."bookshelf/book/".$book_id, 'refresh');
        }
        
        $this->load->view("pages/bookshelf/book",$data);
        $this->load->view('templates/footer');
    }
    }
    
    public function edit_book($book_id){
       
        
        
        $data=$this->bookshelf_model->view_book($book_id);
        $data['genres']=$this->bookshelf_model->get_genres();
        
        
        
        if(isset($_POST['save_changes'])){
            $this->bookshelf_model->edit_book($book_id,$_POST);
            
            echo '<script>alert("Update Successful");</script>';
            redirect(base_url()."bookshelf/book/".$book_id, 'refresh');
        }
        
        $this->load->view("pages/bookshelf/edit_book",$data);
        $this->load->view('templates/footer');
        
        
    }
    
    public function change_photos($code,$index,$old_url,$book_id){
        $get_type1 = explode('.', $_FILES[$index]["name"]);
        $type1 = strtolower($get_type1[count($get_type1)-1]);
        $new_url = "./uploads/".$code.uniqid(rand()).'.'.$type1;
        move_uploaded_file($_FILES[$index]["tmp_name"],$new_url);
        if($old_url!=""){
            unlink($old_url);
        }
        
        $this->bookshelf_model->change_photo($old_url,$new_url,$book_id);
        echo '<script>alert("Photos was succesfully updated");</script>';
            redirect(base_url()."bookshelf/book/".$book_id, 'refresh');
        
    }
    
    public function remove_photo($book_id){
        $this->bookshelf_model->remove_photo($book_id,$_POST['remove_photo']);
        unlink($_POST['remove_photo']);
        echo '<script>alert("Photos was succesfully removed");</script>';
            redirect(base_url()."bookshelf/book/".$book_id, 'refresh');
    }
    
    public function post_review(){
        $this->load->model('library_model');
        $this->library_model->Post_Review($_POST);
        echo '<script>alert("Your Comment/Review was succesfully posted");</script>';
               redirect(base_url().'bookshelf/book/'.$_POST['book_id'], 'refresh');
    }
    
    public function post_reply(){
        $this->load->model('library_model');
        $this->library_model->Post_Reply($_POST);
        echo '<script>alert("Your Reply was succesfully posted");</script>';
               redirect(base_url().'bookshelf/book/'.$_POST['book_id'], 'refresh');
    }
    
    public function auction_control($book_id){
        
        if(isset($_GET['from_notification'])){
            $this->load->model('landing_model');
            $this->landing_model->seen_notif($book_id,$_GET['type']);
            redirect(current_url());
        }
        
        $action=false;
        if(isset($_GET['action'])){
            if($_GET['action']=='OPEN'){$action=0;}else if($_GET['action']=='CLOSE'){$action=1;}else if($_GET['action']=='SOLD'){$action=2;}
            $this->bookshelf_model->update_auction_status($action,$book_id);
        }
        
        if(isset($_GET['change'])){
            $this->bookshelf_model->change_fixed_increment($_GET['auction_id'],$_GET['fixed_increment']);
        }
        
        
        
        
        $this->load->model('auction_model');
        $data=array();
        if($this->bookshelf_model->is_auction($book_id)){
            
            $data['book']= $this->bookshelf_model->auction_fetch_book($book_id);
            $data['bidders']= $this->bookshelf_model->auction_fetch_bidders($book_id);
            $data['bidding_log']= $this->bookshelf_model->auction_fetch_bidding_log($book_id);
            
            $this->load->view("pages/bookshelf/auction_control",$data);
            $this->load->view('templates/footer');
        }
        else 
        {
            show_404();
        }
    }
    
    public function notifications(){
        $data=array();
        $this->load->model('landing_model');
        $data['notifs']=$this->landing_model->display_get_notifs($_SESSION['user_id']);
        $this->load->view("pages/bookshelf/notifications", $data);
        $this->load->view('templates/footer');
    }
    
    public function messages(){
        $data=array();
        $this->load->model('messenger_model');
        $data['conversations']=$this->messenger_model->get_all_conversations($_SESSION['user_id']);
        $data['messages']=array();
        
        if(isset($_GET['id'])){
            $data['messages']=$this->messenger_model->get_conversations($_GET['id'],$_SESSION['user_id']);
            $this->messenger_model->isSeen($_GET['id'],$_SESSION['user_id'],'messenger');
            $link= current_url()."?id=".$_GET['id']."&name=".$_GET['name'];
            if(isset($_GET['from_notif'])){
                redirect($link);
            }
        }
        
        if(isset($_POST['send'])){
            $this->messenger_model->send_message($_POST,'seller');
            redirect(current_url().$_POST['link']);
        }
        
        $this->load->view("pages/bookshelf/messages", $data);
        $this->load->view('templates/footer');
    }
        
}
