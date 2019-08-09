<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Language</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-language-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0">Add Language</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($lang)) {

                            echo base_url('admin/doEditLanguage/' . $lang['language_id']);
                        } else {
                            echo base_url('admin/doAddLanguage');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="language_name">Language</label>
                                <input type="text" class="form-control" value="<?php
                                if (isset($lang)) {
                                    echo $lang['language'];
                                }
                                ?>" id="language_name" name="language_name" placeholder="Enter Language Name" />
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



