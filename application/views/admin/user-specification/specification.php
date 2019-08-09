<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Attribute</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-specification-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0">
						<?php
                                    if (!empty($specifi)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?>
						 Attribute</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($specifi)) {
                            echo base_url('admin/do-edit-specification/' . $specifi['group_id']);
                        } else {
                            echo base_url('admin/do-add-specification');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="category_name">Attribute</label>
                                <?php echo form_input(['name'=>'group_name','id'=>'group_name','class'=>'form-control'],isset($specifi['group_name'])?$specifi['group_name']:'') ?>
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