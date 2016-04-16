<?php
class level_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
   
 public function addlevel()
    {
       
            $data_ary = array(
           
            'student_id' => $this->input->post('student_id'),
            'level' => $this->input->post('level'),
            
            

            );           
        return $this->db->insert('level', $data_ary); 
    }
}