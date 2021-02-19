<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekoms_unit extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        
        $this->load->model(['rekoms_unit_m', 'status_m','activities_m', 'user_m']);
        
    }

    function get_ajax() {
        $list = $this->rekoms_unit_m->get_datatables();  
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $rekoms_unit) {
            // $x= $rekoms_unit->rekom_id;
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $rekoms_unit->rekomendasi;
            $row[] = $rekoms_unit->activities_name;
            // $row[] = $rekoms_unit->user_name;
            $row[] = $rekoms_unit->support;
            $row[] = indo_date($rekoms_unit->deadline);
            $row[] = $rekoms_unit->comment;
            $row[] = '<a href="'.site_url('rekoms_unit/download/'.$rekoms_unit->rekom_id).'"> '.$rekoms_unit->file.'  </a>'  ;
          
            $row[] = $rekoms_unit->status_name;
            $row[] = $rekoms_unit->komentar_ki;

            // add html for action
            $row[] = '<a href="'.site_url('rekoms_unit/edit/'.$rekoms_unit->rekom_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->rekoms_unit_m->count_all(),
                    "recordsFiltered" => $this->rekoms_unit_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index(){
    
        $data['row']= $this->rekoms_unit_m->get();
        $this->template->load('template', 'rekoms_unit/rekoms_unit_data', $data);
     }

    public function edit($id){
        $rekoms_unit= new stdClass();
        $rekoms_unit->comment= null;
        $rekoms_unit->file= null;


        $query= $this->rekoms_unit_m->get($id);
        if($query->num_rows()>0){
            $rekoms_unit= $query->row();


            $data= array(
                'page'=>'edit',
                'row' => $rekoms_unit,
                
            );
            $this->template->load('template', 'rekoms_unit/rekoms_unit_form', $data);
            
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('rekoms_unit')."'; </script>";
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
                    $this->rekoms_unit_m->edit($post);
                    if($this->db->affected_rows() > 0 ){
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('rekoms_unit');
                }else {
                    $eroor = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('rekoms_unit');   

                }    
            }else {
            
                $post['file'] = null;
                $this->rekoms_unit_m->edit($post);
                if($this->db->affected_rows() > 0 ){
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('rekoms_unit');
            }
        }
    }

    public function download($id){
        $data = $this->db->get_where('tb_rekom',['rekom_id'=>$id])->row();
		force_download('uploads/'.$data->file,NULL);
    }

}
