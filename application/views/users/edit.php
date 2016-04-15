<section class="row">
   <div class="col-md-4 col-md-offset-4">
      <h4 class="heading text-center">Edit User</h4>
      <div class="col-md-12 bordered bordered-no-top bottom-offset-20">
         <?php echo form_open('',array('class' => 'form top-offset-20')); ?>
            <div class="form-group col-md-12">
               <label for="firstname">Firstname</label>
               <input type="hidden" name="id" value="<?php echo $details->ID; ?>">
               <input type="hidden" name="salesforceID" value="<?php echo $details->SalesforceID; ?>">
               <input type="text" class="form-control" name="firstname" value="<?php echo $this->input->post('firstname') == null ? $details->FirstName : $this->input->post('firstname'); ?>" autofocus>
               <?php echo form_error('firstname','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group col-md-12">
               <label for="lastname">Lastname</label>
               <input type="text" class="form-control" name="lastname" value="<?php echo $this->input->post('lastname') == null ? $details->LastName : $this->input->post('lastname'); ?>">
               <?php echo form_error('lastname','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group col-md-12">
               <label for="username">Username</label>
               <input type="text" class="form-control" name="username" value="<?php echo $this->input->post('username') == null ? $details->Username__c : $this->input->post('username'); ?>">
               <?php echo form_error('username','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group col-md-12">
               <input type="checkbox" name="samepassword" id="samepassword" value="0" checked> Use the same password
            </div>
            <div class="form-group col-md-12">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" disabled>
               <?php echo form_error('password','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group col-md-12">
               <label for="vpassword">Verify Password</label>
               <input type="password" class="form-control" name="vpassword" disabled>
               <?php echo form_error('vpassword','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="form-group col-md-12">
               <label for="access_level">Access Level</label>
               <select class="form-control" name="access_level">
                  <option value="Administrator"<?php echo set_select('access_level','Administrator'); ?>>Administrator</option>
                  <option value="Manager"<?php echo set_select('access_level','Manager'); ?>>Manager</option>
                  <option value="Guest"<?php echo set_select('access_level','Guest'); ?>>Guest</option>
               </select>
               <?php echo form_error('access_level','<p class="text-danger">','</p>'); ?>
            </div>
            <div class="col-md-12 bottom-offset-20">
               <button class="btn btn-success btn-block" type="submit">Update</button>
               <a href="<?php echo base_url(); ?>" class="btn btn-default btn-block"><i class="fa fa-chevron-left"></i> back</a>
            </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</section>
