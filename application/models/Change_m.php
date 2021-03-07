<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_m extends CI_Model {

    public function get($id=null){
        $this->db->from('tb_user');
        if($id !=null){
            $this->db->where('user_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function edit($post){
        
        if(!empty($post['password'])){
            $params['password'] = sha1($post['password']);
        }
       
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params);
    }


    
}