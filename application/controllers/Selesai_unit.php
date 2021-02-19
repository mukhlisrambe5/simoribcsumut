<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selesai_unit extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
       
        $this->load->model(['selesai_unit_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->selesai_unit_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $selesai_unit) {
            // $x= $selesai_unit->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $selesai_unit->rekomendasi;
            $row[] = $selesai_unit->activities_name;
            // $row[] = $selesai_unit->user_name;
            $row[] = $selesai_unit->support;
            $row[] = indo_date($selesai_unit->deadline);
            $row[] = $selesai_unit->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$selesai_unit->rekom_id).'"> '.$selesai_unit->file.'  </a>'  ;
          
            $row[] = $selesai_unit->status_name;
            $row[] = $selesai_unit->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('selesai_unit/edit/'.$selesai_unit->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->selesai_unit_m->count_all(),
                    "recordsFiltered" => $this->selesai_unit_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->selesai_unit_m->get();

        $this->template->load('template', 'selesai_unit/selesai_unit_data', $data);
     }

    public function count_data(){
        // $count= $this->selesai_unit_m->count_data();
        // return $count;
        $this->ci->load->model('selesai_unit_m');
        return $this->ci->selesai_unit_m->get()->num_rows();


    }

    public function add(){
        $selesai_unit= new stdClass();
        $selesai_unit->rekom_id= null;
        $selesai_unit->rekomendasi= null;
        $selesai_unit->deadline= null;
        $selesai_unit->activities_id= null;
        $selesai_unit->support= null;
        
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
            'row' => $selesai_unit,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'selesai_unit/selesai_unit_form', $data);

    }

    public function edit($id){
        $selesai_unit= new stdClass();
        $selesai_unit->comment= null;
        $selesai_unit->file= null;
        $query= $this->selesai_unit_m->get($id);
        if($query->num_rows()>0){
            $selesai_unit= $query->row();
            $data= array(
                'page'=>'edit',
                'row' => $selesai_unit
            );
            $this->template->load('template', 'selesai_unit/selesai_unit_form', $data);
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('selesai_unit')."'; </script>";
        }
    }

    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['edit'])){
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'pdf|docx|xlsx|pptx|zip|jpg|jpeg|png';
            $config['max_size']             = 5096;
            $config['file_name']             = $this->fungsi->user_login()->username.'-'.date('d/m/Y').'-'.substr(md5(rand()),0,10);
            $this->load->library('upload', $config);

            if(@$_FILES['file']['name'] != null){
                if ($this->upload->do_upload('file')){
                    $post['file'] = $this->upload->data('file_name');
                    $this->selesai_unit_m->edit($post);
                    if($this->db->affected_rows() > 0 ){
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('selesai_unit');
                }else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('selesai_unit');   

                }    
            }else {
                $post['file'] = null;
                $this->selesai_unit_m->edit($post);
                if($this->db->affected_rows() > 0 ){
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('selesai_unit');
            }
        }
}

     
    public function del($id){
        $this->selesai_unit_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('selesai_unit');
    }

}
