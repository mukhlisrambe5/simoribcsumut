<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belum extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['belum_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->belum_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $belum) {
            // $x= $belum->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $belum->rekomendasi;
            $row[] = $belum->activities_name;
            $row[] = $belum->user_name;
            $row[] = $belum->support;
            $row[] = indo_date($belum->deadline);
            $row[] = $belum->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$belum->rekom_id).'"> '.$belum->file.'  </a>'  ;
          
            $row[] = $belum->status_name;
            $row[] = $belum->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('belum/edit/'.$belum->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('belum/del/'.$belum->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->belum_m->count_all(),
                    "recordsFiltered" => $this->belum_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->belum_m->get();

        $this->template->load('template', 'belum/belum_data', $data);
     }

    public function count_data(){
        // $count= $this->belum_m->count_data();
        // return $count;
        $this->ci->load->model('belum_m');
        return $this->ci->belum_m->get()->num_rows();


    }

    public function add(){
        $belum= new stdClass();
        $belum->rekom_id= null;
        $belum->rekomendasi= null;
        $belum->deadline= null;
        $belum->activities_id= null;
        $belum->support= null;
        $belum->komentar_ki= null;
        
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
            'row' => $belum,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'belum/belum_form', $data);

    }

    public function edit($id){
        $query= $this->belum_m->get($id);
        if($query->num_rows()>0){
            $belum= $query->row();
        //     $data= array(
        //         'page'=>'edit',
        //         'row' => $belum
        //     );
        //     $this->template->load('template', 'rekoms/rekoms_form', $data);
        // }else {
        //     echo "<script> alert('Data tidak ditemukan!'); </script>";
        //     echo "<script> window.location='".site_url('belum')."'; </script>";
        // }
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
                    'row' => $belum,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $belum->user_id,
                    'status' =>$status, 'selectedstatus' => $belum->status_id,
                );
                $this->template->load('template', 'belum/belum_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('belum')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->belum_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->belum_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('belum');
}

     
    public function del($id){
        $this->belum_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('belum');
    }

}
