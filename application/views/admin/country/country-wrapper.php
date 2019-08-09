<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Country Listing
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Country Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($countries)) {
                        $i = 1;
                        foreach ($countries as $countrie) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $countrie['country_name']; ?></td>
                                <td>
                                    <!--<a href="<?php echo base_url('admin/country/cities/' . $countrie['country_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add city"><i class="fe fe-menu"></i></a>-->
                                    <a href="<?php echo base_url('admin/country/' . $countrie['country_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm" title="Edit Country">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteCountry/' . $countrie['country_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Country">Delete <i class="fe fe-delete"></i></a>
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