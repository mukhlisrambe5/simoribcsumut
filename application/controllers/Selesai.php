<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selesai extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['selesai_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->selesai_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $selesai) {
            // $x= $selesai->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $selesai->rekomendasi;
            $row[] = $selesai->activities_name;
            $row[] = $selesai->user_name;
            $row[] = $selesai->support;
            $row[] = indo_date($selesai->deadline);
            $row[] = $selesai->comment;
            $row[] = '<a href="'.site_url('selesai_unit/download/'.$selesai->rekom_id).'"> '.$selesai->file.'  </a>'  ;
          
            $row[] = $selesai->status_name;
            $row[] = $selesai->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('selesai/edit/'.$selesai->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('selesai/del/'.$selesai->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->selesai_m->count_all(),
                    "recordsFiltered" => $this->selesai_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }


    public function index(){
    
        $data['row']= $this->selesai_m->get();

        $this->template->load('template', 'selesai/selesai_data', $data);
     }

    public function count_data(){
        // $count= $this->selesai_m->count_data();
        // return $count;
        $this->ci->load->model('selesai_m');
        return $this->ci->selesai_m->get()->num_rows();


    }

    public function add(){
        $selesai= new stdClass();
        $selesai->rekom_id= null;
        $selesai->rekomendasi= null;
        $selesai->deadline= null;
        $selesai->activities_id= null;
        $selesai->support= null;
        $selesai->komentar_ki= null;
        
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
            'row' => $selesai,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'selesai/selesai_form', $data);

    }

    public function edit($id){
        $query= $this->selesai_m->get($id);
        if($query->num_rows()>0){
            $selesai= $query->row();
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
                    'row' => $selesai,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $selesai->user_id,
                    'status' =>$status, 'selectedstatus' => $selesai->status_id,
                );
                $this->template->load('template', 'selesai/selesai_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('selesai')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->selesai_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->selesai_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('selesai');
}

     
    public function del($id){
        $this->selesai_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('selesai');
    }

}
