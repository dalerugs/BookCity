<?php

class Messenger_model extends CI_Model{
    public function check_token($token){
        $result=$this->db->get_where('messengers',"token='$token'")->num_rows();
        
        if($result==1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function get_profile($token){
        $data=$this->db->get_where('messengers',"token='$token'")->row_array();
        return $data;
    }
    
    public function send_message($message,$type){
        $this->db->insert('conversations',array(
            'user_id' =>$message['user_id'],
            'messenger_id' =>$message['messenger_id'],
            'message' =>$message['message'],
            'type' => $type,
            'message_date' => date("Y-m-d H:i:s")
            
        ));
        $this->db->where("messenger_id=".$message['messenger_id']);
        $this->db->update('messengers',array(
            'last_modified' =>date("Y-m-d H:i:s")
        ));
    }
    
    public function get_conversations($messenger_id,$user_id){
        $convo=$this->db->order_by('message_date','ASC')->get_where('conversations',"messenger_id=$messenger_id AND user_id=$user_id")->result();
        return $convo;
        
    }
    
    public function get_all_conversations($user_id){
        $convo=$this->db->order_by('last_modified','DESC')->get_where('messengers',"user_id=$user_id")->result();
        
        foreach ($convo as $con) {
            $mes_notif['mes_notif']=$this->db->query("SELECT * FROM conversations WHERE messenger_id=$con->messenger_id AND user_id=$con->user_id AND type='messenger' AND !is_seen")->num_rows();
        
            $data[]=(object) array_merge((array)$con,(array)$mes_notif);
        }
        
        
        return $data;
    }
    
    
    public function get_mes_notif(){
        $user_id=$_SESSION['user_id'];
        $query= $this->db->query("SELECT * FROM conversations WHERE user_id=$user_id AND type='messenger' AND !is_seen")->num_rows();
        
        return $query;
    }
    
    public function isSeen($messenger_id,$user_id,$type){
        $this->db->where("type='$type' AND user_id=$user_id AND messenger_id=$messenger_id");
        $this->db->update('conversations',array(
                'is_seen' => TRUE
        ));
        
    }
}
