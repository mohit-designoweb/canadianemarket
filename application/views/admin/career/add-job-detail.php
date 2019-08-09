<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Job Type</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <h5 class="m-b-0" style="padding-top: 5px"><?php if(!empty($restaurant['restaurant_id'])){ echo 'Edit'; }else{ echo 'Add'; } ?> Job</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/job-board'); ?>" class="btn btn-primary">View Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($jobDetail)) {
                            echo base_url('admin/doEditJobDetail/' . $jobDetail['job_id']);
                        } else {
                            echo base_url('admin/doAddJobDetail');
                        }
                        ?>">
                              <?php if (!empty($jobDetail['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/job/' . $jobDetail['image_url']); ?>" class="img-responsive">
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_category_id">Job Category <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name' => 'job_category_id', 'id' => 'job_category_id', 'class' => 'form-control','data-url'=>base_url('admin/career/filteredJobType')], $category, isset($jobDetail['job_category_id']) ? $jobDetail['job_category_id'] : ''); ?>   
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_type_id">Job Type <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name' => 'job_type_id', 'id' => 'job_type_id', 'class' => 'form-control'], $type, isset($jobDetail['job_type_id']) ? $jobDetail['job_type_id'] : ''); ?>   
                                    </div>    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation_name">Designation Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'designation_name', 'id' => 'designation_name', 'class' => 'form-control'], isset($jobDetail['designation_name']) ? $jobDetail['designation_name'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation_type">Designation Type <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'designation_type', 'id' => 'designation_type', 'class' => 'form-control'], isset($jobDetail['designation_type']) ? $jobDetail['designation_type'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_post_date">Job Post Date <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'job_post_date', 'id' => 'job_post_date', 'class' => 'form-control'], isset($jobDetail['job_post_date']) ? $jobDetail['job_post_date'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
							 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_location">Job Location <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'job_location', 'id' => 'job_location', 'class' => 'form-control'], isset($jobDetail['job_location']) ? $jobDetail['job_location'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Description <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($jobDetail['description']) ? $jobDetail['description'] : '') ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->

                </div>
            </div>
        </div>
    </div>
</div>
</section>

</main>