<?php
class teacher extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
   

    public function addteacher()
    {

    	 $data_ary = array(
    	 	'T_id' => $this->input->post('T_id'),
    	 	'T_fname' => $this->input->post('T_fname'),
    	 	'T_lname' => $this->input->post('T_lname'),
    	 	'T_subject' => $this->input->post('T_subject'),

    	 	return $this->db->insert('teacher', $data_ary);   
    }
      }

}
