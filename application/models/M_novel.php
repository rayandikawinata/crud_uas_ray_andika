<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_novel extends CI_Model {
	var $table = 'tb_novel';


	public function novel_tambah($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function Getalldata(){
		$this->db->from($this->table);
		$query =$this->db->get();
		return $query->result();

	}
	public function edit_novel($where, $data){
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function Getbyid($id){
		$this->db->from('tb_novel');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}
	public function delete_novel($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);

	}
}