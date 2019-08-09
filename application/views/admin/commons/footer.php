<input type="hidden" id="base-url1" value="<?php echo base_url('admin');?>">
<div id="order-cancel-reason" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="common-form" id="common-form" action="<?php echo base_url('partnerOrder/order-cancel-reason/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-10 offset-2">
                                        <h5>ENTER REASON TO CANCEL ORDER</h5>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <p id="error_msg"></p>
                                    <div class="col-2"><label>Reason:</label></div>
                                    <div class="col-10">
                                        <textarea name="order-cancel" rows="10" cols="50" id="order-cancel" name="order-cancel" placeholder="Give Reason To Reject Order"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-3 offset-8">
                                        <button class="btn btn-primary pull-right" type="submit" name="otpBtn">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="order-deliver-time" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="order-prepare-time" id="order-prepare-time" action="<?php echo base_url('partnerOrder/order-prepared-time/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-10 offset-2">
                                        <h5>ENTER ORDER PREPARED TIME</h5>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <p id="error_msg"></p>
                                    <div class="col-2"><label>Time:</label></div>
                                    <div class="col-10">
                                        <input type="time" name="order-time" id="order-time">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-3 offset-8">
                                        <button class="btn btn-primary pull-right" type="submit" name="orderPrepTime" id="orderPrepTime">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="search-order" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" id="user-address-div">
        <!-- Modal content-->
    <div class="modal-content newOffer">
            <div class="modal-body">
            <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="order-prepare-time" id="order-prepare-time" action="<?php echo base_url('partnerOrder/order-prepared-time/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-8">
                                        <h5>Matching You To Orders</h5>
                                        <h6>Searching...</h6>
                                    </div>
                                    
                                </div>
                           
                               <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="map">

                                    </div>
                                </div>
                            </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<div id="drag-path" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" id="user-address-div">
        <!-- Modal content-->
    <div class="modal-content newOffer">
            <div class="modal-body">
            <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="order-prepare-time" id="order-prepare-time" action="<?php echo base_url('partnerOrder/order-prepared-time/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-8">
                                        <h5>Matching You To Orders</h5>
                                    </div>
                                </div>
                               <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="map">

                                    </div>
                                </div>
                            </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<script src='<?php echo base_url('public/js/pace.min.js') ?>'></script>
<script src='<?php echo base_url('public/js/demo.js') ?>'></script>

<!--page specific scripts for demo-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-66116118-3"></script> -->
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-66116118-3');
</script>

<!--Additional Page includes-->
<script src='<?php echo base_url('public/js/apexcharts.min.js') ?>'></script>
<!--chart data for current dashboard-->
<?php if (!empty($table)) {
    ?>
    <script src='<?php echo base_url('public/js/datatable.js') ?>'></script>
<?php }
?>
<?php if (!empty($map)) {
    ?>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQdch5IcgcQaKNG76sbMQv1MEBEKLeQ-8&callback=initMap"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCda3VpSiUTaG60fI3sH4Ch2L1ch0Fo06A"></script>
    <script>
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var endMarker;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;

        if (latitude !== '' && longitude !== '') {
            india = new google.maps.LatLng(latitude, longitude);
        } else {
            india = new google.maps.LatLng(49.89377299321406, -97.13936336669917);
        }

        var mapOptions = {
            zoom: 18,
            center: india
        }
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        directionsDisplay.setMap(map);
        endMarker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(endMarker, 'dragend', function () {
            var lat = endMarker.getPosition().lat();
            var lng = endMarker.getPosition().lng();
            $('#latitude').val(lat);
            $('#longitude').val(lng);

            lat = parseFloat(lat);
            lng = parseFloat(lng);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        $('#address').val(results[1].formatted_address);
                    }
                }
            });
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <?php }
?>
<?php if (!empty($editor)){?>

<script src="<?php echo base_url('public/ckeditor/ckeditor.js'); ?>" ></script>
<script>
CKEDITOR.replace( 'description' );
</script>
<?php }?>
<script src='<?php echo base_url('public/js/event.js') ?>'></script>

</body>

</html>