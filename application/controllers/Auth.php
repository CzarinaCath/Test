<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

   function __construct(){
      parent::__construct();

      $this->load->model('Auth_model');
   }

   function _validateuser($username){
      $details = $this->Auth_model->AllDataDetails('contacts','Username__c', $username);

      if(strlen($this->input->post('password')) == 0){
         $this->form_validation->set_message('_validateuser','Password field cannot be empty');
         return false;
      }

      if($details->num_rows() > 0){
         
         if($details->row()->Access_Level__c == "For Approval"){
            $this->form_validation->set_message('_validateuser','You account is still pending for approval');
            return false;
         }

         $this->load->library('Bcrypt');

         if($this->bcrypt->verify($this->input->post('password'), $details->row()->ArchPassword__c)){
            return true;
         }
      }

      $this->form_validation->set_message('_validateuser','Invalid username or password');

      return false;
   }

	public function index()
	{

	}

   public function register(){
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('Archintel_model');

      if($this->input->post('company') != null){
         if(!$this->Auth_model->DataExists('accounts','Name', $this->input->post('company'))){
            $this->form_validation->set_rules('industry','Industry','required');
            $this->form_validation->set_rules('no_of_employees','Number of employees','required');
            $this->form_validation->set_rules('company_phone','Phone','required');
            //$this->form_validation->set_rules('company_email','Email','required|valid_email');
            //$this->form_validation->set_rules('company_address','Address','required');
            $this->form_validation->set_rules('revenue','Annual revenue','required|greater_than[0]');
            $this->form_validation->set_rules('city','City','required');
            $this->form_validation->set_rules('street','Street','required');
            $this->form_validation->set_rules('country','Country','required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('postal','Postal code','required');
         }
      }

      $this->form_validation->set_rules('title','Title','required');
      $this->form_validation->set_rules('firstname','Firstname','required');
      $this->form_validation->set_rules('lastname','Lastname','required');
      $this->form_validation->set_rules('email','E-mail','required|valid_email');
      $this->form_validation->set_rules('phone','Phone','required');
      $this->form_validation->set_rules('username','Username','required|is_unique[contacts.Username__c]|valid_email');
      $this->form_validation->set_rules('password','Password','required|min_length[6]');
      $this->form_validation->set_rules('verify_password','Verify password','matches[password]');
      $this->form_validation->set_rules('company','Company','required');

      $this->form_validation->set_message('is_unique','The username is already taken');

      if($this->form_validation->run() === false){
         $data['content'] = 'auth/register';
         $data['js'] = array(
            base_url('assets/js/jquery.autocomplete.min.js'),
            base_url('assets/js/pwstrength-bootstrap-1.2.9.min.js'),
            base_url('assets/js/jquery.maskMoney.min.js')
         );
         $data['scripts'] = array('scripts/register');
         $data['accounts'] = $this->Archintel_model->GetAccounts();
         $this->load->view('tpl/full-page/main', $data);
      }else{

         $exists = $this->Auth_model->DataExists('accounts','Name', $this->input->post('company'));

         /*if($exists){
            $account_details = $this->Archintel_model->AllDataDetails('accounts','Name', $this->input->post('company'));
         }

         $account = array();
         $account['Name'] = $this->input->post('company');
         $account['Industry'] = $exists ? $account_details->Industry : $this->input->post('industry');
         $account['ArchIntelId__c'] = $exists ? $account_details->ArchIntelId__c : $this->archintel->guidv4();
         $account['BillingStreet'] = $exists ? $account_details->BillingStreet : $this->input->post('street');
         $account['BillingCity'] = $exists ? $account_details->BillingCity : $this->input->post('city');
         $account['BillingCountry'] = $exists ? $account_details->BillingCountry : $this->input->post('country');
         $account['BillingState'] = $exists ? $account_details->BillingState : $this->input->post('state');
         $account['BillingPostalCode'] = $exists ? $account_details->BillingPostalCode : $this->input->post('postal');
         $account['Fax'] = $exists ? $account_details->Fax : $this->input->post('fax');
         $account['Active__c'] = false;
         $account['ArchIntel_Status__c'] = 'Inactive';
         $account['Phone'] = $this->input->post('phone');

         */

         $this->load->library('bcrypt');

         $contact = array();
         $contact['FirstName'] = $this->input->post('firstname');
         $contact['LastName'] = $this->input->post('lastname');
         $contact['Username__c'] = $this->input->post('username');
         $contact['ArchPassword__c'] = $this->bcrypt->hash($this->input->post('password'));
         $contact['Access_Level__c'] = "For Approval";

         $this->load->library('Salesforce');

         if(!$exists){
            $account = array();
            $account['Name'] = $this->input->post('company');
            $account['Industry'] = $this->input->post('industry');
            $account['ArchIntelId__c'] = $this->archintel->guidv4();
            $account['BillingStreet'] = $this->input->post('street');
            $account['BillingCity'] = $this->input->post('city');
            $account['BillingCountry'] = $this->input->post('country');
            $account['BillingState'] = $this->input->post('state');
            $account['BillingPostalCode'] = $this->input->post('postal');
            $account['Fax'] = $this->input->post('fax');
            $account['Active__c'] = false;
            $account['ArchIntel_Status__c'] = 'Inactive';
            $account['Phone'] = $this->input->post('phone');

            $lead = new stdclass();
            $lead->ArchIntelId__c = $account['ArchIntelId__c'];
            $lead->AnnualRevenue = $this->input->post('revenue');
            $lead->ArchPassword__c = $this->bcrypt->hash($this->input->post('password'));
            $lead->City = $this->input->post('city');
            $lead->Company = $this->input->post('company');
            $lead->Country = $this->input->post('country');
            $lead->Email = $this->input->post('email');
            $lead->Fax = $this->input->post('fax');
            $lead->FirstName = $this->input->post('firstname');
            $lead->Industry = $this->input->post('industry');
            $lead->LastName = $this->input->post('lastname');
            $lead->Phone = $this->input->post('phone');
            $lead->PostalCode = $this->input->post('postal');
            $lead->Street = $this->input->post('street');
            $lead->Title = $this->input->post('title');
            $lead->Username__c = $this->input->post('username');

            if($this->salesforce->CreateLead($lead) && $this->Auth_model->CreateContact($contact) && $this->Auth_model->CreateAccount($account)){
               $this->session->SuccessMessage('Registration complete, our sales representative will review your registration and will get in touch with you');
            }else{
               $this->session->ErrorMessage('Registration failed. Please contact us for assistance');
            }
         }else{
            $contact['AccountID'] = $this->Auth_model->AllDataDetails('accounts','Name', $this->input->post('company'))->row()->SalesforceID;

            if($contact['AccountID'] == ''){
               $this->session->ErrorMessage('The company you selected is still being reviewed. Registration will not proceed');
            }else{
               $contact_sf = new stdclass();
               $contact_sf->FirstName = $this->input->post('firstname');
               $contact_sf->LastName = $this->input->post('lastname');
               $contact_sf->AccountId = $contact['AccountID'];
               $contact_sf->Username__c = $this->input->post('username');
               $contact_sf->ArchPassword__c = $contact['ArchPassword__c'];
               $contact_sf->Title = $this->input->post('title');
               $contact_sf->Email = $this->input->post('email');

               $contact['SalesforceID'] = $this->salesforce->CreateContact($contact_sf);

               if($contact['SalesforceID'] == null){
                  $this->session->ErrorMessage('Error sending data to salesforce, please try again');
               }else{
                  if($this->Auth_model->CreateContact($contact))
                     $this->session->SuccessMessage('Registration complete, your account will be reviewed by your administrator');
                  else
                     $this->session->ErrorMessage('Registration failed. Please contact us for assistance');
               }
            }
         }         

         redirect(base_url('auth/register'), 'refresh');

      }
   }

   public function signin(){

      if($this->session->ValidSession()){
         redirect(base_url());
      }

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('username','Username','required|callback__validateuser');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Error!</h4>','</div>');

      if($this->form_validation->run() === false){
         $data['content'] = 'auth/signin';
         $this->load->view('tpl/full-page/main', $data);
      }else{
         $data = array(
            'last_activity' => date('Y-m-d H:i:s', time()),
            'username' => $this->input->post('username'),
            'ip_address' => $this->input->ip_address()
         );

         $this->session->SetSession($data);

         if($this->input->post('next') != null){
            redirect($this->input->post('next'));
         }

         redirect(base_url(),'refresh');
      }
   }

   public function signout(){
      if($this->session->ValidSession()){
         $this->session->Destroy();
         $this->session->SuccessMessage('You have been signed out');
         redirect(base_url('auth/signin'), 'refresh');
      }else{
         redirect(base_url());
      }
   }
}
