     <form name="review" id="review" action="<?php echo base_url('user/doAddReview/'.$restaurant_id);?>" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center text-success"><strong>Your Rating</strong></h4>
        </div>
        <div class="modal-body">
            <div class="descipt product_descipt reviewbx" id="review_box">
            <!--<h2>Reviews</h2>-->
            <!--<p>There are no reviews yet.</p>-->
            <!--<p>Be the first to review “OluKai U’I”</p>-->
                <h4>
                    <img src="<?php echo base_url('uploads/profile_images/'.$user_data['image_url']);?>" alt="icon">
                    <!--<span>Your review <g>*</g></span>-->
                    <span>Select Rating Points <g>*</g></span>
                </h4>
<!--                <div class="messag_wrp boxs">
                    <div class="form-group">
                        <textarea class="form-control" name="review" id="review"></textarea>
                    </div>
                </div>-->
                <h5></h5>
                <center>
                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&bigstar;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&bigstar;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" checked/>
                        <label for="3-stars" class="star">&bigstar;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&bigstar;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&bigstar;</label>
                    </div>
                </center>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </form>