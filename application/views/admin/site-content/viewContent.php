<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Content</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12" id="content-wrapper" data-url="">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php if(empty($content['content'])){echo base_url('admin/addTermsPageContent');} else{
                         echo base_url('admin/editTermsPageContent/'.$content['content_id']);   
                        }?>" id="common-form" >
                            <div class="form-group">
                                <?php echo form_textarea(['name'=>'description','id'=>'description','class'=>'form-control ckeditor'],isset($content['content']) ? $content['content'] : '');?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>



