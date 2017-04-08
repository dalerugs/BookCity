<?php

class Auction_model extends CI_Model {
    public function new_bidder($bidder){
        $this->db->insert('bidders', array(
            'book_id' => $bidder['book_id'],
            'auction_id' => $bidder['auction_id'],
            'name' => $bidder['b_name'],
            'contact_no' => $bidder['b_contact'],
            'email' => $bidder['b_email'],
            'token' => $bidder['token']
            ));
    }
    
    public function get_book($token){
        $data=array();
        
        $bidder=$this->db->get_where('bidders',array('token'=>$token));
        $data+=$bidder->row_array();
        $book=$this->db->get_where('books',array('book_id' => $data['book_id']));
        $data+=$book->row_array();
        $location=$this->db->get_where('home_address',array('user_id' => $data['user_id']));
        $data += $location->row_array();
        $user_id=$data['user_id'];
        $seller=$this->db->query("SELECT first_name,last_name,email_address,contact_number,rating FROM users WHERE user_id=$user_id");
        $data += $seller->row_array();
        $auction=$this->db->get_where('auction_details',array('book_id' => $data['book_id']));
        $data += $auction->row_array();
        $book_id=$data['book_id'];
        $bids=$this->db->query("SELECT * FROM bidding_log WHERE book_id=$book_id AND !inactive ORDER BY bid_date DESC");
        $data['bids']= $bids->result();
        $images=$this->db->query("SELECT image_url FROM book_images WHERE book_id=$book_id ORDER BY image_url ASC");
        
        $i=1;
        foreach ($images->result() as $image) {
            $data['photo'.$i] = $image->image_url;
            $i++;
        }
        
        
        return $data;;
    }
    
    public function check_bidder($token){
        $bidder=$this->db->get_where('bidders',array('token'=>$token));
        
        if($bidder->num_rows()==0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
    }
    
    public function place_bid($data){
        $this->db->insert('bidding_log', array(
            'book_id' => $data['book_id'],
            'bidder_id' => $data['bidders_id'],
            'name' => $data['name'],
            'bid_price' => $data['bid_price'],
            'bid_date' => date("Y-m-d H:i:s")
            ));
        
        $this->db->where('book_id',$data['book_id'] );
        $this->db->update('auction_details', array(
            'bid_price' => $data['bid_price'],
            'highest_bidder' => $data['name'],
            'bid_counter' => $data['bid_counter']+1,
            'highest_bidder_id' => $data['bidders_id'],
            
                
                ));
    }
}
