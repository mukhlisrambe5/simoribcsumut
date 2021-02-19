<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lewat extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['lewat_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->lewat_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $lewat) {
            // $x= $lewat->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $lewat->rekomendasi;
            $row[] = $lewat->activities_name;
            $row[] = $lewat->user_name;
            $row[] = $lewat->support;
            $row[] = indo_date($lewat->deadline);
            $row[] = $lewat->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$lewat->rekom_id).'"> '.$lewat->file.'  </a>'  ;
          
            $row[] = $lewat->status_name;
            $row[] = $lewat->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('lewat/edit/'.$lewat->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('lewat/del/'.$lewat->rekom_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->lewat_m->count_all(),
                    "recordsFiltered" => $this->lewat_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->lewat_m->get();

        $this->template->load('template', 'lewat/lewat_data', $data);
     }

    public function count_data(){
        // $count= $this->lewat_m->count_data();
        // return $count;
        $this->ci->load->model('lewat_m');
        return $this->ci->lewat_m->get()->num_rows();


    }

    public function add(){
        $lewat= new stdClass();
        $lewat->rekom_id= null;
        $lewat->rekomendasi= null;
        $lewat->deadline= null;
        $lewat->activities_id= null;
        $lewat->support= null;
        $lewat->komentar_ki= null;
        
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
            'row' => $lewat,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'lewat/lewat_form', $data);

    }

    public function edit($id){
        $query= $this->lewat_m->get($id);
        if($query->num_rows()>0){
            $lewat= $query->row();
        //     $data= array(
        //         'page'=>'edit',
        //         'row' => $lewat
        //     );
        //     $this->template->load('template', 'rekoms/rekoms_form', $data);
        // }else {
        //     echo "<script> alert('Data tidak ditemukan!'); </script>";
        //     echo "<script> window.location='".site_url('lewat')."'; </script>";
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
                    'row' => $lewat,
                    'activities' =>$query_activities,
                    // 'support' =>$query_support,
                    'user' =>$user, 'selecteduser' => $lewat->user_id,
                    'status' =>$status, 'selectedstatus' => $lewat->status_id,
                );
                $this->template->load('template', 'lewat/lewat_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('lewat')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->lewat_m->add($post);

        }else{
            if(isset($_POST['edit'])){
                $this->lewat_m->edit($post);
        }
        
        }
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
    }
        redirect('lewat');
}

     
    public function del($id){
        $this->lewat_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('lewat');
    }

}
