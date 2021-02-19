<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
       
        $this->load->model('change_m');
        $this->load->library('form_validation');
    }
    public function index(){
        
        $data['row']= $this->change_m->get();
        $this->template->load('template', 'change/change_data', $data );

    }

    public function edit(){
        $data['row']= $this->change_m->get();
        $id= $this->input->post('user_id');
        
        if($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Passaword','required|matches[password]',  array('matches' => '%s tidak sesuai dengan password'));
        }
        
        if($this->input->post('passconf')){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Passaword','required|matches[password]',  array('matches' => '%s tidak sesuai dengan password'));
        }

        
        $this->form_validation->set_message('required','%s masih kosong silahkan diisi');
        $this->form_validation->set_message('min_length','%s minimal 4 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai, silahkan ganti!');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        
        if($this->form_validation-> run() == FALSE){
            $query= $data['row']= $this->change_m->get($id);
            if($query->num_rows() > 0){
                $data['row'] = $query->row();
                $this->template->load('template', 'change/change_data', $data);
            }else{
                echo "<script>alert('Data tidak ditemukan');</script>";
                echo "<script>window.location='".site_url('change')."'</script>";
            }
            
            ;
        }else{
            $post= $this->input->post(null, TRUE);
            $this->change_m->edit($post);
            if($this->db->affected_rows() > 0 ){
    
                echo "<script>alert('Password berhasil diubah');</script>";
            }
            echo "<script>window.location='".site_url('change')."'</script>";
        }


    }

}