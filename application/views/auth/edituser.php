<section class="row">
   <div class="col-md-8 col-md-offset-2">
      <h3 class="row heading text-center">Update Information</h3>
   </div>
   <div class="col-md-8 col-md-offset-2 bordered bottom-offset-20">
      <div class="row">
         <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;" >
         <form method="post" action="<?php echo base_url() . "index.php/Edit/update" ?>" >
         <?php echo form_open(); ?>
               <?php foreach($info->result() as $inf): ?> 
                   <div class="col-md-12 form-group">
                     <div class="col-md-6">
                        <label for="id">ID</label>
                        <input value="<?php echo $inf->ID; ?>" type="text" class="form-control" id="id" name="id">
                        
                     </div>
                     </div>
                   <div class="col-md-12 form-group">
                     <div class="col-md-6">
                        <label for="firstname">First Name</label>
                        <input value="<?php echo $inf->FirstName; ?>" type="text" class="form-control" id="firstname" name="firstname">
                        
                     </div>
                     <div class="col-md-6">
                        <label for="lastname">Lastname</label>
                        <input value="<?php echo $inf->LastName; ?>" type="text" class="form-control" name="lastname" >
                       
                     </div>
                  </div>
                  <div class="col-md-12 form-group">
                     <hr />
                  </div>

                  <div class="col-md-12 form-group">
                     <div class="col-md-7">
                        <label for="username">Username</label>
                        <input value="<?php echo $inf->Username__c; ?>" type="text" class="form-control" name="username" >
                        <?php echo form_error('username','<p class="text-danger">','</p>'); ?>

                     </div>
                  </div>

                  <div class="col-md-12 form-group" id="pwd-contsainer">
                  <div class="col-md-6">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" id="password" placeholder="Change Password">
                     <?php echo form_error('password','<p class="text-danger">','</p>'); ?>
                     <div class="pwstrength_viewport_progress top-offset-10"></div>
                  </div>
                  <div class="col-md-6">
                     <label for="verify_password">Verify Password</label>
                     <input type="password" class="form-control" name="verify_password">
                     <?php echo form_error('verify_password','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

                  <div class="col-md-12 form-group">
                     <hr />
                  </div>
                  <div class="col-md-12 form-group">
                     <div class="col-md-12">
                   <input type="submit" id="submit" name="dsubmit" value="Update" class="btn btn-success btn-block">
                     </div>
                  </div>
                  <div class="col-md-12 form-group">
                     <div class="col-md-12">
                  <center><a href="<?php echo base_url(); ?>" class="btn btn-default btn-block glyphicon glyphicon-hand-left"> BACK</a></center>
                     </div>
                  </div>
                  <?php echo form_close(); ?>
                  </form> 
            </div>
         <?php endforeach; ?> 
         </div>
         </div>

      </div>
</section>
