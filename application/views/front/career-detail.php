<section class="career_details topScrl">
        <div class="container">
            <?php // print_r($job_detail);?>
            <div class="bread_crumb breadcrumb_shipping">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site');?>">Home</a></li>
                    <li><a><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('career');?>" class="active">Career</a></li>
                </ul>
            </div>
            <div class="career_inner boxs">
                <div class="career_head boxs">
                    <h2><?php echo $job_detail['designation_name'];?></h2>
                    
                </div>

                <div class="career_details_inner boxs">
                    <div class="jobdetail boxs jobdetailcareer">
                        <div class="jobimg">
                            <img src="<?php echo base_url('uploads/job/'.$job_detail['image_url']);?>" alt="jobimg" class="img-responsive center-block">
                        </div>
                        <div class="jobcontent">
                            <div class="jobflex">
                                <div class="jobdata">
                                    <h4><?php echo $job_detail['designation_name'];?></h4>
                                    <h5><?php echo $job_detail['designation_type'];?></h5>
                                    <p><span><img src="<?php echo base_url('assets');?>/img/career_loc.png" alt="career_loc" class="img-responsive">Winnipeg</span>
                                        <span><img src="<?php echo base_url('assets');?>/img/career_calender.png" alt="career_calender" class="img-responsive">Posted 3 weeks ago</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="C_deatils boxs">
                        <?php echo $job_detail['description'];?>
                    </div>
					<p class="error_msg"></p>

                    <div class="cjobfeatures boxs">
                        <form method="post" action="<?php echo base_url('site/jobEnquiry');?>" id="image-common-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="jb_lft boxs">
									<p id="error_msg"></p>
                                        <h4>Apply Online</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="job_first_name">First Name <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="job_first_name" id="job_first_name" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $job_detail['alias']; ?>" name="job_alias" id="job_alias">
                                <input type="hidden" value="<?php echo $job_detail['job_id']; ?>" name="job_id" id="job_id">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="job_last_name">Last Name <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="job_last_name" id="job_last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="job_email">Email <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="job_email" id="job_email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="job_cover_letter">Cover Letter <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="job_cover_letter" id="job_cover_letter" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="jb_ryt boxs">
                                        <!-- <h4>Apply Online</h4> -->
                                        <div class="archivesbar width width3">
                                            <div class="categorybox">
                                                <div class="cate_drop_down">
                                                    <p>Attach Resume<i class="fa fa-asterisk"></i></p>
                                                    <input type="file" name="job_file" id="job_file" class="form-control">
<!--                                                    <div class="file-upload">
                                                        <div class="file-select">
                                                            <div class="file-select-name" id="noFile">No file chosen...</div>
                                                            <div class="file-select-button" id="fileName">Browse</div>
                                                            <input type="file" name="job_file" id="job_file">
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <!--<a href="javascript:void(0)" class="slidehover subbtn">SUBMIT</a>-->
                                    <input type="submit" class="slidehover subbtn"></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>