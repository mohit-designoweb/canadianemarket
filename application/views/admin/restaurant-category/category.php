<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Restaurant Category</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-restaurant-category-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0">
						<?php
							if (!empty($cat)) {
								echo 'Edit';
							} else {
								echo 'Add';
							}
							?>
						Add Restaurant Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($cat)) {
                            echo base_url('admin/doEditRestaurantCategory/' . $cat['restaurant_category_id']);
                        } else {
                            echo base_url('admin/doAddRestaurantCategory');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="category_name">Category <i style="color:red;">*</i></label>
                                <?php echo form_input(['name'=>'category_name','id'=>'category_name','class'=>'form-control'],isset($cat['category_name'])?$cat['category_name']:'') ?>
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



