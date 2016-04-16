<?php
class section_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
   
 public function addsection()
    {
       
            $data_ary = array(
            
            'student_id' => $this->input->post('student_id'),
            'section' => $this->input->post('section'),
            
            

            );           
        return $this->db->insert('section', $data_ary); 
    }
}