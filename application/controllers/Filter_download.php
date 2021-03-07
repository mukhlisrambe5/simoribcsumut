<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_download extends CI_Controller {

    function __construct(){
        parent::__construct();
        check_not_login();
        
        $this->load->model(['filter_download_m', 'rekoms_m']);
        
    }

   
    public function index(){
        $data['row']= $this->filter_download_m->get();
        $this->template->load('template', 'filter_download/filter_download_data', $data);
     }

     public function get_kegiatan($id){
        $query=$this->rekoms_m->get_kegiatan($id);
        if($query->num_rows()>0){
            $row= $query->row();
            return $row->activities_name;
        }
    }

     
     public function filter(){
        if(isset($_POST['filter'])){
            // global $tgl_awal, $tgl_akhir ;
            $tgl_awal= $this->input->post('tgl_awal');
            $tgl_akhir= $this->input->post('tgl_akhir');
            $data['row']=$query=$this->filter_download_m->filter($tgl_awal, $tgl_akhir);
            
            if($query->num_rows() > 0){
            // $this->template->load('template', 'filter_download/filtered_data', $data);
            $this->template->load('template', 'filter_download/filter_download_data', $data);
            }else{
                echo "<script> alert('Tanggal salah / Data tidak ditemukan !'); </script>";
                echo "<script> window.location='".site_url('filter_download')."'; </script>";
            }
        }
    }

    public function excel(){
        if(isset($_POST['excel'])){
            $tgl_awal= $this->input->post('tgl_awal2');
            $tgl_akhir= $this->input->post('tgl_akhir2');
            $data['row']=$query=$this->filter_download_m->filter($tgl_awal, $tgl_akhir);
            
            if($query->num_rows() > 0){
                $this->template->load('template', 'filter_download/filter_download_data', $data);
            
                require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
                require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
            
                $object= new PHPExcel();
                $object->getProperties()->setCreator("Simori");
                $object->getProperties()->setLastModifiedBy("Simori");
                $object->getProperties()->setTitle("Data SIMORI");
                
                $object->setActiveSheetIndex(0);

                $object->getActiveSheet()->setCellValue('A1','No.');
                $object->getActiveSheet()->setCellValue('B1','Rekomendasi');
                $object->getActiveSheet()->setCellValue('C1','Kegiatan');
                $object->getActiveSheet()->setCellValue('D1','Unit Pendukung');
                $object->getActiveSheet()->setCellValue('E1','Batas Waktu');
                $object->getActiveSheet()->setCellValue('F1','Tanggapan');
                $object->getActiveSheet()->setCellValue('G1','File');
                $object->getActiveSheet()->setCellValue('H1','Status');
                $object->getActiveSheet()->setCellValue('I1','Tanggapan_KI');
                
                
                

                $baris =2;
                $no= 1;

            // foreach($data['row'] as $datafilter){
                foreach($data['row']->result() as $key =>$datafilter){
                    $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
                    $object->getActiveSheet()->setCellValue('B'.$baris, $datafilter->rekomendasi);
                    $object->getActiveSheet()->setCellValue('C'.$baris, $this->fungsi->get_kegiatan($datafilter->activities_id));
                    $object->getActiveSheet()->setCellValue('D'.$baris, $datafilter->support);
                    $object->getActiveSheet()->setCellValue('E'.$baris, $datafilter->deadline);
                    $object->getActiveSheet()->setCellValue('F'.$baris, $datafilter->comment);
                    $object->getActiveSheet()->setCellValue('G'.$baris, $datafilter->file);
                    $object->getActiveSheet()->setCellValue('H'.$baris, $this->fungsi->get_status($datafilter->status_id));
                    $object->getActiveSheet()->setCellValue('I'.$baris, $datafilter->komentar_ki);
                    
                      
                    
                    $baris++;
            }
            $filename= "Data_Simori_BC_Sumut".'.xlsx';
            $object->getActiveSheet()->setTitle("Data SIMORI");
            header('Content-Type: application/vnd. openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename. '"');
            header('Cache-Control: max-age=0');

            $writer= PHPExcel_IOFactory::createWriter($object, 'Excel2007');
            $writer->save('php://output');

            exit;
            }else{
                echo "<script> alert('Tanggal salah/data tidak ditemukan! Periksa kembali tanggal yang Anda pilih.'); </script>";
                echo "<script> window.location='".site_url('filter_download')."'; </script>";
            }
        }
    }
}
