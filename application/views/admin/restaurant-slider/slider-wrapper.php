<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Slider Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addSlider'); ?>" class="btn btn-primary">Add Slider</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($sliders)) {

                        $i = 1;
                        foreach ($sliders as $slider) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo base_url('uploads/slider/' . $slider['image_url']); ?>" height="50" width="100"  class="img-responsive"></td>
                              
                                <td><?php echo $slider['is_active']; ?></td>
                                <td>
                                    <?php if ($slider['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeSliderStatus/' . $slider['slider_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeSliderStatus/' . $slider['slider_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/doDeleteSlider/' . $slider['slider_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Slider">Delete <i class="fe fe-trash"></i></a>
                                    
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>