<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

    function __construct(){
        parent:: __construct();
        check_not_login();
        check_admin();
        $this->load->model('activities_m');
    }

    public function index(){

        $data['row']= $this->activities_m->get();
		$this->template->load('template', 'activities/activities_data', $data);
    }
    
    public function del($id){
		$this->activities_m->del($id);
		if($this->db->affected_rows() > 0 ){
			echo "<script> alert('Data berhasil dihapus '); </script>";
		}
		echo "<script> window.location='".site_url('activities')."'; </script>";
    }

    public function add(){
        $activities= new stdClass();
        $activities->activities_id= null;
        $activities->activities_name= null;
        $activities->info= null;

        $data= array(
            'page' => 'add',
            'row' => $activities
        );

        $this->template->load('template', 'activities/activities_form', $data);
    }

    public function edit($id){
        $query= $this->activities_m->get($id);
        if($query->num_rows()>0){
            $activities= $query->row();
            $data= array(
                'page'=>'edit',
                'row' => $activities
            );
            $this->template->load('template', 'activities/activities_form', $data);
        }else {
            echo "<script> alert('Data tidak ditemukan! '); </script>";
            echo "<script> window.location='".site_url('activities')."'; </script>";
        }
    }




    public function process(){
        $post= $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->activities_m->add($post);
        }else{
            if(isset($_POST['edit'])){
                $this->activities_m->edit($post);
            }
        }
        if($this->db->affected_rows() > 0 ){
            echo "<script> alert('Data berhasil disimpan '); </script>";
        
        }
        echo "<script> window.location='".site_url('activities')."'; </script>";
    }
}