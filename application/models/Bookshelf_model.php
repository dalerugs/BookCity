<?php

class Bookshelf_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_genres(){
        $this->db->select('genre');
        $this->db->from('genres');
        $this->db->order_by("genre", "asc");
        $genre = $this->db->get();
        $result = $genre->result();
        return $result;
    }
    
    public function record_count($filter,$keyword) {
        if($keyword!=""){
            $books=$this->db->like('title', $keyword);
        }
        if($filter=='' || $filter=='all'){
            $books = $this->db->get_where('books',array('user_id' => $_SESSION['user_id'],'inactive' => FALSE));
        }
        else{
            $books=$this->db->get_where('books',array('user_id' => $_SESSION['user_id'], 'method'=>$filter));
        }
        
        return $books->num_rows();
    }
    
    public function Get_Books($limit, $start,$filter,$keyword){
   
        
        $this->db->limit($limit, $start);
        
        $this->db->select('book_id,title,author,genre,method,date_posted');
        $this->db->where('!inactive');
        $this->db->from('books');
        $this->db->order_by("date_posted", "DESC");
        if($filter=='' || $filter=='all'){
            $this->db->where('user_id',$_SESSION['user_id']);
        }
        else{
            $this->db->where(array('user_id' => $_SESSION['user_id'], 'method'=>$filter));
        }
        if($keyword!=""){
            $this->db->like('title', $keyword);
        }
        
        $query = $this->db->get();
       

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->limit(1);
                $this->db->order_by("image_url","asc");
                $image_url = $this->db->select('image_url')
                  ->get_where('book_images', array('book_id' => $row->book_id))
                  ->row()
                  ->image_url;
                
               $image['image_url']=$image_url;
               
               if($row->method=="Sell"){
                    $details=$this->db->select('*')
                                ->get_where('sell_details', array('book_id' => $row->book_id))
                                ->row();
                }
                if($row->method=="Auction"){
                    $details=$this->db->select('*')
                                ->get_where('auction_details', array('book_id' => $row->book_id))
                                ->row();
                }
            
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$details);
                
            }
            return $data;
        }
        return false;
    }

    public function Add_Book($book,$url){
    $this->db->insert('books', array(
        'user_id' => $_SESSION['user_id'],
        'title' => $book['title'],
        'author' => $book['author'],
        'genre' => $book['genre'],
        'description' => $book['description'],
        'b_condition' => $book['b_condition'],
        'method' => $book['method'],
        'date_posted' => Date("y/m/d")
        ));
    $book_id = $this->db->insert_id();
    if($book['method']=='Sell'){
        $this->db->insert('sell_details', array(
            'user_id' => $_SESSION['user_id'],
            'book_id' => $book_id,
            'price' => $book['price'],
            'discount' => $book['discount']
        ));
        $this->db->insert('auction_details', array(
            'user_id' => $_SESSION['user_id'],
            'book_id' => $book_id,
            'inactive'=>TRUE
        ));
        
    }elseif ($book['method']=='Auction') {
        $this->db->insert('auction_details', array(
            'user_id' => $_SESSION['user_id'],
            'book_id' => $book_id,
            'start_price' => $book['start_price'],
            'fixed_increment' => $book['fixed_increment']
        ));
        $this->db->insert('sell_details', array(
            'user_id' => $_SESSION['user_id'],
            'book_id' => $book_id,
            'inactive'=>TRUE
        ));
    }
    for($i=0;$i<sizeof($url);$i++){
        $this->db->insert('book_images', array(
        'book_id' => $book_id,
        'image_url' => $url[$i],
        ));
    }
    }
    
    public function remove_book($book_id){
        $book=$this->db->get_where('books',array('book_id'=>$book_id))->row_array();
        
        
        $this -> db -> where('book_id', $book_id);
        $this->db->update('books', array(
            'inactive' => TRUE
            ));
        if($book['method']=='Sell'){
        $this -> db -> where('book_id', $book_id);
        $this->db->update('sell_details', array(
            'inactive' => TRUE
            ));
        }else if($book['method']=='Auction')
        $this -> db -> where('book_id', $book_id);
        $this->db->update('auction_details', array(
            'inactive' => TRUE,
            ));
        
//        $this -> db -> delete('books');
//        $this -> db -> where('book_id', $book_id);
//        $this -> db -> delete('book_images');
//        $this -> db -> where('book_id', $book_id);
//        $this -> db -> delete('auction_details');
//        $this -> db -> where('book_id', $book_id);
//        $this -> db -> delete('sell_details');
    }
    
    public function edit_book($book_id,$book){
        $result=$this->db->get_where('books',array('book_id'=>$book_id))->row_array();
        if($result['method']=='Sell'){
            $this->db->where('book_id',$book_id );
            $this->db->update('sell_details', array(
                'inactive' => TRUE
                ));
        } else if($result['method']=='Auction'){
            $this->db->where('book_id',$book_id );
            $this->db->update('auction_details', array(
                'inactive' => TRUE
                ));
        }
        $this->db->where('book_id',$book_id );
        $this->db->update('books', array(
            'title' => $book['title'],
            'author' => $book['author'],
            'genre' => $book['genre'],
            'description' => $book['description'],
            'b_condition' => $book['b_condition'],
            'method' => $book['method'],
            ));
        
        if($book['method']=='Sell'){
        $this->db->where('book_id',$book_id );
        $this->db->update('sell_details', array(
        'book_id' => $book_id,
        'price' => $book['price'],
        'discount' => $book['discount'],
            'inactive' => FALSE
                
        ));
        $this->db->where('book_id',$book_id );
        $this->db->update('auction_details', array(
            'auction_status' => TRUE,
            'highest_bidder' => "",
            'highest_bidder_id' => 0,
            'bid_price' => 0,
            'inactive' => TRUE
            ));
        $this->db->where('book_id',$book_id );
        $this->db->update('bidding_log', array(
            'inactive' => TRUE
            ));
        }else if ($book['method']=='Auction') {
            $this->db->where('book_id',$book_id );
            $this->db->update('auction_details', array(
            'book_id' => $book_id,
            'start_price' => $book['start_price'],
            'auction_status' => FALSE,
            'fixed_increment' => $book['fixed_increment'],
                'inactive' => FALSE
            ));
    }
        
    }


    public function view_book($book_id){
        $query=$this->db->get_where('books',array('book_id' => $book_id));
        $book=$query->row_array();
        $get_image=$this->db->query("SELECT image_url FROM book_images WHERE book_id=$book_id ORDER BY image_url ASC");
        
        $i=1;
            foreach ($get_image->result() as $row) {
                $book['photo'.$i] = $row->image_url;
                $i++;
            }
            
        if($book['method']=="Sell"){
            $sell=$this->db->get_where('sell_details',array('book_id' => $book_id));
            $book += $sell->row_array();
        }
        elseif ($book['method']=="Auction") {
            $auction=$this->db->get_where('auction_details',array('book_id' => $book_id));
            $book += $auction->row_array();
        }
            
        
        
        return $book;
        
        
    }
    
    public function change_photo($old_url,$new_url,$book_id){
         $this -> db -> where(array('book_id' => $book_id, 'image_url'=> $old_url));
         $this -> db -> delete('book_images');
         $this->db->insert('book_images', array(
        'book_id' => $book_id,
        'image_url' => $new_url,
        ));
    }
    
    public function remove_photo($book_id,$url){
        $this -> db -> where(array('book_id' => $book_id, 'image_url'=> $url));
        $this -> db -> delete('book_images');
    }
    
    public function Get_Reviews($book_id){
        $data=array();
        $this->db->select('*');
        $this->db->from('reviews');
        $this->db->where(array('book_id' => $book_id));
        $this->db->order_by("created_date", "desc");
        $reviews = $this->db->get();
        
        foreach($reviews->result() as $review){
            $this->db->select('*');
            $this->db->from('replies');
            $this->db->where(array('review_id' => $review->review_id));
            $this->db->order_by("created_date", "asc");
            $get_reply = $this->db->get();
            $reply = $get_reply->result();
            
            $replies['reply']=$reply;
            
            $data[] = (object) array_merge((array)$review,(array)$replies);
            
        }
        
        return $data;
        
    }
    
    public function update_auction_status($status,$book_id){
        $this->db->update('bidders',array('is_winner'=>false));
        $this->db->where('book_id',$book_id )->update('auction_details', array('auction_status' => $status));
        if($status==2){
            $book=$this->db->get_where('auction_details',array('book_id'=>$book_id))->row_array();
            $this->db->where('bidders_id',$book['highest_bidder_id'] )->update('bidders', array('is_winner' => TRUE));
        }
    }
    
    public function is_auction($book_id){
        $book=$this->db->get_where('books',array('book_id'=>$book_id, 'method'=>'Auction'));
        
        if($book->num_rows()==0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
    }
    
    public function auction_fetch_book($book_id){
        $query=$this->db->get_where('books',array('book_id' => $book_id));
        $book=$query->row_array();
        $get_image=$this->db->query("SELECT image_url FROM book_images WHERE book_id=$book_id ORDER BY image_url ASC");
        
        $i=1;
        foreach ($get_image->result() as $row) {
            $book['photo'.$i] = $row->image_url;
            $i++;
        }
        $auction=$this->db->get_where('auction_details',array('book_id' => $book_id));
        $book += $auction->row_array();
        
        return $book;
    }
    
    public function auction_fetch_bidders($book_id){
        $data=array();
        $this->db->order_by('name','asc');
        $bidder=$this->db->get_where('bidders',array('book_id'=>$book_id));
        $data=$bidder->result();
        
        return $data;
    }
    
    public function auction_fetch_bidding_log($book_id){
        $data=array();
        
        $bids = $this->db->query("SELECT * FROM bidding_log WHERE book_id=$book_id AND !inactive ORDER BY bid_date DESC");
        $data = $bids->result();
        
        return $data;
    }
    
    public function change_fixed_increment($auction_id,$fixed_increment){
        $this->db->where('auction_id='.$auction_id);
        $this->db->update('auction_details', array(
            'fixed_increment' => $fixed_increment
            ));
        
    }
    
    public function is_inactive($book_id){
        $query=$this->db->get_where('books',array('book_id'=>$book_id));
        $book=$query->row_array();
        if($book['inactive']){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
}
