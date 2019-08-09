<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Language Text</h4>
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
                                    Update Language Text
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/text'); ?>" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/update-text-lang/' . $text['text_id']) ?>" id="common-form" method="post">
                            <div class="row">
                                <?php
                                if (isset($text)) {
                                    $i = 3;
                                    $keys = array_keys($text);
                                    for ($i = 3; $i < count($keys); $i++) {
                                        $lang = $keys[$i];
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store_name"><?php echo ucwords($keys[$i]); ?></label>
                                                <input type="text" class="form-control" value="<?php echo $text[$lang]; ?>"
                                                       id="<?php echo $keys[$i]; ?>" name="<?php echo $keys[$i]; ?>" placeholder="Enter Text In <?php echo ucwords($keys[$i]); ?> Language" />
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
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