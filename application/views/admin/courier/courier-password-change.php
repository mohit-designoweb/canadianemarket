<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Partner Password Change</h4>
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
                                <h5 class="m-b-0" style="padding-top: 5px">
                                    Change Password
                                </h5></br>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/courierSection'); ?>" class="btn btn-primary">View Courier</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form-password" action="<?php echo base_url('admin/courierSection/updatePassword/'.$courier['courier_id']);?>">
                               
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="password">New Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" value="">
                                        
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                            
                          
<!--                            <div class="row">
                                <div class="col-2 offset-10">
                                    
                                </div>
                            </div>-->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>