

<!--site header ends -->    
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Update Profile</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <p id="error_msg"></p>
                    <form method="post" action="<?php echo base_url('admin/doUpdateProfile'); ?>" id="image-common-form" enctype="multipart/form-data">
                        <div class="card-body ">

                            <?php if(!empty($user['image_url'])){
                            ?>
                            <div class="form-row">
                                <div class="col-6">
                                    <img src=" <?php echo base_url('uploads/profile_images/'.$user['image_url']); ?>" height="160px" width="160px"  class="img-circle" />
                                </div>
                            </div>
                            <?php
                            } ?>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="profile_image">Upload Image</label>
                                        <input type="file" id="image_url" name="image_url" class="form-control" />
                                    </div> 
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" value="<?php
                                    if (isset($user)) {
                                        echo $user['first_name'];
                                    }
                                    ?>" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control"  value="<?php
                                    if (isset($user)) {
                                        echo $user['last_name'];
                                    }
                                    ?>" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div> 


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!--widget card ends-->


            </div>

        </div>


    </div
</section>

</main>



