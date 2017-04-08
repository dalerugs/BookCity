<?php

class Landing_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function Login($username,$password){
        $this->db->select('username, password');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $this->db->where('inactive',FALSE);

        $query=$this->db->get();
        
        if($query->num_rows()==1){
            $user_id = $this->db->get_where('users',array('username' => $username));
            $to_session=$user_id->row_array();
            $_SESSION['user_id']=$to_session['user_id'];
            $_SESSION['name']=$to_session['first_name']." ".$to_session['last_name'];
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function Forgot($forgotten){
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('username',$forgotten);
        $username=$this->db->get();
        
        if($username->num_rows()==0){
            $this->db->select('email_address');
            $this->db->from('users');
            $this->db->where('email_address',$forgotten);
            $email=$this->db->get();
             if($email->num_rows()==0){
                 return FALSE;
             }
             else{
                 $get = $this->db->get_where('users',array('email_address' => $forgotten));
                 $get=$get->row_array();
                 $this->send_new_pass($get);
                 return TRUE;
             }
        }
        else{
            $get = $this->db->get_where('users',array('username' => $forgotten));
            $get=$get->row_array();
            $this->send_new_pass($get);  
            return TRUE;
        }
    }
    
    public function send_new_pass($data){
        $gen_pass = $this->generate_pass();
        
	
	$copy_new_password = $gen_pass;
	$new_password = md5($gen_pass);
        $get_username=$data['username'];
        $get_email=$data['email_address'];
                
        
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('users', array('password' => $new_password, 'change_password'=> TRUE));
        
        $subject = "Book City: Forgot Password";
	$Emessage = "Your login information has been change to: \n
				Username: '$get_username' \n
				Password: '$copy_new_password' ";
	$headers = 'From: BookCity@bookcity.com';
	mail($get_email, $subject, $Emessage,$headers);
        
        
    }
    
    public function is_change_password(){
        $this->db->select("change_password");
        $this->db->from("users");
        $this->db->where("user_id=".$_SESSION['user_id']);
        $query=$this->db->get();
        $change_password=$query->row_array();
        
        return $change_password['change_password'];
    }
    
    public function get_notif(){
        $user_id=$_SESSION['user_id'];
        $query= $this->db->query("SELECT * FROM notifications WHERE user_id=$user_id AND !is_seen")->num_rows();
        
        return $query;
    }
    
    public function is_confirmed(){
        $this->db->select("is_confirmed");
        $this->db->from("users");
        $this->db->where("user_id=".$_SESSION['user_id']);
        $query=$this->db->get();
        $is_confirmed=$query->row_array();
        
        return $is_confirmed['is_confirmed'];
    }
    
    private function generate_pass(){
        $characters = '0123456789ABCDEFGHIJKLMNOP';
        $charactersLength = strlen($characters);
        $token = '';
        $length=6;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        
       
        
        return $token;
    }
    
    public function update_notif($data){
        $this->db->insert('notifications',$data);
    }
    
    public function display_get_notifs($user_id){
        $notifs=$this->db->order_by('notif_date','DESC')->get_where('notifications',"user_id=$user_id")->result();
        return $notifs;
        
    }
    
    public function seen_notif($book_id,$type){
        $this->db->where("book_id=$book_id AND type='$type'");
        $this->db->update('notifications',array(
            'is_seen'=>TRUE
        ));
    }
    
    
    
}
