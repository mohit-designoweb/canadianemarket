<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Subscribers
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
                        <th>Subscriber Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($subscriber)) { 
                        $i = 1;
                        foreach ($subscriber as $sub) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $sub['user_email']; ?></td>  
                                <td><?php echo date("Y-m-d",strtotime($sub['created'])); ?></td>
                               <td>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="view" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>                                
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