<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

   public function article(){
      $data['content'] = 'home';
		$this->load->view('tpl/full-page/main', $data);
   }

	public function index()
	{
		$data['content'] = 'home';
		$this->load->view('tpl/full-page/main', $data);
	}
}
