<?php


class Auction extends CI_Controller{
    public function __construct() {
        parent:: __construct();
        
        $this->load->model('auction_model');
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
    
    public function bidder(){
        $data=array();
        $data['is_welcome']=FALSE;
        if(isset($_GET['welcome'])){
            $data['is_welcome']=TRUE;
        }
        $data['token']=$_GET['token'];
        $data['link']=base_url().'auction/bidder?token='.$data['token'];
        
        if($this->auction_model->check_bidder($data['token'])){
            $data+=$this->auction_model->get_book($data['token']);
            if($data['inactive']){
                show_404();
            }else{
            $this->load->model('library_model');
            $data['reviews']=$this->library_model->Get_Reviews($data['book_id']);
            $this->load->view('pages/bidder',$data);
            $this->load->view('templates/footer');
            }
        } else {
            show_404();
        }
        
        
        
        
    }
    
    public function new_bidder(){
        $token= $this->generate_token();
        $bidder=$_POST;
        $bidder['token']=$token;
        $this->auction_model->new_bidder($bidder);
        
        $link=base_url().'auction/bidder?token='.$token;
        $subject = "Book City: Bidding Link";
	$Emessage = "You can always go to this link to bid and see the auction status: $link";
				
	$headers = 'From: BookCity@bookcity.com';
	mail($bidder['b_email'], $subject, $Emessage,$headers);
        
        redirect(base_url().'auction/bidder?welcome=1&token='.$token,'refresh');
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
    
    public function place_bid(){
        $bid['user_id']=$_POST['user_id'];
        $bid['book_id']=$_POST['book_id'];
        $bid['type']="bidding";
        $bid['notif_date']=date("Y-m-d H:i:s");
        $bid['photo']=$_POST['photo'];
        $bid['title']=$_POST['title'];
        $bid['name']=$_POST['name'];
        $bid['description']="bid Php ".$_POST['bid_price']." to your book";
        $this->load->model('landing_model');
        $this->landing_model->update_notif($bid);
        
        $data=$_POST;
        $this->auction_model->place_bid($data);
        redirect($data['link'],'refresh');
    }
    
    public function rate_seller(){
        $this->load->model('library_model');
        $this->library_model->rate_seller($_POST);
        redirect($_POST['link'], 'refresh');
    }
    
    public function post_review(){
        $this->load->model('library_model');
        $this->library_model->Post_Review($_POST);
        echo '<script>alert("Your Comment/Review was succesfully posted");</script>';
               redirect($_POST['link'], 'refresh');
    }
    
    public function post_reply(){
        $this->load->model('library_model');
        $this->library_model->Post_Reply($_POST);
        echo '<script>alert("Your Reply was succesfully posted");</script>';
               redirect($_POST['link'], 'refresh');
    }
}
