<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		return;
	}

   public function executive_mosaic(){
      $data['content'] = 'about/executive-mosaic';
      $this->load->view('tpl/full-page/main', $data);
   }
}
