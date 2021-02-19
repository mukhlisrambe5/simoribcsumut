<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes_m extends CI_Model {

    public function get($id=null){
        $this->db->from('tb_tes');
        if($id !=null){
            $this->db->where('id', $id);
        }
        $query= $this->db->get();
        return $query;
    }
}