<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hampir extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['hampir_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->hampir_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $hampir) {
            // $x= $hampir->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $hampir->rekomendasi;
            $row[] = $hampir->activities_name;
            $row[] = $hampir->user_name;
            $row[] = $hampir->support;
            $row[] = indo_date($hampir->deadline);
            $row[] = $hampir->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$hampir->rekom_id).'"> '.$hampir->file.'  </a>'  ;
          
            $row[] = $hampir->status_name;
            $row[] = $hampir->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('hampir/edit/'.$hampir->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('hampir/del/'.$hampir->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->hampir_m->count_all(),
                    "recordsFiltered" => $this->hampir_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->hampir_m->get();

        $this->template->load('template', 'hampir/hampir_data', $data);
     }

    public function count_data(){
        // $count= $this->hampir_m->count_data();
        // return $count;
        $this->ci->load->model('hampir_m');
        return $this->ci->hampir_m->get()->num_rows();


    }

    public function add(){
        $hampir= new stdClass();
        $hampir->rekom_id= null;
        $hampir->rekomendasi= null;
        $hampir->deadline= null;
        $hampir->activities_id= null;
        $hampir->support= null;
        $hampir->komentar_ki= null;
        
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
            'row' => $hampir,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'hampir/hampir_form', $data);

    }

    public function edit($id){
        $query= $this->hampir_m->get($id);
        if($query->num_rows()>0){
            $hampir= $query->row();
        //     $data= array(
        //         'page'=>'edit',
        //         'row' => $hampir
        //     );
        //     $this->template->load('template', 'rekoms/rekoms_form', $data);
        // }else {
        //     echo "<script> alert('Data tidak ditemukan!'); </script>";
        //     echo "<script> window.location='".site_url('hampir')."'; </script>";
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
                    'row' => $hampir,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $hampir->user_id,
                    'status' =>$status, 'selectedstatus' => $hampir->status_id,
                );
                $this->template->load('template', 'hampir/hampir_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('hampir')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->hampir_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->hampir_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('hampir');
}

     
    public function del($id){
        $this->hampir_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('hampir');
    }

}
