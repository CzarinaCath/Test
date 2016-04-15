<?php echo form_open(base_url('search'), array('method' => 'get')); ?>
   <div class="input-group">
      <input type="text" class="form-control" name="keyword" id="searchbox" placeholder="Search for...">
      <span class="input-group-btn">
         <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
   </div><!-- /input-group -->
<?php echo form_close(); ?>
