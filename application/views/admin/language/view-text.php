<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Text</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-language-text-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0"><?php
                            if (isset($text)) {
                                echo "Edit Text";
                            } else
                                echo "Add Text";
                            ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($text)) {
                            echo base_url('admin/doEditText/' . $text['text_id']);
                        } else {
                            echo base_url('admin/doAddText');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="text">Text</label>
                                <?php echo form_input(['name'=>'text','id'=>'text','class'=>'form-control'],isset($text['text'])?$text['text']:'') ?>
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



