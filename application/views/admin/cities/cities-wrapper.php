<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">
            Cities  List
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Country Name</th>
                        <th>Image</th>
                        <th>City Name</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($cities)) {
                        $i = 1;
                        foreach ($cities as $city) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $city['country_name']; ?></td>
                                <td><img src="<?php echo base_url('uploads/country/' . $city['image_url']); ?>" height="100px" width="100px" class="img-responsive"></td>
                                <td><?php echo $city['city_name']; ?></td>
                                <td><?php echo $city['is_active']; ?></td>
                                <td>
								<?php if ($city['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeCitiesStatus/' . $city['city_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeCitiesStatus/' . $city['city_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/city/' . $city['city_id']); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Category" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
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