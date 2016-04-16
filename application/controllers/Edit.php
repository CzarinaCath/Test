<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

   function __construct(){
      parent::__construct();

      $this->load->model('Auth_model');
   }

   public function edituser(){

      $this->load->helper('form');
      $this->load->library('form_validation');
      
      $this->load->view('tpl/full-page/header');
      $this->load->view('tpl/full-page/navbar');

      $data['info'] = $this->Auth_model->AllDataDetails('contacts','Username__c',$this->session->userdata('account')['username']);
      $data['content'] = 'auth/edituser';
      $this->load->view('auth/edituser',$data);
      $this->load->view('tpl/full-page/footer');
   }

 
   public function update(){

      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('bcrypt');
      $this->load->library('session');
          
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
      $this->form_validation->set_rules('verify_password','Verify password','matches[password]');
      
      $pass = $this->input->post('password');

      if($pass != null){

         $id= $this->input->post('id');
         $data = array(
         'Firstname' => $this->input->post('firstname'),
         'LastName' => $this->input->post('lastname'),
         'Username__c' => $this->input->post('username'),
         'ArchPassword__c'=> $this->bcrypt->hash($this->input->post('password')), );

         $this->Auth_model->update_contact($id,$data);  }

      else{

         $id= $this->input->post('id');
         $data = array(
         'Firstname' => $this->input->post('firstname'),
         'LastName' => $this->input->post('lastname'),
         'Username__c' => $this->input->post('username'), );
         
         $this->Auth_model->update_contact($id,$data);  }


   }
}
