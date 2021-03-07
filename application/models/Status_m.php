<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_m extends CI_Model {

    public function get($id=null){
        $this->db->from('tb_status');
        if($id !=null){
            $this->db->where('status_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function get_status($id){
        $this->db->from('tb_status');
        $this->db->where('status_id', $id);
        $query= $this->db->get();
        return $query;
    }

    public function del($id){
        $this->db->where('status_id', $id);
        $this->db->delete('tb_status');
    }

    public function add($post){
        $params = [
            'status_name' => $post['status_name'],
            'info' => empty($post['info']) ? null: $post['info'],
        ];
        $this->db->insert('tb_status', $params);
    }

    public function edit($post){
        $params = [
            'status_name' => $post['status_name'],
            'info' => empty($post['info']) ? null: $post['info'],
        ];
        $this->db->where('status_id', $post['status_id']);
        $this->db->update('tb_status', $params);
    }


    
}