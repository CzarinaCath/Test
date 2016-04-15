<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once SYSDIR . '/libraries/Session/Session_driver.php';
require_once SYSDIR . '/libraries/Session/Session.php';

/*
    Change the following if you want to use a different driver.
*/
//require_once SYSDIR . '/libraries/Session/drivers/Session_files_driver.php';

class MY_Session extends CI_Session
{

   function __construct()
   {
      parent::__construct();
   }

   protected function _sess_update($force = false)
   {
      // Do NOT update an existing session on AJAX calls.
      if ($force || !$this->CI->input->is_ajax_request())
      return parent::_sess_update($force);
   }

   function Destroy(){
      $this->unset_userdata('account');

      return true;
   }

   function ErrorMessage($error = null){
      if($error == null){
         $errors = $this->flashdata('errors');

         return $errors;
      }else{
         $errors = $this->flashdata('errors');

         if(empty($errors))
            $errors = array();

         $data = array();
         foreach($errors as $error){
            array_push($data, $error);
         }

         array_push($data, $error);

         $this->set_flashdata('errors', $data);
      }
   }

   function InfoMessage($info = null){
      if($info == null){
         $infos = $this->flashdata('infos');

         return $infos;
      }else{
         $infos = $this->flashdata('infos');

         if(empty($infos))
            $infos = array();

         $data = array();
         foreach($infos as $info){
            array_push($data, $info);
         }

         array_push($data, $info);

         $this->set_flashdata('infos', $data);
      }
   }

   function SetSession($data){
      $this->set_userdata('account', $data);

      return;
   }

   function SuccessMessage($msg = null){
      if($msg == null){
         $msgs = $this->flashdata('success-msgs');

         return $msgs;
      }else{
         $msgs = $this->flashdata('success-msgs');

         if(empty($msgs))
            $msgs = array();

         $data = array();
         foreach($msgs as $msg){
            array_push($data, $msg);
         }

         array_push($data, $msg);

         $this->set_flashdata('success-msgs', $data);
      }
   }

   function ValidSession(){
      $account = $this->userdata('account');

      if(!empty($account)){
         $account['last_activity'] = date('Y-m-d H:i:s', time());
         $this->SetSession($account);
         return true;
      }else{
         return false;
      }
   }

}

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */
