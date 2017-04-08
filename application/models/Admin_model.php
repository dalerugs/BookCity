<?php

class Admin_model extends CI_Model{
    
    public function login($data){
       
        $query=$this->db->get_where('admins',array('username'=>$data['username'],'password'=>md5($data['password']),'inactive'=>FALSE));
        
        if($query->num_rows()==1){
            $to_session=$query->row_array();
           
            $_SESSION['admin_id']=$to_session['admin_id'];
            $_SESSION['admin_name']=$to_session['Name'];
            $_SESSION['admin_type']=$to_session['type'];
             
            return 1;
        }
        else{
            return 0;
        }
    }
    
    public function get_admins(){
        $result = $this->db->get('admins')->result();
        return $result;
    }
    
    public function get_admin($admin_id){
        $result = $this->db->get_where('admins',array('admin_id'=>$admin_id))->row_array();
        return $result;
    }
    
    public function edit_admin($admin){
        $this->db->where('admin_id',$admin['admin_id']);
        $this->db->update('admins',array(
            'Name' => $admin['Name'],
            'username' => $admin['username'],
            'password' => md5($admin['password'])
        ));
    }
    
    
    
    public function change_admin_status($status,$admin_id){
        $this->db->where('admin_id',$admin_id);
        $this->db->update('admins',array(
            'inactive' => $status
        ));
    }
    
    public function change_user_status($status,$user_id){
        $this->db->where('user_id',$user_id);
        $this->db->update('users',array(
            'inactive' => $status
        ));
        if($status){
            $this->db->where('user_id',$user_id);
            $this->db->update('books',array(
                'inactive' => $status
            ));
            $this->db->where('user_id',$user_id);
            $this->db->update('auction_details',array(
                'inactive' => $status
            ));
            $this->db->where('user_id',$user_id);
            $this->db->update('sell_details',array(
                'inactive' => $status
            ));
        }
    }
    
    public function create_admin($admin){
        $this->db->insert('admins',array(
           'Name' => $admin['Name'],
           'username' => $admin['username'], 
           'password' => md5($admin['password']),
           'type' => 'A'
        ));
    }
    
    public function get_stats(){
        $data=array();
        $data['users']= $this->db->get('users')->num_rows();
        $data['active_users']=$this->db->get_where('users',array('inactive'=>false))->num_rows();
        $data['inactive_users']=$this->db->get_where('users',array('inactive'=>true))->num_rows();
        $data['books']= $this->db->get('books')->num_rows();
        $data['on_sale']=$this->db->get_where('books',array('method'=>'Sell','inactive'=>FALSE))->num_rows();
        $data['on_auction']=$this->db->get_where('books',array('method'=>'Auction','inactive'=>FALSE))->num_rows();
        $data['inactive_books']=$this->db->get_where('books',array('inactive'=>TRUE))->num_rows();
        return $data;
    }
    
    public function get_book($book_id){
        $query=$this->db->get_where('books',array('book_id' => $book_id));
        $book=$query->row_array();
        $get_image=$this->db->query("SELECT image_url FROM book_images WHERE book_id=$book_id ORDER BY image_url ASC");
        
        $location=$this->db->get_where('home_address',array('user_id' => $book['user_id']));
            $book += $location->row_array();
         $user_id=$book['user_id'];   
        $seller=$this->db->query("SELECT first_name,last_name,email_address,contact_number,rating FROM users WHERE user_id=$user_id");
            $book += $seller->row_array();
        
        
        
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
    
    public function get_reported_users(){
        $result = $this->db->get_where('users','reports > 0')->result();
        return $result;
    }
    
    public function get_reported_user($user_id){
        $user = $this->db->get_where('users',"user_id=$user_id")->row_array();
        $user['reports']=$this->db->order_by("report_date", "desc")->get_where('reports',"user_id=$user_id")->result();
        return $user;
    }
    
    public function get_top_users(){
        $result = $this->db->order_by("rating", "desc")->get_where('users','rating > 0')->result();
        return $result;
    }
    
    public function login_token(){
        $token=$this->db->get_where('admin_login','id=1')->row_array();
        return $token['token'];
    }
    
    public function update_token($token){
        $this->db->where('id=1');
        $this->db->update('admin_login',array(
            'token'=> $token
        ));
        
    }
    
    public function get_donors(){
        $result = $this->db->order_by("date_sent", "desc")->get('donors')->result();
        return $result;
    }
    public function get_donor($donor_id){
        $result = $this->db->get_where('donors',"id=$donor_id")->row_array();
        return $result;
    }
    
}
