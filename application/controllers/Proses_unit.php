<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_unit extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
       
        $this->load->model(['proses_unit_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->proses_unit_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $proses_unit) {
            // $x= $proses_unit->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $proses_unit->rekomendasi;
            $row[] = $proses_unit->activities_name;
            // $row[] = $proses_unit->user_name;
            $row[] = $proses_unit->support;
            $row[] = indo_date($proses_unit->deadline);
            $row[] = $proses_unit->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$proses_unit->rekom_id).'"> '.$proses_unit->file.'  </a>'  ;
          
            $row[] = $proses_unit->status_name;
            $row[] = $proses_unit->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('proses_unit/edit/'.$proses_unit->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->proses_unit_m->count_all(),
                    "recordsFiltered" => $this->proses_unit_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->proses_unit_m->get();

        $this->template->load('template', 'proses_unit/proses_unit_data', $data);
     }

    public function count_data(){
        // $count= $this->proses_unit_m->count_data();
        // return $count;
        $this->ci->load->model('proses_unit_m');
        return $this->ci->proses_unit_m->get()->num_rows();


    }

    public function add(){
        $proses_unit= new stdClass();
        $proses_unit->rekom_id= null;
        $proses_unit->rekomendasi= null;
        $proses_unit->deadline= null;
        $proses_unit->activities_id= null;
        $proses_unit->support= null;
        
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
            'row' => $proses_unit,
            'activities' =>$query_activities,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'proses_unit/proses_unit_form', $data);

    }

    public function edit($id){
        $proses_unit= new stdClass();
        $proses_unit->comment= null;
        $proses_unit->file= null;


        $query= $this->proses_unit_m->get($id);
        if($query->num_rows()>0){
            $proses_unit= $query->row();


            $data= array(
                'page'=>'edit',
                'row' => $proses_unit,
                
            );
            $this->template->load('template', 'proses_unit/proses_unit_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('proses_unit')."'; </script>";
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
                    $this->proses_unit_m->edit($post);
                    if($this->db->affected_rows() > 0 ){
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('proses_unit');
                }else {
                    $eroor = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('proses_unit');   

                }    
            }else {
                $post['file'] = null;
                $this->proses_unit_m->edit($post);
                if($this->db->affected_rows() > 0 ){
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('proses_unit');
            }
        }
}

     
    public function del($id){
        $this->proses_unit_m->del($id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('proses_unit');
    }

}
