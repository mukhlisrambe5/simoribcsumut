<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['proses_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->proses_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $proses) {
            // $x= $proses->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $proses->rekomendasi;
            $row[] = $proses->activities_name;
            $row[] = $proses->user_name;
            $row[] = $proses->support;
            $row[] = indo_date($proses->deadline);
            $row[] = $proses->comment;
            $row[] = '<a href="'.site_url('proses_unit/download/'.$proses->rekom_id).'"> '.$proses->file.'  </a>'  ;
          
            $row[] = $proses->status_name;
            $row[] = $proses->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('proses/edit/'.$proses->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('proses/del/'.$proses->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->proses_m->count_all(),
                    "recordsFiltered" => $this->proses_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    

    public function index(){
    
        $data['row']= $this->proses_m->get();

        $this->template->load('template', 'proses/proses_data', $data);
     }

    public function count_data(){
        // $count= $this->proses_m->count_data();
        // return $count;
        $this->ci->load->model('proses_m');
        return $this->ci->proses_m->get()->num_rows();


    }

    public function add(){
        $proses= new stdClass();
        $proses->rekom_id= null;
        $proses->rekomendasi= null;
        $proses->deadline= null;
        $proses->activities_id= null;
        $proses->support= null;
        $proses->komentar_ki= null;
        
        $query_activities= $this->activities_m->get();
        // $query_support= $this->support_m->get();

        $query_user= $this->user_m->get();
        $user[null]= '-Pilih-';
        foreach($query_user->result() as $us){
            $user[$us->user_id]= $us->user_name;
        }

        $query_status= $this->status_m->get();
        // $status[null]= '-Pilih-';
        foreach($query_status->result() as $stat){
            $status[$stat->status_id]= $stat->status_name;
        }

        $data= array(
            'page'=>'add',
            'row' => $proses,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'proses/proses_form', $data);

    }

    public function edit($id){
        $query= $this->proses_m->get($id);
        if($query->num_rows()>0){
            $proses= $query->row();
            $query_activities= $this->activities_m->get();
        // $query_support= $this->support_m->get();

            $query_user= $this->user_m->get();
            $user[null]= '-Pilih-';
            foreach($query_user->result() as $us){
                $user[$us->user_id]= $us->user_name;
            }

            $query_status= $this->status_m->get();
            // $status[null]= '-Pilih-';
            foreach($query_status->result() as $stat){
                $status[$stat->status_id]= $stat->status_name;
            }
                $data= array(
                    'page'=>'edit',
                    'row' => $proses,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $proses->user_id,
                    'status' =>$status, 'selectedstatus' => $proses->status_id,
                );
                $this->template->load('template', 'proses/proses_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('proses')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->proses_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->proses_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('proses');
}

     
    public function del($id){
        $this->proses_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('proses');
    }

}
