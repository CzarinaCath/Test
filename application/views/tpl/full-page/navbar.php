
   <nav class="navbar navbar-default">
      <div class="container-fluid">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url('assets/img/logo.png'); ?>" /></a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
               <li<?php echo empty($this->uri->uri_string()) ? ' class="active"' : ''; ?>><a href="<?php echo base_url(); ?>">Home</a></li>
               <li class="dropdown<?php echo $this->uri->segment('1') == 'about' ? ' class="active"' : ''; ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <li><a href="<?php echo base_url('about'); ?>">About ArchIntel</a></li>
                     <li><a href="<?php echo base_url('about/executive-mosaic'); ?>">About Executive Mosaic</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="#">Pretend I'm not here</a></li>
                  </ul>
               </li>
               <?php if($this->session->ValidSession()): ?>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('account')['username']; ?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <?php if($this->Archintel_model->AllDetails('contacts','Username__c',$this->session->userdata('account')['username'])->Access_Level__c == 'Administrator'): ?>
                     <li><a href="<?php echo base_url('users'); ?>">User Manager</a></li>
                  <?php endif; ?>
                     <li><a href="<?php echo base_url('user/settings'); ?>">Settings</a></li>
                      <li><a href="<?php echo base_url('edit/edituser'); ?>">Manage Account</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="<?php echo base_url('auth/signout'); ?>">Sign Out</a></li>
                  </ul>
               </li>
               <?php endif; ?>
               <?php if(!$this->session->ValidSession()): ?>
               <li<?php echo $this->uri->segment(2) == 'register' ? ' class="active"' : '';?>><a href="<?php echo base_url('auth/register'); ?>">Register</a></li>
               <li<?php echo $this->uri->segment(2) == 'signin' ? ' class="active"' : ''; ?>><a href="<?php echo base_url('auth/signin'); ?>">Sign In</a></li>
               <?php endif; ?>
               <li>
                  <a href="#" id="search-btn"><i class="fa fa-search"></i></a>
               </li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
   </nav>
