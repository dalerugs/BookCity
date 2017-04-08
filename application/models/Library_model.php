<?php


class Library_model extends CI_Model {
    public function get_genres(){
        $this->db->select('genre');
        $this->db->from('genres');
        $this->db->order_by("genre", "asc");
        $genre = $this->db->get();
        $result = $genre->result();
        return $result;
    }
    
    public function latest_uploads(){
        $this->db->limit(8);
        $this->db->order_by("date_posted", "DESC");
        $this->db->select('book_id,title,author,genre,method,date_posted,b_condition,user_id');
        $this->db->from('books');
        $this->db->where('!inactive');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
          
            foreach ($query->result() as $row) {
                $details=array();
                $this->db->limit(1);
                $this->db->order_by("image_url","asc");
                $image_url = $this->db->select('image_url')
                  ->get_where('book_images', array('book_id' => $row->book_id))
                  ->row()
                  ->image_url;
                
                $location=$this->db->select('city_area, city')
                                ->get_where('home_address', array('user_id' => $row->user_id))
                                ->row();
               
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
                
               $image['image_url']=$image_url;
            
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$details,(array)$location);
            }
            return $data;
        }
    }
    
    public function books_onAuction(){
        $this->db->limit(8);
        $this->db->order_by("date_posted", "DESC");
        $this->db->select('book_id,title,author,genre,method,date_posted,b_condition,user_id');
        $this->db->from('books');
        $this->db->where("method='Auction'");
        $this->db->where('!inactive');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
          
            foreach ($query->result() as $row) {
                $details=array();
                $this->db->limit(1);
                $this->db->order_by("image_url","asc");
                $image_url = $this->db->select('image_url')
                  ->get_where('book_images', array('book_id' => $row->book_id))
                  ->row()
                  ->image_url;
                
                $location=$this->db->select('city_area, city')
                                ->get_where('home_address', array('user_id' => $row->user_id))
                                ->row();
               
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
                
               $image['image_url']=$image_url;
            
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$details,(array)$location);
            }
            return $data;
        }
    }
    
    public function books_onSale(){
        $this->db->limit(8);
        $this->db->order_by("discount","desc");
        $this->db->select('*');
        $this->db->from('sell_details');
        $this->db->where('discount != 0');
        $this->db->where('!inactive');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
          
            foreach ($query->result() as $row) {
                $details=array();
                $this->db->limit(1);
                $this->db->order_by("image_url","asc");
                $image_url = $this->db->select('image_url')
                  ->get_where('book_images', array('book_id' => $row->book_id))
                  ->row()
                  ->image_url;
               
                $book=$this->db->select('book_id,title,author,genre,method,date_posted,b_condition,user_id')
                                ->get_where('books', array('book_id' => $row->book_id))
                                ->row();
                        
                
                $location=$this->db->select('city_area, city')
                                ->get_where('home_address', array('user_id' => $book->user_id))
                                ->row();
                
                $image['image_url']=$image_url;
            
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$book,(array)$location);
                
                
            }
            return $data;
        }
    }
    
    public function view_book($book_id){
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
    
    public function Post_Review($data){
        $this->db->insert('reviews', array(
        'book_id' => $data['book_id'],
        'name' => $data['name'],
        'review' => $data['review'],
        'created_date' => date("Y-m-d H:i:s")
        ));
    }
    
    public function Post_Reply($data){
        $this->db->insert('replies', array(
        'review_id' => $data['review_id'],
        'name' => $data['name'],
        'reply' => $data['reply'],
        'created_date' => date("Y-m-d H:i:s")
        ));
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
    
    public function Get_Books_Genre($limit, $start,$genre){
        $this->db->limit($limit, $start);
        
        $this->db->select('user_id,book_id,title,author,genre,method,date_posted');
        $this->db->from('books');
        $this->db->where('!inactive');
        $this->db->order_by("date_posted", "DESC");
        
            $this->db->where(array('genre'=>$genre));
        
           
        
        
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
            $location=$this->db->select('city_area, city')
                                ->get_where('home_address', array('user_id' => $row->user_id))
                                ->row();
            
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
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$location,(array)$details);
                
            }
            return $data;
        }
        return false;
        
    }
    
    public function record_count_genre($genre) {
        
        $books=$this->db->get_where('books',array('genre'=>$genre,'inactive' => FALSE));
        
        return $books->num_rows();
    }
    
    public function record_count_search($search) {
        $query=$this->db->query("SELECT * FROM books WHERE !inactive and title like '%$search%' or author like '%$search%' or genre like '%$search%'");
//        $this->db->select('book_id,title,author,genre,method,date_posted');
//        $this->db->from('books');
//        $this->db->order_by("date_posted", "DESC");
//        $this->db->or_like('title', $search);
//        $this->db->or_like('author', $search);
//        $this->db->or_like('genre', $search);
//        $this->db->where('!inactive');
//        $query = $this->db->get();
        
        
        return $query->num_rows();
    }
    
    public function Get_Book_Search($limit, $start,$search){
        
        
        $this->db->limit($limit, $start);
        $query=$this->db->query("SELECT * FROM books WHERE !inactive and title like '%$search%' or author like '%$search%' or genre like '%$search%'");
//        $this->db->select('user_id, book_id,title,author,genre,method,date_posted');
//        $this->db->from('books');
//        
//        $this->db->order_by("date_posted", "DESC");
//        $this->db->or_like('title', $search);
//        $this->db->or_like('author', $search);
//        $this->db->or_like('genre', $search);
//        $this->db->where('!inactive');
//        
//        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->limit(1);
                $this->db->order_by("image_url","asc");
                $image_url = $this->db->select('image_url')
                  ->get_where('book_images', array('book_id' => $row->book_id))
                  ->row()
                  ->image_url;
                
               $image['image_url']=$image_url;
               
               $location=$this->db->select('city_area, city')
                                ->get_where('home_address', array('user_id' => $row->user_id))
                                ->row();
            
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
          
                $data[] = (object) array_merge((array)$row,(array)$image,(array)$location,(array)$details);
            
          
                
            }
            return $data;
        }
        return false;
        
    }
    
    public function rate_seller($rating){
        $this->db->insert('ratings',array(
            'user_id' => $rating['user_id'],
            'rating' => $rating['rating']
        ));
        
        $query=$this->db->get_where('ratings',array('user_id'=>$rating['user_id']));
        $sub_total=0;
        foreach ($query->result() as $row) {
            $sub_total += $row->rating;
        }
        
        $total=$sub_total/$query->num_rows();
        
        $this->db->where('user_id='.$rating['user_id']);
        $this->db->update('users',array(
            'rating' => $total
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
    
    public function report_seller($report){
        $this->db->insert('reports',array(
           'user_id' =>  $report['user_id'],
            'reason' =>  $report['reason'],
            'other' =>  $report['other'],
            'report_date' => date("Y-m-d H:i:s")
        ));
        $user=$this->db->get_where('users',array('user_id'=>$report['user_id']))->row_array();
        $this->db->where('user_id='.$user['user_id']);
        $this->db->update('users',array(
            'reports' => $user['reports']+1
        ));
    }
    
    public function new_messenger($data){
        $this->db->insert('messengers',array(
            'user_id' => $data['user_id'],
            'name' => $data['m_name'],
            'contact_no' => $data['contact_number'],
            'email' => $data['email'],
            'token' => $data['token'],
            'seller_name' => $data['seller_name']
        ));
    }
    
    

    
    
}
