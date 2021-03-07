<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekom extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['rekom_m', 'status_m','activities_m', 'support_m', 'user_m']);
        $this->load->library('form_validation');
    }
    public function index(){
        
        $data['row']= $this->rekom_m->get();

        $this->template->load('template', 'rekom/rekom_data', $data );

        

    }
    public function add(){

        $data['activities']= $this->rekom_m->get();
        
        
        $this->form_validation->set_rules('rekom_name', 'Unit Pendukung', 'required|min_length[4]|is_unique[tb_rekom.rekom_name]');
        

        $this->form_validation->set_message('required','%s masih kosong silahkan diisi');
        $this->form_validation->set_message('min_length','%s minimal 4 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai, silahkan ganti!');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        
        if($this->form_validation-> run() == FALSE){
            $this->template->load('template', 'rekom/rekom_form_add');
        }else{
            $post= $this->input->post(null, TRUE);
            $this->rekom_m->add($post);
            if($this->db->affected_rows() > 0 ){

                echo "<script>alert('Data berhasil ditambahkan');</script>";
            }
            echo "<script>window.location='".site_url('rekom')."'</script>";
        }

    }

    public function del($id){
        // $id= $this->input->post('rekom_id');
        $this->rekom_m->del($id);

        if($this->db->affected_rows()>0){
            echo "<script>alert ('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location= '".site_url('rekom')."'</script>";
    }

    public function edit($id){
        
        $this->form_validation->set_rules('rekom_name', 'Unit Pendukung', 'required|min_length[4]');
        
        $this->form_validation->set_message('required','%s masih kosong silahkan diisi');
        $this->form_validation->set_message('min_length','%s minimal 4 karakter');
        

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        
        if($this->form_validation-> run() == FALSE){
            $query= $data['row']= $this->rekom_m->get($id);
            if($query->num_rows() > 0){
                $data['row'] = $query->row();
                $this->template->load('template', 'rekom/rekom_form_edit', $data);
            }else{
                echo "<script>alert('Data tidak ditemukan');</script>";
                echo "<script>window.location='".site_url('rekom')."'</script>";
            }
            
            ;
        }else{
            $post= $this->input->post(null, TRUE);
            $this->rekom_m->edit($post);
            if($this->db->affected_rows() > 0 ){

                echo "<script>alert('Data berhasil diubah');</script>";
            }
            echo "<script>window.location='".site_url('rekom')."'</script>";
        }
    }
}