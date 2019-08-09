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
                                <h5 class="m-b-0" style="padding-top: 5px"><?php if(!empty($restaurant['restaurant_id'])){ echo 'Edit'; }else{ echo 'Add'; } ?> Product</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/career'); ?>" class="btn btn-primary">View Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($jobType)) {
                            echo base_url('admin/doEditJobType/' . $jobType['job_type_id']);
                        } else {
                            echo base_url('admin/doAddJobType');
                        }
                        ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_category_id">Job Category <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name' => 'job_category_id', 'id' => 'job_category_id', 'class' => 'form-control'], $category, isset($jobType['job_category_id']) ? $jobType['job_category_id'] : ''); ?>   
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_type">Job Type <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'job_type', 'id' => 'job_type', 'class' => 'form-control'], isset($jobType['job_type_name']) ? $jobType['job_type_name'] : ''); ?>   
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