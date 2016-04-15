<script type="text/javascript">
   var searches = [<?php foreach($searches->result() as $search): ?>
       <?php echo '{ value: "'.$search->keyword.'", data: "'.$search->keyword.'"},'; ?>
      <?php endforeach; ?>];

   $('#autocomplete').autocomplete({
       lookup: searches,
   })
</script>