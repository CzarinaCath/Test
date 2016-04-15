<footer>
   &copy; Copyright <?php echo date('Y', time()); ?> | Developed by <a href="http://www.hexiros.com/" target="_blank">Hexiros</a>
</footer>
</div>
<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.min.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/bootstrap.min.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/bootbox.min.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.blockUI.js'); ?>'></script>
<?php
   foreach($this->_ci_cached_vars as $key => $value){
      $data[$key] = $value;
   }

   if(isset($js))
      foreach($js as $j){
         echo '<script type="text/javascript" src="'.$j.'"></script>
';
      }

   if(isset($scripts))
      foreach($scripts as $script){
         $this->load->view($script, $data);
      }
?>
<script type="text/javascript">
   $("#search-btn").on("click", function(x){
      x.preventDefault();
      $.ajax({
         url: '<?php echo base_url('ajax/search-form'); ?>',
         type: 'GET',
         success: function(response){
            $.blockUI({
              message: response,
              fadeIn: 700,
              fadeOut: 700,
              css: {
                  border: 'none',
                  backgroundColor: '#000',
                  height: '0px',
                  color: '#fff'
              }
          });
          $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
         }
      })
   })
</script>
</body>
</html>
