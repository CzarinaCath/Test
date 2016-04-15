<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$data['content'] = 'search';
		$data['js'] = array(
            base_url('assets/js/jquery.autocomplete.min.js')
         );

		//if($this->session->ValidSession())
		$data['searches'] = $this->Archintel_model->GetSearches($this->session->ValidSession() ? $this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->ID : null);
		//$data['medias'] = $this->Archintel_model->SearchMedia($this->input->get('keyword') != null ? $this->input->get('keyword') : null);
		//$data['medias'] = $this->Archintel_model->SearchMedia($this->input->get('keyword') != null ? $this->input->get('keyword') : ($this->input->get('tags') != null) ? $this->input->get('tags') : '', $this->input->get('tags') != null ? 'tags' : 'keyword');

		if($this->input->get('keyword') != null){
			if($this->session->ValidSession())
				$this->Archintel_model->AddRecentSearch($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->ID, $this->input->get('keyword'), 'keyword');
			$data['medias'] = $this->Archintel_model->SearchMedia($this->input->get('keyword'), 'keyword');
		}else if($this->input->get('tags') != null){
			if($this->session->ValidSession())
				$this->Archintel_model->AddRecentSearch($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->ID, $this->input->get('tags'), 'tags');
			$data['medias'] = $this->Archintel_model->SearchMedia($this->input->get('tags'), 'tags');
		}else if($this->input->get('category') != null){
			if($this->session->ValidSession())
				$this->Archintel_model->AddRecentSearch($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->ID, $this->input->get('category'), 'category');
			$data['medias'] = $this->Archintel_model->SearchMedia($this->input->get('category'), 'category');
		}

		$this->load->view('tpl/full-page/main', $data);
	}
}
