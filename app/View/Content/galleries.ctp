
    
    
    	
    <div class="content_section page_title default">
        <div class="content clearfix" style="margin-top:100px;">
            <h1>Gallery</h1>
        </div>
    </div>
    <!-- End Page Title -->
				
    <div class="content_section bg_gray2 border_t_gray1" >
        <div class="full_content clearfix">
            <div class="hm_columns content_block col-md-12 f_right">
            
                    <!-- SideBar -->
                <aside id="sidebar" class="hm_columns col-md-3 left_sidebar row_spacer">
                <div class="hm_column_con">
                    
                    <div class="widget_block widget_search">
                        <div class="search_block">
                            <form class="searchform" method="get">
                                <input class="serch_input" type="search" name="s" id="s" placeholder="Search..." />
                                <button type="submit" id="searchsubmit" class="search_btn animate"><i class="ico-search9"></i></button>
                                <div class="clear"></div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    
                    <div class="widget_block widget_categories">
                        <h6 class="widget_title">House Selection</h6>
                        <ul class="cat_list_widget">
                            <?php foreach($galleries as $entry): ?>
                            <li><a href="/content/gallery/<?= $entry['Content']['id']; ?>"><?= $entry['Content']['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    
                    
                </div>
                </aside>
                <!-- End SideBar -->
            
            
            <!-- Portfolio Filter -->
                
                <aside id="sidebar" class="hm_columns col-md-8 left_sidebar row_spacer">    
                    <?php foreach($galleries as $entry): ?>
                    <!-- One Post -->
                    <li class="filter_item_block animated" data-animation-delay="300" data-animation="fadeInUp">
                        <div class="blog_grid_block">
                            <div class="feature_inner">
                                <div class="feature_inner_corners">
                                    <a class="" href="/content/gallery/<?= $entry['Content']['id']; ?>">
                                        <img src="/files/galleries/<?= $entry['Content']['linked_gallery'] . '/' . $entry['Content']['first_image']; ?>" alt="Clothes Vector" style="min-height: 100px; max-height: 100px;">
                                        <span class="hm_plus_i"><i class="ico-plus10 hm_iii"></i></span>
                                    </a>
                                </div>
                            </div>
                            <div class="blog_grid_con">
                                <h6 class="title"><a href="/content/gallery/<?= $entry['Content']['id']; ?>"><?= $entry['Content']['name']; ?></a></h6>
                            </div>
                        </div>
                    </li>
                     <!-- /One Post -->
                    <?php endforeach; ?>
                </ul>
                </aside>
            </div>
        </div>
    </div>
