<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities_m extends CI_Model {

    public function get($id=null){
        $this->db->from('tb_activities');
        if($id !=null){
            $this->db->where('activities_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function del($id){
        $this->db->where('activities_id', $id);
        $this->db->delete('tb_activities');
    }

    public function add($post){
        $params = [
            'activities_name' => $post['activities_name'],
            'info' => empty($post['info']) ? null: $post['info'],
        ];
        $this->db->insert('tb_activities', $params);
    }

    public function edit($post){
        $params = [
            'activities_name' => $post['activities_name'],
            'info' => empty($post['info']) ? null: $post['info'],
        ];
        $this->db->where('activities_id', $post['activities_id']);
        $this->db->update('tb_activities', $params);
    }


    
}