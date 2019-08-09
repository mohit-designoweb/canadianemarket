<?php if(!empty($is_admin)){?>

<section class="admin-content ">
        <div class="jumbotron">
            <div class="row">
                <div class="col-lg-6 col-xlg-4">
                    <h3 class="">Hi Admin, Welcome Back</h3>
                    <p class="text-muted">
                        Dashboard
                    </p>
                </div>
            </div>
           
            <div class="row">

                <div class="col-xlg-6  m-b-30 col-lg-12">
                    <div class="row">
                        <div class=" col-md-4">  <!--widget card begin-->
                            <div class="card m-b-30">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h6 class="fw-600"><a href="<?php echo base_url('admin/registered-user') ?>">Registered Total Users</a></h6>
                                            <p class="text-muted">
                                            </p>
                                        </div>
                                        <div class="col-md-5 my-auto text-right">
                                            <h4 class="text-danger"><?php echo $total_user['total_users'];?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--widget card ends-->
                        </div>
                        <div class=" col-md-4">  <!--widget card begin-->
                            <div class="card m-b-30">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h6 class="fw-600"><a href="<?php echo base_url('admin/courierSection') ?>">Registered Total Courier</a></h6>
                                            <p class="text-muted">
                                            </p>
                                        </div>
                                        <div class="col-md-5 my-auto text-right">
                                            <h4 class="text-danger"><?php echo $total_courier['total_courier'];?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--widget card ends-->
                        </div>
                        <div class=" col-md-4">  <!--widget card begin-->
                            <div class="card m-b-30">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h6 class="fw-600"><a href="<?php echo base_url('admin/partner-application'); ?>">Partner Enquiries</a></h6>
                                            <p class="text-muted">
                                               
                                            </p>
                                        </div>
                                        <div class="col-md-5 my-auto text-right">
                                            <h4 class="text-danger"><?php echo $total_partner_enquiries['total_partner'];?></h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--widget card ends-->
                        </div>
                        <div class=" col-md-4">  <!--widget card begin-->
                            <div class="card m-b-30">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h6 class="fw-600"><a href="<?php echo base_url('admin/courier-application') ?>">Courier Enquiriers</a></h6>
                                            <p class="text-muted">
                                              
                                            </p>
                                        </div>
                                        <div class="col-md-5 my-auto text-right">
                                            <h4 class="text-danger"><?php echo $total_courier_enquiries['total_courier'];?></h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--widget card ends-->
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
         
        </div>
    </section>
<?php } else{?>

    <!--site header ends -->    
    <section class="admin-content">
        <div class="container p-t-20">
            <div class="row">
<!--                <div class="col-12 m-b-30">
                    <h3>Project Dashboard</h3>
                </div>
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h3> Overview</h3>
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                            <div id="chart-09"></div>
                        </div>
                    </div>
                </div>-->


            </div>
        </div>
    </section>
<?php }?>
</main>



