<?php

class Donate_model extends CI_Model {
    public function send_message($message){
        $this->db->insert('donors',array(
            'name' => $message['name'],
            'email' => $message['email'],
            'contact' => $message['con_no'],
            'message' => $message['message'],
            'date_sent' => date("Y-m-d H:i:s")
        ));
    }
}
