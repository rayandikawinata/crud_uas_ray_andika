<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah_novel extends CI_Controller {
	public function __construct(){
         parent::__construct();
         $this->load->model('m_novel');
     }

	public function index()
	{
		$data['tb_novel'] = $this->m_novel->Getalldata();
		$this->load->view('v_novel', $data);
	}
	public function novel_tambah() {
		$data = array(

			'kode_novel' 	=> $this->input->post('kode_novel'),
			'penulis'		=> $this->input->post('penulis'),
			'judul' 		=> $this->input->post('judul'),
			'tanggal' 		=> $this->input->post('tanggal')
			);

		$insert = $this->m_novel->novel_tambah($data);
		echo json_encode(array("status" => true));
	}
	public function ajax_edit($id) {
		$data = $this->m_novel->Getbyid($id);
		echo json_encode($data);
	}
	public function novel_update() {

		$data = array(

			'kode_novel' 	=> $this->input->post('kode_novel'),
			'penulis' 		=> $this->input->post('penulis'),
			'judul' 		=> $this->input->post('judul'),
			'tanggal' 		=> $this->input->post('tanggal')

			);
		$this->m_novel->edit_novel(array('id'=> $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));
	}
	public function novel_delete($id) {
		$this->m_novel->delete_novel($id);
		echo json_encode(array("status" => TRUE));

	}
	
}
