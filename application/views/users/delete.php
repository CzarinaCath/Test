<section class="row">
   <div class="col-md-4 col-md-offset-4">
      <h4 class="heading text-center">Delete User</h4>
      <div class="col-md-12 bordered bordered-no-top bottom-offset-20">
         <?php echo form_open('',array('class' => 'form top-offset-20')); ?>
            <div class="form-group col-md-12">
               <b><?php echo $details->FirstName.' '.$details->LastName; ?></b>
               <p>Are you sure you want to delete this record?</p>
               <input type="hidden" name="delete" value="1">
            </div>
            <div class="form-group col-md-12">
               <div class="col-md-6">
                  <button type="submit" class="btn btn-block btn-danger">Yes</button>
               </div>
               <div class="col-md-6">
                  <a href="<?php echo base_url('users'); ?>" class="btn btn-block btn-default">No</a>
               </div>
            </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</section>
