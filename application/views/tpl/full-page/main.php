<?php
   $data = null;

   /*if(isset($js))
      $data['js'] = $js;
   if(isset($css))
      $data['css'] = $css;
   if(isset($scripts))
      $data['scripts'] = $scripts;*/

   foreach($this->_ci_cached_vars as $key => $value){
      $data[$key] = $value;
   }

   $this->load->view('tpl/full-page/header', $data);
   $this->load->view('tpl/full-page/navbar', $data);
   $this->load->view($content, $data);
   $this->load->view('tpl/full-page/footer', $data);
?>
