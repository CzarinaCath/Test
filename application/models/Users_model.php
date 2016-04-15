<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


	function AddUser($data){
		$this->db->insert('contacts', $data);

		return $this->db->affected_rows() == 1 ? true : false;
	}

	function DeleteUser($id){
		$this->db->where('ID', $id);
		$this->db->delete('contacts');

		return $this->db->affected_rows() == 1 ? true : false;
	}

	function Details($id){
		$this->db->select('ID');
		$this->db->select('SalesforceID');
		$this->db->select('FirstName');
		$this->db->select('LastName');
		$this->db->select('Username__c');
		$this->db->select('ArchPassword__c');
		$this->db->select('AccountID');
		$this->db->select('Access_Level__c');
		$this->db->from('contacts');
		$this->db->where('ID', $id);

		return $this->db->get()->row();
	}

	function UpdateUser($data, $id){
		$this->db->where('ID', $id);
		$this->db->update('contacts', $data);

		return $this->db->affected_rows() == 1 ? true : false;
	}

	function UserList($account = null){
		$this->db->select('ID');
		$this->db->select('SalesforceID');
		$this->db->select('FirstName');
		$this->db->select('LastName');
		$this->db->select('Username__c');
		$this->db->select('ArchPassword__c');
		$this->db->select('AccountID');
		$this->db->select('Access_Level__c');
		$this->db->from('contacts');

		if($account != null)
			$this->db->where('AccountID', $account);

		return $this->db->get();
	}
}
