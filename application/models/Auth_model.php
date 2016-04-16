<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function AddUser($data){
		$this->db->insert('users', $data);

		return $this->db->affected_rows() > 0 ? $this->db->insert_id() : false;
	}

	function AllDataDetails($table, $field, $value){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field, $value);

		return $this->db->get();
	}

	function CreateAccount($data){
		$this->db->insert('accounts', $data);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	function CreateContact($data){
		$this->db->insert('contacts', $data);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	function DataExists($table, $field, $value){
		$this->db->select($field);
		$this->db->from($table);
		$this->db->where($field, $value);

		return $this->db->get()->num_rows() > 0 ? true : false;
	}

	function SetupDone(){
      $this->db->select('ID');
      $this->db->from('users');
      $this->db->where('user_type','ADMIN');

      return $this->db->get()->num_rows() > 0 ? true : false;
   }

	function UserDetails($value, $field = 'ID'){
		$this->db->select('ID');
		$this->db->select('email');
		$this->db->select('username');
		$this->db->select('password');
		$this->db->select('user_type');
		$this->db->select('password_reset_key');
		$this->db->select('password_reset_date');
		$this->db->select('status');
		$this->db->from('users');
		$this->db->where($field, $value);

		$result = $this->db->get();

		return $result->num_rows() == 1 ? $result->row() : false;
	}
	
	public function update_contact($id,$data){

		$this->load->library('session');

		$this->db->select('ID');
		$this->db->from('contacts');
		$this->db->where('ID', $id);
		$this->db->update('contacts', $data);

	    $this->load->view('tpl/full-page/header');
        $this->load->view('tpl/full-page/navbar');
		$this->load->view('auth/updated');
		$this->load->view('tpl/full-page/footer');

		}

}
