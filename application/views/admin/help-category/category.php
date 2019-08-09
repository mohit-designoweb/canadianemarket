<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Help Category</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-help-category-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0"><?php if(!empty($category1)){ echo 'Edit'; }else{ echo 'Add'; } ?> Help Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($category1)) {
                            echo base_url('admin/doEditHelpCategory/'.$category1['help_category_id']);
                        } else {
                            echo base_url('admin/doAddHelpCategory');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="menu_category_name">Help Category</label>
                                <?php echo form_input(['name'=>'help_category_name','id'=>'help_category_name','class'=>'form-control'],isset($category1['category_name'])?$category1['category_name']:'') ?>
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



