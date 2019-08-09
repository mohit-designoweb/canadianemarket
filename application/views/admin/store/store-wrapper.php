<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Store Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addStore'); ?>" class="btn btn-primary">Add Store</a>
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
                        <th>Store Name</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($stores)) {
                        $i = 1;
                        foreach ($stores as $store) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><a href="<?php echo base_url('admin/editStore/' . $store['store_id']); ?>"><img height="100" width="100" src="<?php echo base_url('uploads/store/' . $store['image_url']); ?>"/></a></td>
                                <td><a class="btnUrls" href="<?php echo base_url('admin/editStore/' . $store['store_id']); ?>"><?php echo $store['store_name']; ?></a></td>
                                <td><?php echo $store['category_name']; ?></td>
                                <td><?php echo $store['description']; ?></td>
                                <td><?php echo $store['city']; ?></td>	
                                <td><a href="<?php echo base_url('admin/editStore/' . $store['store_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Store" class="btn btn-success btn-sm"> Edit <i class="fe fe-edit"></i></a></td>
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