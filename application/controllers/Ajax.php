<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

   function __construct(){
      parent::__construct();

      if(!$this->input->is_ajax_request()){
         //throw new Exception('Not an ajax request');
         print_r('Not an ajax request');
         exit;
      }
   }

	public function index()
	{
		return;
	}

   public function search_form(){
      $this->load->helper('form');

      $this->load->view('search-form');
   }
}
