<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support_m extends CI_Model {

    public function get($id= null){
        $this->db->from('tb_support');
        if($id != null){
            $this->db->where('support_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function add($post){
        $params['support_id'] = $post['support_id'];
        $params['support_name']= $post['support_name'];
        $params['info']= $post['info'];
        
        $this->db->insert('tb_support', $params);
    }

    public function del($id){
        $this->db->where('support_id', $id);
        $this->db->delete('tb_support');
    }

    public function edit($post){
        
        $params['support_id']= $post['support_id'];
        $params['support_name']= $post['support_name'];
        $params['info']= $post['info'];
        
        $this->db->where('support_id', $post['support_id']);
        $this->db->update('tb_support', $params);
    }
    
} 