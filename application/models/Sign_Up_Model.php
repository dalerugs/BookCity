<?php

class Sign_Up_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function Register($data){
        $this->db->insert('users', array(
            'username' => $data['username'],
            'password' => md5($data['con_password']),
            'email_address' => $data['email'],
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'sex' => $data['sex'],
            'birth_date' => $data['bdate'],
            'contact_number' => $data['contact_number'],
            'token' => $data['token'],
            ));
        $get_user = $this->db->get_where('users',array('username' => $data['username']));
        $user_id=$get_user->row_array();
        $city=$this->db->get_where('province',array('province_id' => $data['city']))->row_array();
        $city_area=$this->db->get_where('city',array('city_id' => $data['city_area']))->row_array();
        $this->db->insert('home_address', array(
            'user_id' => $user_id['user_id'],
            'city_area' => $city_area['city'],
            'city' => $city['province']
            ));
        $_SESSION['user_id']=$user_id['user_id'];
        $_SESSION['name']=$user_id['first_name']." ".$user_id['last_name'];
    }
}
