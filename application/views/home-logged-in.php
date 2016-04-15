<div class="row">
   <div class="col-md-12">
      <section class="col-md-8">
         <?php if($this->session->ValidSession() && 1 == 2): ?>
         <div class="row" id="export">
            <div class="col-md-12">
               <h3 class="text-center heading">Walbro Index</h3>
               <ul class="bordered-list bordered-no-top no-indent walbro-value">
                  <li class="col-md-4 text-center">
                     <span>Index</span>
                     <span><?php echo number_format($index['price'], 2); ?></span>
                  </li>
                  <li class="col-md-4 text-center">
                     <span>$ Change</span>
                     <span><?php echo $index['change'] > 0 ? '+ '.number_format($index['change'], 2) : number_format($index['change'], 2); ?></span>
                  </li>
                  <li class="col-md-4 text-center">
                     <span>% Change</span>
                     <span><?php echo $index['percentage'] > 0 ? '+ '.number_format($index['percentage'], 2).' %' : number_format($index['percentage'], 2).' %'; ?></span>
                  </li>
                  <li class="clearfix"></li>
               </ul>
            </div>
            <div class="col-md-12" id="company-quotes">
               <h4 class="heading text-center">Company Quotes</h4>
               <table class="table table-bordered table-hover table-responsive">
                  <thead>
                     <tr>
                        <th class="text-center">Symbol</th>
                        <th class="text-center">Company</th>
                        <th class="text-center">Current Price</th>
                        <th class="text-center">$ Change</th>
                        <th class="text-center">% Change</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach($quotes as $quote): ?>
                     <tr>
                        <td class="text-center"><?php echo $quote['symbol']; ?></td>
                        <td><?php echo $quote['name']; ?></td>
                        <td class="text-center"><b><?php echo number_format($quote['price'], 2); ?></b></td>
                        <td class="text-center"><b><?php echo $this->archintel->SetWalbroTextColor(number_format(($quote['price'] - $quote['prev_close']), 2)); ?></b></td>
                        <td class="text-center"><b><?php echo $this->archintel->SetWalbroTextColor(number_format((($quote['price'] - $quote['prev_close'])/$quote['prev_close']) * 100, 2).'%'); ?></b></td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
         <?php endif; ?>
         <div class="col-md-12">
            <div class="" id="walbro-chart" style="width:100%; min-height: 400px"></div>
         </div>
         <section class="col-md-12" id="research">
            <div class="col-md-12">
               <h4 class="heading text-center">Our Latest Research</h4>
               <ul class="bordered bordered-no-top" id="research-list">
                  <?php foreach($medias->result() as $media): ?>
                  <li>
                     <img src="<?php echo $media->Media_Image__c; ?>" class="hidden-sm hidden-xs img-responsive">
                     <div class="research-group">
                        <h4><a href="<?php echo $media->Media_Link__c; ?>" target="_blank"><?php echo $media->Media_Title__c; ?></a></h4>
                        <p><?php echo $this->archintel->CutParagraph($media->Media_Summary__c, 305, '... <a href="'.$media->Media_Link__c.'">more details</a>'); ?></p>
                        <ul class="research-tags">
                           <?php foreach(explode(",", $media->Contenttags__c) as $tag):?>
                           <li><a href="<?php echo base_url('search/?tags=').$tag; ?>"><span class="label label-info"><?php echo $tag; ?></span></a></li>
                           <?php endforeach; ?>
                        </ul>
                        <div class="clearfix"></div>
                     </div>
                  </li>
                  <?php endforeach;?>
               </ul>
               <nav class="pull-right">
                 <ul class="pagination">
                   <li<?php echo $this->input->get('page') == null | $this->input->get('page') == 1 ? ' class="disabled"' : ''; ?>>
                     <a href="<?php echo base_url('?page=1'); ?>" aria-label="First">
                       <span aria-hidden="true">&laquo;</span>
                     </a>
                   </li>
                   <?php for($x = 1; $x <= ceil($mediapages / 3); $x++): ?>
                   <li<?php echo $this->input->get('page') == $x ? ' class="active"' : ''; ?>><a href="<?php echo base_url('?page='.$x); ?>"><?php echo $x; ?></a></li>
                   <?php endfor;?>
                   <li<?php echo $this->input->get('page') == null | $this->input->get('page') == ceil($mediapages / 3) ? ' class="disabled"' : ''; ?>>
                     <a href="<?php echo base_url('?page='.ceil($mediapages / 3)); ?>" aria-label="Last">
                       <span aria-hidden="true">&raquo;</span>
                     </a>
                   </li>
                 </ul>
               </nav>
            </div>
         </section>
      </section>
      <section class="col-md-4">
         <div class="col-md-12" id="nav-links">
            <h3 class="text-center heading"><?php echo date('F d, Y', time()); ?></h3>
            <ul class="bordered-list">
               <p>Click below links to navigate each news category</p>
               <li><a href="<?php echo base_url('search?category=Customers+in+the+News') ?>">Customers in the News</a></li>
               <li><a href="<?php echo base_url('search?category=Competitors+in+the+News') ?>">Competitors in the News</a></li>
               <li><a href="<?php echo base_url('search?category=Walbro+Products+in+the+News') ?>">Walbro Products in the News</a></li>
               <li><a href="<?php echo base_url('search?category=Industry+news') ?>">Industry News</a></li>
               <li><a href="<?php echo base_url('search?category=Executives+in+the+News') ?>">Executives in the News</a></li>
            </ul>
         </div>
         <div class="col-md-12">
            <h3 class="text-center heading">Top Headlines</h3>
            <ul id="top-headlines" class="bordered bordered-no-top">
               <?php foreach($headlines->result() as $headline): ?>
               <li><a href="<?php echo $headline->Media_Link__c; //base_url('news/article/title-of-the-news-goes-here-52748.html')?>" target="_blank"><?php echo $headline->Media_Title__c; ?></a></li>
               <?php endforeach; ?>
               <?php if($headlines->num_rows() == 0): ?>
                  <li><p class="text-center">-none-</p></li>
               <?php endif; ?>
            </ul>
         </div>
         <?php if($this->session->ValidSession()): ?>
         <div class="col-md-12 ">
            <button onclick="convert('#export')" class="btn btn-block btn-default">Download Image</button>
         </div>
         <?php endif; ?>
      </section>
   </div>
</div>
