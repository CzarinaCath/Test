<section class="row">
   <div class="col-md-10 col-md-offset-1 bordered bottom-offset-20">
      <div class="smpl-step" style="border-bottom: 0; min-width: 500px;">
         <div class="col-xs-4 smpl-step-step active">
            <div class="text-center smpl-step-num">Step 1</div>
            <div class="progress">
               <div class="progress-bar"></div>
            </div>
            <a class="smpl-step-icon"><i class="fa fa-user active" style="font-size: 60px; padding-left: 12px; padding-top: 3px;"></i></a>
            <div class="smpl-step-info text-center">Account Information</div>
         </div>
         <div class="col-xs-4 smpl-step-step disabled">
            <div class="text-center smpl-step-num">Step 2</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
            <a class="smpl-step-icon"><i class="fa fa-dollar" style="font-size: 60px; padding-left: 17px; padding-top: 7px; "></i></a>
            <div class="smpl-step-info text-center">Subscription Option</div>
         </div>
         <div class="col-xs-4 smpl-step-step disabled">
            <div class="text-center smpl-step-num">Step 3</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
            <a class="smpl-step-icon"><i class="fa fa-check" style="font-size: 60px; padding-left: 6px; padding-top: 6px;"></i></a>
            <div class="smpl-step-info text-center">Registration Complete</div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;" >
            <?php echo form_open(''); ?>
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
                     <div class="pwstrength_viewport_progress top-offset-10"></div>
                  </div>
                  <div class="col-md-6">
                     <label for="verify_password">Verify Password</label>
                     <input type="password" class="form-control" name="verify_password">
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
                     <label for="company_mobile">Mobile</label>
                     <input type="text" class="form-control" name="company_mobile" value="<?php echo set_value('company_mobile'); ?>">
                     <?php echo form_error('company_mobile','<p class="text-danger">','</p>'); ?>
                  </div>
                  <div class="col-md-6">
                     <label for="company_phone">Phone</label>
                     <input type="text" class="form-control" name="company_phone" value="<?php echo set_value('company_phone'); ?>">
                     <?php echo form_error('company_phone','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group hide-group">
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
                  <div class="col-md-6">
                     <label for="company_address">Address</label>
                     <input type="text" class="form-control" name="company_address" value="<?php echo set_value('company_address'); ?>">
                     <?php echo form_error('company_address','<p class="text-danger">','</p>'); ?>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                  <div class="col-md-12">
                     <button class="btn btn-success btn-block" type="submit">Next</button>
                  </div>
               </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</section>
