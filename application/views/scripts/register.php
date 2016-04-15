<script type="text/javascript">
   var accounts = [<?php foreach($accounts->result() as $account): ?>
       <?php echo '{ value: "'.$account->Name.'", data: "'.$account->ArchIntelId__c.'"},'; ?>
      <?php endforeach; ?>];

   $('#autocomplete').autocomplete({
       lookup: accounts,
       onSelect: function(){
          checkAccount(this.value);
       }
   }).blur(function(){
      checkAccount(this.value);
   })

   function checkAccount(value){
      if(indexOf2(accounts, 'value', value) == -1){
         $(".hide-group").each(function(){
            this.style.display = 'inherit';
         })
      }else{
         $(".hide-group").each(function(){
            this.style.display = 'none';
         })
      }
   }

   function indexOf2(array, field, value){
      for(var i = 0; i < array.length; i++) {
         if(array[i][field] === value) {
            return i;
         }
      }

      return -1;
   }

   jQuery(document).ready(function () {
    "use strict";

    <?php
      if($this->input->post('company') != null)
         echo 'checkAccount("'.$this->input->post('company').'")';
    ?>

    $("#revenue").maskMoney();

    var options = {};
    options.ui = {
        container: "#pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: ".pwstrength_viewport_progress"
        }
    };
    $(':password').pwstrength(options);

    $("#register-form").on("submit", function(evt){
      evt.preventDefault();
      $("#revenue").val($("#revenue").val().replace(/,/gi,""));
      this.submit();
   })
});
</script>
