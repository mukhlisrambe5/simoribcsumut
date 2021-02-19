<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('support_m');
        $this->load->library('form_validation');
    }
    public function index(){
        
        $data['row']= $this->support_m->get();

        $this->template->load('template', 'support/support_data', $data );

    }
    public function add(){
        
        $this->form_validation->set_rules('support_name', 'Unit Pendukung', 'required|min_length[4]|is_unique[tb_support.support_name]');
        

        $this->form_validation->set_message('required','%s masih kosong silahkan diisi');
        $this->form_validation->set_message('min_length','%s minimal 4 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai, silahkan ganti!');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        
        if($this->form_validation-> run() == FALSE){
            $this->template->load('template', 'support/support_form_add');
        }else{
            $post= $this->input->post(null, TRUE);
            $this->support_m->add($post);
            if($this->db->affected_rows() > 0 ){

                echo "<script>alert('Data berhasil ditambahkan');</script>";
            }
            echo "<script>window.location='".site_url('support')."'</script>";
        }

    }

    public function del($id){
        // $id= $this->input->post('support_id');
        $this->support_m->del($id);

        if($this->db->affected_rows()>0){
            echo "<script>alert ('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location= '".site_url('support')."'</script>";
    }

    public function edit($id){
        
        $this->form_validation->set_rules('support_name', 'Unit Pendukung', 'required|min_length[4]|callback_support_name_check');
        
        $this->form_validation->set_message('required','%s masih kosong silahkan diisi');
        $this->form_validation->set_message('min_length','%s minimal 4 karakter');
        

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        
        if($this->form_validation-> run() == FALSE){
            $query= $data['row']= $this->support_m->get($id);
            if($query->num_rows() > 0){
                $data['row'] = $query->row();
                $this->template->load('template', 'support/support_form_edit', $data);
            }else{
                echo "<script>alert('Data tidak ditemukan');</script>";
                echo "<script>window.location='".site_url('support')."'</script>";
            }
            
            ;
        }else{
            $post= $this->input->post(null, TRUE);
            $this->support_m->edit($post);
            if($this->db->affected_rows() > 0 ){

                echo "<script>alert('Data berhasil diubah');</script>";
            }
            echo "<script>window.location='".site_url('support')."'</script>";
        }


    }

    function support_name_check(){
        $post= $this->input->post(null, TRUE);
        $query= $this->db->query("SELECT * FROM tb_support WHERE support_name= '$post[support_name]' AND support_id != '$post[support_id]' ");
        if($query->num_rows>0){
            $this->form_validation->set_message('support_name_check', '{field} sudah dipakai, silahkan ganti!');
            return FALSE;
        }else{
            return TRUE;
        }
    }

}