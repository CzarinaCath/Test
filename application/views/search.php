<div class="row">
   <section class="col-md-12" id="research">
      <div class="col-md-12">
         <h4 class="heading">Search results</h4>
         <?php if($this->session->ValidSession()): ?>
            <ul class="bordered bordered-no-top" id="research-list">
               <?php if($medias->num_rows() > 0): foreach($medias->result() as $media): ?>
               <li>
                  <img src="<?php echo $media->Media_Image__c; ?>" class="hidden-sm hidden-xs img-responsive">
                  <div class="research-group">
                     <h4><a href="<?php echo $media->Media_Link__c; ?>"><?php echo $media->Media_Title__c; ?></a></h4>
                     <p><?php echo $this->archintel->CutParagraph($media->Media_Summary__c, 305, '... <a href="'.$media->Media_Link__c.'">more details</a>'); ?></p>
                     <ul class="research-tags">
                        <?php foreach(explode(",", $media->Contenttags__c) as $tag):?>
                        <li><a href="<?php echo base_url('search/?tags=').$tag; ?>"><span class="label label-info"><?php echo $tag; ?></span></a></li>
                        <?php endforeach; ?>
                     </ul>
                     <div class="clearfix"></div>
                  </div>
               </li>
               <?php
                  endforeach;
                  else:
               ?>
               <li><center>No results found</center></li>
               <?php endif;?>
            </ul>
         <?php else: ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Error!</h4>You need to be <a href="<?php echo base_url('auth/signin?next='.current_full_url()); ?>">signed in</a> to see the search results.</div>
         <?php endif; ?>
      </div>
   </section>
</div>
