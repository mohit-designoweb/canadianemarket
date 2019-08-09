<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>City List</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-9" id="content-wrapper" data-url="<?php echo base_url('admin/cities-wrapper'); ?>"></div>
            <div class="col-3">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0"><?php
                            if (!empty($city)) {
                                echo 'Edit';
                            } else {
                                echo 'Add';
                            }
                            ?> Cities</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="image-common-form" action="<?php
                        if (!empty($city)) {
                            echo base_url('admin/doEditCities/' . $city['city_id']);
                        } else {
                            echo base_url('admin/doAddCities');
                        }
                        ?>">
                                  <?php if (!empty($city['image_url'])) {
                                      ?>
                                <div class="form-group">
                                    <img src="<?php echo base_url('uploads/country/' . $city['image_url']); ?>" height="100px" width="100px" class="img-responsive">
                                </div>
                            <?php }
                            ?>
                            <div class="form-group">
                                <label for="image_url">Image</label>
                                <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>   
                            </div>
                            <div class="form-group">
                                <label for="country_id">Country <i style="color:red;">*</i></label>
                                <?php echo form_dropdown(['name' => 'country_id', 'id' => 'country_id', 'class' => 'form-control'], $country, isset($city['country_id']) ? $city['country_id'] : '') ?>
                            </div>
                            <div class="form-group">
                                <label for="cities_name">Cities <i style="color:red;">*</i></label>
                                <?php echo form_input(['name' => 'city_name', 'id' => 'city_name', 'class' => 'form-control'], isset($city['city_name']) ? $city['city_name'] : '') ?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>



