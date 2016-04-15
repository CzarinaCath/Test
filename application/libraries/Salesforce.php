<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("SOAP_CLIENT_BASEDIR", APPPATH."third_party/salesforce");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');

class Salesforce{

	private $USERNAME = "apiuser@archintel.com";
	private $PASSWORD = "archintel2015";
	private $conn = NULL;

	function __construct(){
		$this->conn = new SforceEnterpriseClient();
		$this->conn->createConnection(SOAP_CLIENT_BASEDIR.'/archintel.xml');
		$this->conn->login($this->USERNAME, $this->PASSWORD);
		$this->CI =& get_instance();
	}

	function CreateContact($contact){
		try{
			$response = $this->conn->create(array($contact), 'Contact');

			return $response[0]->id;
		}catch(Exception $e){
			echo $e->faultstring;
		}
	}

	function CreateLead($data){
		try{
			$response = $this->conn->create(array($data), 'Lead');

			return $response[0]->success;
		}catch(Exception $e){
			echo $e->faultstring;
		}
	}

	function UpdateContact($contact){
		$this->conn->update($contact, 'Contact');
	}
}
