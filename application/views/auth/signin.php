<section id="signin" class="row">
   <div class="col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
      <h3 class="row heading text-center">Sign In</h3>
   </div>
   <div class="col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 bordered">
      <div class="row" style="margin-top: 20px;" >
         <?php echo form_open(current_full_url(),array('class' => 'form')); ?>
         <?php
            echo validation_errors();
            if(!empty($this->session->SuccessMessage()))
               foreach($this->session->SuccessMessage() as $msg){
                  echo '<div class="alert alert-success alert-dismissable col-md-10 col-md-offset-1">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4>Success!</h4>'.$msg.'</div>';
               }
         ?>

         <?php if($this->input->get('next') != null): ?>
            <input type="hidden" name="next" value="<?php echo htmlentities($this->input->get('next')); ?>">
         <?php endif; ?>

            <div class="form-group col-md-12">
               <label for="username">Username</label>
               <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" autofocus>
            </div>
            <div class="form-group col-md-12">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" >
            </div>
            <div class="form-group col-md-12">
               <button type="submit" class="btn-block btn btn-success">Go!</button>
            </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</section>
