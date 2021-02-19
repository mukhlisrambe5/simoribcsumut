<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggest_m extends CI_Model {

    public function get($id= null){
      

        $this->db->select('*');
        $this->db->from('tb_suggest');
 
        if($id != null){
            $this->db->where('suggest_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function add($post){
        // $params['suggest_id'] = $post['suggest_id'];
        $params['suggest_name']= $post['suggest_name'];
        $this->db->insert('tb_suggest', $params);
    }
    
} 