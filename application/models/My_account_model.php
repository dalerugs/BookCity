<?php

class My_account_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function My_Account(){
        $get_user = $this->db->get_where('users',array('user_id' => $_SESSION['user_id']));
        $get_loc=$this->db->get_where('home_address',array('user_id' => $_SESSION['user_id']));
        
        $Account=$get_user->row_array()+$get_loc->row_array();
        $Account['hide_password']=str_repeat("*", strlen($Account['password']));
        $Account['total_books']= $this->db->get_where('books','user_id='.$_SESSION['user_id'])->num_rows();
        $Account['on_sale']=$this->db->get_where('books',array('user_id'=>$_SESSION['user_id'],'method'=>'Sell','inactive'=>FALSE))->num_rows();
        $Account['on_auction']=$this->db->get_where('books',array('user_id'=>$_SESSION['user_id'],'method'=>'Auction','inactive'=>FALSE))->num_rows();
         return $Account;
    }
    
    public function Edit_Account($data){
        $this->db->where('user_id', $_SESSION['user_id']);
        $this->db->update('users', array(
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'sex' => $data['sex'],
            'birth_date' => $data['bdate'],
            'contact_number' => $data['contact'],
            ));
        $city=$this->db->get_where('province',array('province_id' => $data['city']))->row_array();
        $city_area=$this->db->get_where('city',array('city_id' => $data['city_area']))->row_array();
        $this->db->where('user_id', $_SESSION['user_id']);
        $this->db->update('home_address', array(
            'city_area' => $city_area['city'],
            'city' => $city['province']
            ));
        
         $update = $this->db->get_where('users',array('user_id' => $_SESSION['user_id']));
         $to_session=$update->row_array();
            $_SESSION['user_id']=$to_session['user_id'];
            $_SESSION['name']=$to_session['first_name']." ".$to_session['last_name'];
    }
    
    public function Change_Username($username){
         $this->db->where('user_id', $_SESSION['user_id']);
         $this->db->update('users', array('username' => $username));
         
         
         
    }
    
    public function Change_Email($email){
        $this->db->where('user_id', $_SESSION['user_id']);
         $this->db->update('users', array(
             'email_address' => $email,
                 'is_confirmed' => FALSE
                 ));
         
    }
    
    public function Change_Password($password){
        $this->db->where('user_id', $_SESSION['user_id']);
         $this->db->update('users', array('password' => md5($password), 'change_password'=>FALSE));
         
    }
    
    public function confirm_email($token,$user_id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id',$user_id);
        $this->db->where('token',$token);
        $this->db->where('inactive',FALSE);

        $query=$this->db->get();
        
        if($query->num_rows()==1){
            $this->db->where('user_id',$user_id);
            $this->db->update('users',array(
                'is_confirmed' => TRUE
            ));
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function update_token($token){
        $this->db->where('user_id',$_SESSION['user_id']);
            $this->db->update('users',array(
                'token' => $token
            ));
    }
    
    
}
