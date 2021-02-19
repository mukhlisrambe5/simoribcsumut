<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function index()
	{
        $this->load->model('tes_m');
		       
        $data['selected'] = $this->tes_m->get();
        $this->template->load('template', 'tes_data', $data);

       
    }
    public function add(){
        $tess= new stdClass();
        $tess->id= null;
        $tess->name= null;
        
        $query_tes= $this->tes_m->get();
        $tes[null]= '-Pilih-';
        foreach($selected as $row){
            $selectie[$row['id']] = $row['name'];
        }

        
        $data= array(
            
            'row' => $rekoms,
            'activities' =>$query_activities,
            // 'user' =>$query_user,
            // 'support' =>$query_support,
            'user' =>$user, 'selecteduser' => null,
            'status' =>$status, 'selectedstatus' => null,
        );
        $this->template->load('template', 'rekoms/rekoms_form', $data);

    }
}
