<section class="row">
   <div class="col-md-10 col-md-offset-1">
      <h3 class="row heading text-center">Register</h3>
   </div>
   <div class="col-md-10 col-md-offset-1 bordered bottom-offset-20">
      <div class="row">
         <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;" >
            <?php
               if(!empty($this->session->ErrorMessage()))
                  foreach($this->session->ErrorMessage() as $error){
                     echo '<div class="alert alert-danger alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4>Error!</h4>'.$error.'</div>';
                  }

               if(!empty($this->session->InfoMessage()))
                  foreach($this->session->InfoMessage() as $info){
                     echo '<div class="alert alert-info alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4>Info!</h4>'.$info.'</div>';
                  }

               if(!empty($this->session->SuccessMessage()))
                  foreach($this->session->SuccessMessage() as $msg){
                     echo '<div class="alert alert-success alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4>Success!</h4>'.$msg.'</div>';
                  }
            ?>
            <?php echo form_open('',array('class' => 'form', 'id' => 'register-form')); ?>
               <div class="col-md-12 form-group">
                  <div class="col-md-6">
                     <label for="title">Title</label>
                     <input type="text" class="form-control" name="title" autofocus value="<?php echo set_value('title'); ?>">
                     <?php echo form_error('title','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                  <div class="col-md-6">
                     <label for="firstname">Firstname</label>
                     <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname'); ?>">
                     <?php echo form_error('firstname','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="lastname">Lastname</label>
                     <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname'); ?>">
                     <?php echo form_error('lastname','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                  <div class="col-md-6">
                     <label for="email">Email</label>
                     <input type="text" class="form-control" name="email" placeholder="email@company.com" value="<?php echo set_value('email'); ?>">
                     <?php echo form_error('email','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="phone">Phone</label>
                     <input type="text" class="form-control" name="phone" placeholder="(111)111-1111" value="<?php echo set_value('phone'); ?>">
                     <?php echo form_error('phone','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                  <hr />
               </div>

               <div class="col-md-12 form-group">
                  <div class="col-md-6">
                     <label for="username">Username</label>
                     <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>">
                     <?php echo form_error('username','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group" id="pwd-contsainer">
                  <div class="col-md-6">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password">
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
                  <div class="col-md-6">
                     <label for="company">Company</label>
                     <input type="text" class="form-control" id="autocomplete" name="company" value="<?php echo set_value('company'); ?>">
                     <?php echo form_error('company','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="industry">Industry</label>
                     <input type="text" class="form-control" name="industry" value="<?php echo set_value('industry'); ?>">
                     <?php echo form_error('industry','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="no_of_employees">Number of Employees</label>
                     <input type="text" class="form-control" name="no_of_employees" value="<?php echo set_value('no_of_employees'); ?>">
                     <?php echo form_error('no_of_employees','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="revenue">Annual Revenue</label>
                     <input type="text" class="form-control text-right" name="revenue" id="revenue" value="<?php echo number_format(set_value('revenue', '0.00'), 2, '.',','); ?>">
                     <?php echo form_error('revenue','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="company_mobile">Mobile</label>
                     <input type="text" class="form-control" name="company_mobile" value="<?php echo set_value('company_mobile'); ?>">
                     <?php echo form_error('company_mobile','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="company_phone">Phone</label>
                     <input type="text" class="form-control" name="company_phone" value="<?php echo set_value('company_phone'); ?>">
                     <?php echo form_error('company_phone','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="company_fax">Fax</label>
                     <input type="text" class="form-control" name="company_fax" value="<?php echo set_value('company_fax'); ?>">
                     <?php echo form_error('company_fax','<p class="text-danger">','</p>'); ?>
                  </div>
                  <!--div class="col-md-6">
                     <label for="company_email">Email</label>
                     <input type="text" class="form-control" name="company_email" value="<?php //echo set_value('company_email'); ?>">
                     <?php //echo form_error('company_email','<p class="text-danger">','</p>'); ?>
                  </div-->
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="street">Street</label>
                     <input type="text" class="form-control" name="street" value="<?php echo set_value('street'); ?>">
                     <?php echo form_error('street','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="city">City</label>
                     <input type="text" class="form-control" name="city" value="<?php echo set_value('city'); ?>">
                     <?php echo form_error('city','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="country">Country</label>
                     <input type="text" class="form-control" name="country" value="<?php echo set_value('country'); ?>">
                     <?php echo form_error('country','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="state">State</label>
                     <input type="text" class="form-control" name="state" value="<?php echo set_value('state'); ?>">
                     <?php echo form_error('state','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
                  <div class="col-md-6">
                     <label for="postal">Postal Code</label>
                     <input type="text" class="form-control" name="postal" value="<?php echo set_value('postal'); ?>">
                     <?php echo form_error('postal','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                  <div class="col-md-12">
                     <button class="btn btn-success btn-block" type="submit">Register</button>
                  </div>
               </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</section>
