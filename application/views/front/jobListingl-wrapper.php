<?php foreach ($all_jobs as $job1) {
    ?>
    <div class="jobdetail boxs" >
        <div class="jobimg">
            <img src="<?php echo base_url('uploads/job/' . $job1['image_url']); ?>" alt="jobimg" class="img-responsive center-block">
        </div>

        <div class="jobcontent">
            <div class="jobflex">
                <div class="jobdata">
                    <h4><?php echo $job1['designation_name']; ?></h4>
                    <h5><?php echo $job1['designation_type'] ?></h5>
                    <p><span><img src="<?php echo base_url('assets/img/career_loc.png'); ?>" alt="career_loc" class="img-responsive"><?php echo $job1['job_location'] ?></span>
                        <span><img src="<?php echo base_url('assets/img/career_calender.png'); ?>" alt="career_calender" class="img-responsive">Posted 3 weeks ago</span>
                    </p>
                </div>
                <div class="viewdetailbtn">
                    <a href="<?php echo base_url('career-detail/' . $job1['alias']); ?>" class="slidehover">View Details</a>
                </div>
            </div>
        </div>
    </div>
<?php
}?>