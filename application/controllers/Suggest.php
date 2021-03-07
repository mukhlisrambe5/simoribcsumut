<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggest extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('suggest_m');
    }
    public function index(){
        
        $data['row']= $this->suggest_m->get();

        $this->template->load('template', 'suggest/suggest_data', $data );

    }

    public function add(){
        
        $post= $this->input->post(null, TRUE);
        $this->suggest_m->add($post);
        if($this->db->affected_rows() > 0 ){

            echo "<script>alert('Saran/Masukan berhasil dikirim');</script>";
        }
        echo "<script>window.location='".site_url('dashboard')."'</script>";
    }

}

