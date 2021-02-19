<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selesai_m extends CI_Model {

    // start datatables
    var $column_order = array(null, 'rekomendasi', 'tb_activities.activities_name', 'tb_user.user_name','support', 'deadline ', 'comment', 'file',  'tb_status.status_name','komentar_ki', null); //set column field database for datatable orderable
    var $column_search = array('rekomendasi', 'tb_activities.activities_name', 'tb_user.user_name', 'support', 'deadline', 'comment', 'file',  'tb_status.status_name','komentar_ki'); //set column field database for datatable searchable
    var $order = array('deadline' => 'desc'); // default order 
    
    
 
    private function _get_datatables_query() {
        $statusnow= "Selesai";
        $this->db->select('tb_rekom.*, tb_activities.activities_name as activities_name, tb_status.status_name as status_name, tb_user.user_name as user_name' );
        $this->db->from('tb_rekom');
        $this->db->join('tb_activities', 'tb_rekom.activities_id = tb_activities.activities_id');
        $this->db->join('tb_user', 'tb_rekom.user_id = tb_user.user_id');
        $this->db->join('tb_status', 'tb_rekom.status_id = tb_status.status_id');
        $this->db->where('tb_status.status_name', $statusnow);
        $i = 0;
        foreach ($this->column_search as $selesai) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($selesai, $_POST['search']['value']);
                } else {
                    $this->db->or_like($selesai, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }if(isset($_POST['order'])) {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           
       }if(isset($this->order)){
               $order = $this->order;
               $this->db->order_by(key($order), $order[key($order)]);
               
           }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('tb_rekom');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id=null){

        $statusnow= "selesai";

        $this->db->select('tb_rekom.*, tb_activities.activities_name as activities_name, 
        tb_status.status_name as status_name,
        tb_user.user_name as user_name',
        );
        $this->db->from('tb_rekom');
        $this->db->join('tb_activities', 'tb_activities.activities_id = tb_rekom.activities_id');
        $this->db->join('tb_status', 'tb_status.status_id = tb_rekom.status_id');
        // $this->db->join('tb_support', 'tb_support.support_id = tb_rekom.support_id');
        $this->db->join('tb_user', 'tb_user.user_id = tb_rekom.user_id');
        $this->db->where('tb_status.status_name', $statusnow);
        
        if($id != null){
            $this->db->where('rekom_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }


    public function add($post){
        $params = [
            'rekom_id' => $post['rekom_id'],
            'user_id' => $post['user'],
            'rekomendasi' => $post['rekomendasi'],
            'activities_id' => $post['activities'],
            'support' => $post['support'],
            'deadline' => $post['deadline'],
            'status_id' => $post['status'],
            'komentar_ki' => $post['komentar_ki'],
            
        ];
        $this->db->insert('tb_rekom', $params);
    }

    public function edit($post){
        $params = [
            'rekom_id' => $post['rekom_id'],
            'user_id' => $post['user'],
            'rekomendasi' => $post['rekomendasi'],
            'activities_id' => $post['activities'],
            'support' => $post['support'],
            'deadline' => $post['deadline'],
            'status_id' => $post['status'],
            'komentar_ki' => $post['komentar_ki'],
        ];
        $this->db->where('rekom_id', $post['rekom_id']);
        $this->db->update('tb_rekom', $params);
    }

    public function del($id){
        $this->db->where('rekom_id', $id);
        $this->db->delete('tb_rekom');
    }

}
