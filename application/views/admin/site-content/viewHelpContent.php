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
                    <span class="error-msg"></span>
                    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                   Detail Content
                </h5>
            </div>
            <div class="col-2 offset-7">
                 <a href="<?php echo base_url('admin/help'); ?>" class="btn btn-primary pull-right">Back</a> 
            </div>
        </div>
    </div>
                             
                    
                    <div class="card-body">
                        <form method="post" action="<?php if(empty($content['help_content'])){echo base_url('admin/addHelpPageContent/'.$category_id);} else{
                         echo base_url('admin/editHelpPageContent/'.$content['help_id']);   
                        }?>" id="common-form" >
                           
                            <div class="form-group">
                                <?php echo form_textarea(['name'=>'description','id'=>'description','class'=>'form-control ckeditor'],isset($content['help_content']) ? $content['help_content'] : '');?>
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



