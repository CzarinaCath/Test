<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_lib {
   public function __call($method, $arguments){
      if(!method_exists($this, $method)){
         throw new Exception('Undefined method Auth::'. $method .'() called');
      }

      return call_user_func_array(array($this, $method), $arguments);
   }

   public function __construct(){
      $this->load->model('Auth_model');

      if(!$this->Auth_model->SetupDone() && uri_string() != 'auth/setup'){
         redirect(base_url('auth/setup'));
      }
   }

   public function __get($var){
      return get_instance()->$var;
   }


}
