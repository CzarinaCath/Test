 <?php
class StudentModel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }

  public function addstud()
  {
     $data_ary = array(
            'student_Id' => $this->input->post('student_id'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'suffix' => $this->input->post('suffix'),
            'age' => $this->input->post('age'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'mom_name' => $this->input->post('mom_name'),
            'occupation' => $this->input->post('occupation'),
            'dad_name' => $this->input->post('dad_name'),
            'dad_occupation' => $this->input->post('dad_occupation'),


            );           
        return $this->db->insert('student_info', $data_ary);   
  }
}