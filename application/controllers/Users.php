<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

   function __construct(){
      parent::__construct();

      if(!$this->session->ValidSession()){
         $this->session->ErrorMessage('You are not signed in');
         redirect(base_url('auth/signin'), 'refresh');
      }

      if($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->Access_Level__c != 'Administrator'){
         $this->session->ErrorMessage('You do not have enough permissions');
         redirect(base_url(), 'refresh');
      }

      $this->load->model('Users_model');
   }

   function _checkusername($username){
      $details = $this->Archintel_model->AllDetails('contacts','Username__c',$username);

      if($details == null){
         return true;
      }

      if($details->ID != $this->input->post('id')){
         $this->form_validation->set_message('_checkusername','Username is already taken');
         return false;
      }

      return true;
   }

   public function add(){
      $data['content'] = 'users/add';

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('firstname','Firstname','required');
      $this->form_validation->set_rules('lastname','Lastname','required');
      $this->form_validation->set_rules('username','Username','required|is_unique[contacts.Username__c]|valid_email');
      $this->form_validation->set_rules('password','Password','required|min_length[4]');
      $this->form_validation->set_rules('vpassword','Verify password','required|matches[password]');
      $this->form_validation->set_message('is_unique','Username already exists');
      $this->form_validation->set_message('valid_email','Username must be in an email format');

      if($this->form_validation->run() === false){
         $this->load->view('tpl/full-page/main', $data);
      }else{

         $this->load->library('Bcrypt');

         $contact = new stdclass();
         $contact->FirstName = $this->input->post('firstname');
         $contact->LastName = $this->input->post('lastname');
         $contact->Username__c = $this->input->post('username');
         $contact->ArchPassword__c = $this->bcrypt->hash($this->input->post('password'));
         $contact->Access_Level__c = $this->input->post('access_level');
         $contact->AccountId = $this->Auth_model->AllDataDetails('contacts','Username__c', $this->session->userdata('aiaccount')['username'])->row()->AccountID;

         $this->load->library('Salesforce');

         $id = $this->salesforce->CreateContact($contact);

         $data = array(
            'SalesforceID' => $id,
            'FirstName'    => $this->input->post('firstname'),
            'LastName'     => $this->input->post('lastname'),
            'Username__c'  => $this->input->post('username'),
            'ArchPassword__c' => $contact->ArchPassword__c,
            'Access_Level__c' => $this->input->post('access_level'),
            'AccountID'    => $this->Auth_model->AllDataDetails('contacts','Username__c', $this->session->userdata('aiaccount')['username'])->row()->AccountID
            );

         if($this->Users_model->AddUser($data)){
            $this->session->SuccessMessage('A new user has been added');
         }else{
            $this->session->ErrorMessage('An error occured while trying to add a new user');
         }

         redirect(base_url('users'), 'refresh');
      }
   }

   public function edit($id){
      $data['content'] = 'users/edit';
      $data['scripts'] = array('scripts/edituser');
      $data['details'] = $this->Users_model->Details($id);

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('firstname','Firstname','required');
      $this->form_validation->set_rules('lastname','Lastname','required');
      $this->form_validation->set_rules('username','Username','required|valid_email|callback__checkusername');

      if($this->input->post('samepassword') == null){
         $this->form_validation->set_rules('password','Password','required|min_length[4]');
         $this->form_validation->set_rules('vpassword','Verify password','required|matches[password]');
      }

      if($this->form_validation->run() === false){
         $this->load->view('tpl/full-page/main', $data);
      }else{
         $contacts[0] = new stdclass();
         $contacts[0]->Id = $this->input->post('salesforceID');
         $contacts[0]->FirstName = $this->input->post('firstname');
         $contacts[0]->LastName = $this->input->post('lastname');
         $contacts[0]->Username__c = $this->input->post('username');
         if($this->input->post('samepassword') == null){
            $this->load->library('Bcrypt');
            $contacts[0]->ArchPassword__c = $this->bcrypt->hash($this->input->post('password'));
         }
         $contacts[0]->Access_Level__c = $this->input->post('access_level');

         $this->load->library('Salesforce');
         $id = $this->salesforce->UpdateContact($contacts);

         $data = array(
            'FirstName'    => $this->input->post('firstname'),
            'LastName'     => $this->input->post('lastname'),
            'Username__c'  => $this->input->post('username'),
            'Access_Level__c' => $this->input->post('access_level'),
            );

         if($this->input->post('samepassword') == null)
            $data['ArchPassword__c'] = $contacts[0]->ArchPassword__c;

         if($this->Users_model->UpdateUser($data, $this->input->post('id'))){
            $this->session->SuccessMessage('The selected record has been updated');
         }else{
            $this->session->ErrorMessage('An error occured while trying to update the selected record');
         }

         redirect(base_url('users'), 'refresh');
      }
   }

   public function delete($id){

      $this->load->helper('form');

      if($this->input->post('delete') == null){
         $data['details'] = $this->Users_model->Details($id);
         $data['content'] = 'users/delete';
         $this->load->view('tpl/full-page/main', $data);
      }else{
         $ids = array($this->Auth_model->AllDataDetails('contacts','Username__c', $this->session->userdata('aiaccount')['username'])->row()->SalesforceID);
         $this->load->library('Salesforce');

         $this->salesforce->DeleteContact($ids);

         if($this->Users_model->DeleteUser($id)){
            $this->session->SuccessMessage('The selected record has been successfully deleted');
         }else{
            $this->session->ErrorMessage('An error occured while trying to delete the selected record');
         }

         redirect(base_url('users'), 'refresh');
      }
   }

	public function index()
	{
		$data['content'] = 'users/list';
      $data['users'] = $this->Users_model->UserList($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->AccountID);
      $this->load->view('tpl/full-page/main', $data);
	}

   public function search_form(){
      $this->load->helper('form');

      $this->load->view('search');
   }
}
