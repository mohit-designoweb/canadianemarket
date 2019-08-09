

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
            <div class="col-8 offset-3">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <p id="error_msg"></p>
                    <?php
                    if(!empty($admin)){ 
                        $url = base_url('admin/doChangePassword');
                    } else if (!empty($partner)) {
                        $url = base_url('partner/doChangePassword');
                    } else if (!empty($courier)) {
                        $url = base_url('courier/doChangePassword');
                    } ?>
                    <form method="post" action="<?php echo $url; ?>" id="common-form">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-8 offset-2">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" value="" id="old_password" name="old_password" placeholder="Enter Old Password">
                                </div>
                                <div class="form-group col-md-8 offset-2">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control"  value="" id="new_password" name="new_password" placeholder="Enter New Password">
                                </div>
                                <div class="form-group col-md-8 offset-2">
                                    <label for="confirm_new_password">Confirm New Password</label>
                                    <input type="password" class="form-control"  value="" id="confirm_new_password" name="confirm_new_password" placeholder="Enter Confirm New Password">
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



