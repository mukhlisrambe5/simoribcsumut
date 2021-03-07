<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi{
    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('user_m');
        $user_id= $this->ci->session->userdata('userid');
        $user_data= $this->ci->user_m->get($user_id)->row();
        return $user_data;

    }

    public function count_semua(){
        $this->ci->load->model('rekoms_m');
        return $this->ci->rekoms_m->get()->num_rows();
    }


    public function count_belum(){
        $this->ci->load->model('belum_m');
        return $this->ci->belum_m->get()->num_rows();
    }

    public function count_proses(){
        $this->ci->load->model('proses_m');
        return $this->ci->proses_m->get()->num_rows();
    }

    public function count_selesai(){
        $this->ci->load->model('selesai_m');
        return $this->ci->selesai_m->get()->num_rows();
    }

    public function count_hampir(){
        $this->ci->load->model('hampir_m');
        return $this->ci->hampir_m->get()->num_rows();
    }
    
    public function count_lewat(){
        $this->ci->load->model('lewat_m');
        return $this->ci->lewat_m->get()->num_rows();
    }

    public function count_unit_semua(){
        $this->ci->load->model('rekoms_unit_m');
        return $this->ci->rekoms_unit_m->get()->num_rows();
    }

    public function count_unit_belum(){
        $this->ci->load->model('belum_unit_m');
        return $this->ci->belum_unit_m->get()->num_rows();
    }

    public function count_unit_proses(){
        $this->ci->load->model('proses_unit_m');
        return $this->ci->proses_unit_m->get()->num_rows();
    }

    public function count_unit_selesai(){
        $this->ci->load->model('selesai_unit_m');
        return $this->ci->selesai_unit_m->get()->num_rows();
    }

    public function get_kegiatan($id){
        // $ci=& get_instance();
        $this->ci->load->model('rekoms_m');
        $query= $this->ci->rekoms_m->get_kegiatan($id);
        return $query->row()->activities_name;
    }

    public function get_status($id){
        // $ci=& get_instance();
        $this->ci->load->model('status_m');
        $query= $this->ci->status_m->get_status($id);
        return $query->row()->status_name;
    }


}