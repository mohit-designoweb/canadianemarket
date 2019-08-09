    <form name="store_product_reorder" id="store_product_reorder" action="<?php echo base_url('user/do_product_reorder/'.$product_orderid);?>" method="post">
        <div class="modal-content" id="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center text-success"> Re-order </h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="product_reorder_date">Date:</label>
                <input type="text" name="product_reorder_date" id="product_reorder_date">
              </div>
              <div class="form-group">
                <label for="product_reorder_time">Time:</label>
                <input type="time" name="product_reorder_time" id="product_reorder_time" class="datepicker">
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" name="submit">Submit</button>
          </div>
        </div>
      </form>
	  <script>
$(document).ready(function($){
$('#product_reorder_date').datepicker({  minDate: 0 });

});
// $( function() {
// $( "#datepicker" ).datepicker();
// } );
</script>