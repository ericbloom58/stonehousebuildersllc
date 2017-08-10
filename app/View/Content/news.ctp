    <div class="content_section page_title default">
        <div class="content clearfix" style="margin-top:100px;">
            <h1>News</h1>
        </div>
    </div>
    <!-- End Page Title -->
    
    <div class="content_section">
        <div class="content clearfix">
           <div class="hm_columns content_block col-md-9 f_right row_spacer">
               <div class="content hm_blog_list clearfix">
                   <?php foreach($news as $n): ?>
                   <div id="<?= $n['Blog']['id']; ?>" class="blog_grid_block clearfix">
                       
                       <div class="blog_grid_con">
                           <h6 class="title"><?= $n['Blog']['name']; ?></h6>
                           
                           <span class="meta"> 
                               <span class="meta_part"><span><?= date('d M y', strtotime($n['Blog']['created'])); ?></span></span>
                           </span>
                           
                           <div class="entry-content hm_exp_con"> <?= $n['Blog']['blog']; ?></div>
                       </div>
                   </div> <!--End Post Block -->
                  <?php endforeach; ?> 
               </div>
           </div>
           <aside id="sidebar" class="hm_columns col-md-3 left_sidebar row_spacer">
               <div class="hm_column_con">
                   <div class="widget_block widget_categories">
                       <h6 class="widget_title">Posts</h6>
                       <ul class="cat_list_widget">
                            <?php foreach($news as $new): ?>
                            <li><a href="/content/news/<?= $new['Blog']['id']; ?>"><?= $new['Blog']['name']; ?></a></li>
                            <?php endforeach; ?>
<!--                       <li><a href="#">Post 1</a></li>
                           <li><a href="#">Post 2</a></li>
                           <li><a href="#">Post 3</a></li>
                           <li><a href="#">Post 4</a></li>
                           <li><a href="#">Post 5</a></li>
-->
                       </ul>
                   </div>
               </div>
            </aside>
        </div>
    </div>
    
    
    
<!--    <div class="content_section">
        <div class="content clearfix">
           <div class="hm_columns content_block col-md-9 f_right row_spacer">
               <div class="content hm_blog_list clearfix">
                   
                    Post Block 
                   <div class="blog_grid_block clearfix">
                       <div class="feature_inner">
                           <div class="feature_inner_corners">
                               <div class="porto_galla owl_abs_arr"> 
                                 <a href="http://placehold.it/1140x760" class="img_popup"> 
                                     <img src="http://placehold.it/600x375" alt="Easy to Customize" /> 
                                     <span class="hm_plus_i"><i class="ico-plus10 hm_iii"></i></span>
                                 </a> 
                                 <a href="http://placehold.it/1140x760" class="img_popup"> 
                                     <img src="http://placehold.it/600x375" alt="Easy to Customize" /> 
                                     <span class="hm_plus_i"><i class="ico-plus10 hm_iii"></i></span>
                                 </a>
                             </div>
                           </div>
                       </div>
                       <div class="blog_grid_con">
                           <h6 class="title"><a href="#">Easy to Customize</a></h6>
                           
                           <span class="meta"> 
                               <span class="meta_part"><span>Aug 1, 2017</span></span>
                               <span class="meta_part"><span>In <span><a href="#">Culture</a></span></span></span>
                               <span class="meta_part"><span>By <a href="#">John Doe</a></span></span>
                           </span>
                           
                           <div class="entry-content hm_exp_con"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam ... </div>
                       </div>
                   </div> End Post Block 
                   
               </div>
           </div>
           <aside id="sidebar" class="hm_columns col-md-3 left_sidebar row_spacer">
               <div class="hm_column_con">
                   <div class="widget_block widget_categories">
                       <h6 class="widget_title">Categories</h6>
                       <ul class="cat_list_widget">
                           <li><a href="#">Post 1</a></li>
                           <li><a href="#">Post 2</a></li>
                           <li><a href="#">Post 3</a></li>
                           <li><a href="#">Post 4</a></li>
                           <li><a href="#">Post 5</a></li>
                       </ul>
                   </div>
               </div>
            </aside>
        </div>
    </div>-->

