<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_download_m extends CI_Model {
    
    // start datatables
    var $column_order = array(null, 'rekomendasi', 'support','deadline', 'comment', 'file', 'status_id', 'komentar_ki', null); //set column field database for datatable orderable
    var $column_search = array('rekomendasi', 'support','deadline','comment', 'file', 'status_id',  'komentar_ki'); //set column field database for datatable searchable
    var $order = array('deadline' => 'desc'); // default order 
    
    
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('tb_rekom');
        
        $i = 0;
        foreach ($this->column_search as $filter_download) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($filter_download, $_POST['search']['value']);
                } else {
                    $this->db->or_like($filter_download, $_POST['search']['value']);
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


    private function _get_datatables_query2() {
        $tgl_awal= $this->input->post('tgl_awal');
        $tgl_akhir= $this->input->post('tgl_akhir');
        
        $this->db->select('*');
        $this->db->from('tb_rekom');
        $this->db->where('deadline >=' , $tgl_awal);
        $this->db->where('deadline <=' , $tgl_akhir);
        
        $i = 0;
        foreach ($this->column_search as $filter_download) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($filter_download, $_POST['search']['value']);
                } else {
                    $this->db->or_like($filter_download, $_POST['search']['value']);
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

    function get_datatables2() {
        $this->_get_datatables_query2();
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
        $this->db->from('tb_rekom');

        if($id != null){
            $this->db->where('rekom_id', $id);
        }
        $query= $this->db->get();
        return $query;
    }
  
    public function filter($tgl_awal, $tgl_akhir){
        $this->db->select('*');
        $this->db->from('tb_rekom');
        $this->db->where('deadline >=' , $tgl_awal);
        $this->db->where('deadline <=' , $tgl_akhir);
        
        $query= $this->db->get();
        return $query;
    }
}
