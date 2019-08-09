<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Country</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-country-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0">
						<?php if (!empty($country)) {
                                echo 'Edit';
                            } else {
                                echo 'Add';
                            } ?>
						
						 Country</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="common-form" action="<?php
                        if (!empty($country)) {
                            echo base_url('admin/doEditCountry/' . $country['country_id']);
                        } else {
                            echo base_url('admin/doAddCountry');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="first_name">Country Name <i style="color:red;">*</i></label>
                                <?php echo form_input(['name' => 'country_name', 'id' => 'country_name', 'class' => 'form-control', 'placeholder' => 'country Name'], isset($country['country_name']) ? $country['country_name'] : ''); ?>   
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



