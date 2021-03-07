<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekom_m extends CI_Model {

    public function get($id= null){
        
        $this->db->select('tb_rekom.*, tb_activities.activities_name as activities_name, 
        tb_status.status_name as status_name,
        tb_support.support_name as support_name,
        tb_user.user_name as user_name',
        );
        $this->db->from('tb_rekom');
        $this->db->join('tb_activities', 'tb_activities.activities_id = tb_rekom.activities_id');
        $this->db->join('tb_status', 'tb_status.status_id = tb_rekom.status_id');
        $this->db->join('tb_support', 'tb_support.support_id = tb_rekom.support_id');
        $this->db->join('tb_user', 'tb_user.user_id = tb_rekom.user_id');

        if($id != null){
            $this->db->where('rekom_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function add($post){
        $params['rekom_id'] = $post['rekom_id'];
        $params['rekom_name']= $post['rekom_name'];
        $params['info']= $post['info'];
        
        $this->db->insert('tb_rekom', $params);
    }

    public function del($id){
        $this->db->where('rekom_id', $id);
        $this->db->delete('tb_rekom');
    }

    public function edit($post){
        
        $params['rekom_id']= $post['rekom_id'];
        $params['rekom_name']= $post['rekom_name'];
        $params['info']= $post['info'];
        
        $this->db->where('rekom_id', $post['rekom_id']);
        $this->db->update('tb_rekom', $params);
    }
    
} 