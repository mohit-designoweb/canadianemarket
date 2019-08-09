    <section class="career topScrl">
        <div class="container">
            <div class="bread_crumb breadcrumb_shipping">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site');?>">Home</a></li>
                    <li><a><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#" class="active">Career</a></li>
                </ul>
            </div>
            <div class="career_inner boxs">
                <div class="career_head boxs">
                    <h2>Job Archives</h2>
                </div>
                <!--<form method="post" action="<?php echo base_url('site/getFilteredJobs');?>" id="career-filter">-->
                <div class="archivesbox boxs">
                    <div class="archivesbar width width1">
                        <input type="text" class="searchbar" id="search_val" name="search_val">
                    </div>
                    
                    <div class="archivesbar width width2">
                        <div class="categorybox">
                            <div class="cate_drop_down">
                                <button class="cate_dropbtn cate_dropbtn1" type="button"><span id="cat">Category</span> <img src="<?php echo base_url('assets/img/arrowdwn.png');?>" alt="arrowdwn" class="img-responsive rotate"></button>
                                <ul class="cate_drop_menu cate_drop_menu_s1" id="career_job_category" name="career_job_category" >
                                <?php foreach ($job_categories as $category){?>
                                    <li value="<?php $category['job_category_id'];?>"><a href="<?php echo base_url('site/getFilteredJobType/'.$category['job_category_id']);?>" class="job_category"><?php echo $category['job_category_name'];?></a></li>
                                <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="archivesbar width width3">
                        <div class="categorybox">
                            <div class="cate_drop_down">
                                <button class="cate_dropbtn cate_dropbtn2" type="button"><span id="type">Job Type</span> <img src="<?php echo base_url('assets/img/arrowdwn.png');?>" alt="arrowdwn" class="img-responsive rotate"></button>
                                <ul class="cate_drop_menu cate_drop_menu_s2" id="career_job_type" name="career_job_type">
                                  <?php foreach ($job_type as $type){?>
                                 <li><a href="javascript:void(0)"><?php echo $type['job_type_name'];?></a></li>
                                <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="archivesbar width width4">
                        <div class="categorybox">
                            <div class="cate_drop_down">
                                <button class="cate_dropbtn cate_dropbtn3" type="button"><span id="location">Location</span> <img src="<?php echo base_url('assets/img/arrowdwn.png');?>" alt="arrowdwn" class="img-responsive rotate"></button>
                                <ul class="cate_drop_menu cate_drop_menu_s3" id="career_job_location">
                                   <?php foreach($all_jobs as $job)
                                   {?>
                                     <li><a href="javascript:void(0)"><?php echo $job['job_location'];?></a></li>
                                   <?php }?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="archivesbar width width5">
                        <!--<a href="javascript:void(0)" class="searchbtn slidehover">SEARCH</a>-->
                        <input type="hidden" value="<?php echo base_url('site/getAllFilterId');?>" id="get-id-url">
                     <button type="button" class="searchbtn slidehover" value="">SEARCH</button>
                    </div>
                    
                </div>
                    <!--</form>-->
                <?php foreach ($all_jobs as $job){?>

                <div class="ca_inner2 boxs" id="job-after-filter">
                    <div class="jobdetail boxs" >
                        <div class="jobimg">
                            <img src="<?php echo base_url('uploads/job/'.$job['image_url']);?>" alt="jobimg" class="img-responsive center-block">
                        </div>
                        
                        <div class="jobcontent">
                            <div class="jobflex">
                                <div class="jobdata">
                                    <h4><?php echo $job['designation_name']; ?></h4>
                                    <h5><?php echo $job['designation_type'] ?></h5>
                                    <p><span><img src="<?php echo base_url('assets/img/career_loc.png');?>" alt="career_loc" class="img-responsive"><?php echo $job['job_location'] ?></span>
                                       <span><img src="<?php echo base_url('assets/img/career_calender.png');?>" alt="career_calender" class="img-responsive">Posted 3 weeks ago</span>
                                    </p>
                                </div>
                                <div class="viewdetailbtn">
                                    <a href="<?php echo base_url('career-detail/'.$job['alias']);?>" class="slidehover">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>

                </div>
            </div>
        </div>
    </section>