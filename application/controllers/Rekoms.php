<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekoms extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['rekoms_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->rekoms_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $rekoms) {
            // $x= $rekoms->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $rekoms->rekomendasi;
            $row[] = $rekoms->activities_name;
            $row[] = $rekoms->user_name;
            $row[] = $rekoms->support;
            $row[] = indo_date($rekoms->deadline);
            $row[] = $rekoms->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$rekoms->rekom_id).'"> '.$rekoms->file.'  </a>'  ;
          
            $row[] = $rekoms->status_name;
            $row[] = $rekoms->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('rekoms/edit/'.$rekoms->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('rekoms/del/'.$rekoms->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->rekoms_m->count_all(),
                    "recordsFiltered" => $this->rekoms_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->rekoms_m->get();
        $this->template->load('template', 'rekoms/rekoms_data', $data);
     }

    public function add(){
        $rekoms= new stdClass();
        $rekoms->rekom_id= null;
        $rekoms->rekomendasi= null;
        $rekoms->deadline= null;
        $rekoms->activities_id= null;
        $rekoms->support= null;
        $rekoms->komentar_ki= null;
        
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
            'row' => $rekoms,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'rekoms/rekoms_form', $data);

    }

    public function edit($id){
        $query= $this->rekoms_m->get($id);
        if($query->num_rows()>0){
            $rekoms= $query->row();

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
                    'row' => $rekoms,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $rekoms->user_id,
                    'status' =>$status, 'selectedstatus' => $rekoms->status_id,
                );
                $this->template->load('template', 'rekoms/rekoms_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('rekoms')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->rekoms_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->rekoms_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('rekoms');
}

     
    public function del($id){
        $this->rekoms_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('rekoms');
    }

}
