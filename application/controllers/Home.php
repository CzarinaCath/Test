<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['content'] = $this->session->ValidSession() ? 'home-logged-in' : 'home';

		if($this->session->ValidSession()):
			$data['companies'] = $this->Archintel_model->GetCompanies()->result();
			$data['quotes'] = $this->archintel->AllCompanyQuoteData();
			$data['index'] = $this->archintel->CalculateWalbroIndex($data['quotes']);
			$data['historicaldata'] = $this->archintel->HistoricalGraphData(date('Y-m-d', strtotime(date('Y-m-d', time()) . ' -1 month')), date('Y-m-d', time()));
			$data['medias'] = $this->archintel->Medias($this->input->get('page') != null ? $this->input->get('page') : 1, $this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->AccountID);
			$data['mediapages'] = $this->Archintel_model->MediaPages($this->Archintel_model->AllDetails('contacts', 'Username__c', $this->session->userdata('account')['username'])->AccountID);
			$data['historicalgraphdata'] = $this->archintel->AllCompanyHistoricalGraphData();
			$data['headlines'] = $this->Archintel_model->TopHeadlines();
			$data['js'] = array(
				base_url('assets/js/third-party/amcharts/amcharts.js'),
				base_url('assets/js/third-party/amcharts/serial.js'),
				base_url('assets/js/third-party/amcharts/themes/patterns.js'),
				base_url('assets/js/third-party/amcharts/plugins/export/export.js'),
				base_url('assets/js/html2canvas.js')
			);
			/*
			base_url('assets/js/third-party/amcharts/plugins/export/libs/pdfmake/pdfmake.min.js'),
			base_url('assets/js/third-party/amcharts/plugins/export/libs/jszip/jszip.min.js'),
			base_url('assets/js/third-party/amcharts/plugins/export/libs/fabric.js/fabric.min.js'),
			base_url('assets/js/third-party/amcharts/plugins/export/libs/FileSaver.js/FileSaver.min.js'),
			base_url('assets/js/third-party/amcharts/plugins/export/libs/xlsx/xlsx.min.js'),
			base_url('assets/js/third-party/amcharts/plugins/export/libs/blob.js/blob.js')
			*/
			$data['css'] = array(
				base_url('assets/js/third-party/amcharts/plugins/export/export.css')
			);
			$data['scripts'] = array('scripts/home');
		endif;
		$this->load->view('tpl/full-page/main', $data);
	}
}
