<?php
class subject extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
   

    public function addsubject()
    {

    	 $data_ary = array(
    	 	'Student_id' => $this->input->post('student_id'),
    	 	'Sub_code' => $this->input->post('Sub_code'),
    	 	'Sub_title' => $this->input->post('Sub_title'),

    	 	return $this->db->insert('subject', $data_ary);   
    }
      }

}
