<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Store Slider</h4>
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
                                    Add Slider
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/store-slider'); ?>" class="btn btn-primary">View Slider</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php echo base_url('admin/doAddStoreSlider');?>">
                                 
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="image_url">Image <i style="color:red;">*</i></label>
                                        <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>   
                                    </div>

                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>