<section class="cards">
    <div class="container">
        <div class="card_inner boxs">
            <div class="row">
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg1.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>Gift Cards</h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg2.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>100% ORIGINAL </h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg3.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>Easy Returns</h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
<footer class="footer">
    <div class="container">
        <div class="f_inner boxs">
            <div class="row">

                <div class="col-sm-8 bd_ryt">
                    <div class="f_lft boxs">
                        <div class="row">
                            <div class="col-sm-6 width40 res_dnone">
                                <div class="lft_item boxs">
                                    <a href="<?php echo base_url('site'); ?>" class="f_logo"><img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="logo" class="img-responsive"></a>
                                    <p class="copyright">Canadian Markets <br>&copy; 2019 Canadiane Market</p>
                                </div>
                            </div>
                            <div class="col-sm-6 width60">
                                <div class="f_links boxs">
                                    <ul>
                                        <li><a>Categories</a></li>
                                        <li><a href="<?php echo base_url('store'); ?>">Stores</a></li>
                                        <li><a href="<?php echo base_url('marketPlace'); ?>">Marketplace</a></li>
                                        <li><a href="<?php echo base_url('restaurant'); ?>">Restaurants</a></li>
                                        <li><a href="<?php echo base_url('gift-card'); ?>">Gift Cards</a></li>
                                        <li></li>
                                    </ul>
                                </div>
                                <div class="f_links boxs">
                                    <ul>
                                        <li><a>Quick Links</a></li>
                                        <li><a href="<?php echo base_url('site/terms'); ?>">Terms and Conditions</a></li>
                                        <li><a href="<?php echo base_url('site/privacy') ?>">Privacy Policy</a></li>
                                        <li><a href="<?php echo base_url('site/help'); ?>">Help</a></li>
                                        <li><a href="javascript:void(0)">Refer a Friend</a></li>
                                        <li><a href="<?php echo base_url('site/partner-with-us'); ?>">Partner with Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="f_ryt boxs">
                        <div class="fryt_inner boxs">
                            <h3>Subscribe Now</h3>
                            <div id="error_msg"></div>
                            <div class="subscribebtn boxs"> 
                                <div class="input_group">
                                    <input id="subscribe" type="email" class="form-control" name="subscribe" placeholder="Enter Your email address">
                                    <a href="<?php echo base_url('site/subscription'); ?>" class="slidehover " id="user-subscribe"><img src="<?php echo base_url('assets/img/subicon.png'); ?>" alt="subicon" class="img-responsive "></a>       
                                </div>
                            </div>
							 <span id="error_show"></span>
                            <div class="social_links boxs">
                                <a href="javascript:void(0);"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                <a href="javascript:void(0);" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- register modal start -->
<div id="register" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets'); ?>/img/cross2.png" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Register</h3>
                                <p>Join Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">
					

                        <div class="reg_ryt boxs">
                            <div id="error_msg2"></div>
                            <form method="post" action="<?php echo base_url('user/registerForm'); ?>" id="registerForm" name="registerForm">
                                <div class="formbox boxs">
                                    <h6>Fill the form</h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email_reg">Email address <sup>*</sup></label>
                                                <input type="email" name="email_reg" class="form-control" id="email_reg">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="user_name_reg">Username <sup>*</sup></label>
                                                <input type="text" name="user_name_reg" class="form-control" id="user_name_reg">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password_reg">Password <sup>*</sup></label>
                                                <input type="password" name="password_reg" class="form-control" id="password_reg">
                                            </div>
                                        </div>
										<div class="col-sm-12">
											<div class="form-group">
												<label for="ref_code">Referance Code</label>
												<input type="text" name="ref_code" class="form-control" id="ref_code" placeholder="Fill Referance Code,If You Have! And Earn">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="regsform">Register</button>
                                                <p>or</p>
                                                <div class="social_links">
                                                    <a href="<?php echo $this->facebook->login_url(); ?>"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                                    <a href="<?php echo $this->google->get_login_url(); ?>" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                                                </div>
                                            </div>
                                            <p class="modalfont">Already a member? <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#login">Sign In.</a></p>
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
<!-- register modal end -->

<!-- login modal start -->
<div id="login" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Login</h3>
                                <p>Login into Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_ryt boxs">
                            <p id="error_msg1"></p>
                            <form method="post" name="loginForm" id="loginForm" action="<?php echo base_url('user/login'); ?>">
                                <div class="formbox boxs">
                                    <h6>Fill the form</h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email_id">Email Id <sup>*</sup></label>
                                                <input type="email_id" name="email_id" class="form-control" id="email_id" placeholder="Enter your email id">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password">Password <sup>*</sup></label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="********">
                                            </div>
                                            <div class="forgotpass boxs">
                                                <a href="javascript:void(0)" class="forgotbtn" data-dismiss="modal" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                                                <!-- <div class="tick">
                                                    <input type="checkbox" class="tick_input" id="tick1">
                                                    <label for="tick1"><span></span>Create an account?</label>
                                                </div> -->
												
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="loginbtn">LOGIN</button>
                                                <p>or</p>
                                                <div class="social_links">
                                                    <a href="<?php echo $this->facebook->login_url(); ?>"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                                    <a href="<?php echo $this->google->get_login_url(); ?>" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                                                </div>
                                            </div>
                                            <p class="modalfont">Not a member? <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#register">Register Now!</a></p>
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
<div id="forgotPassword" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Login</h3>
                                <p>Login into Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_ryt boxs">
                           <p id="error_msg2"></p>
						    <div id="error_msg"></div>
                            <form method="post" name="forgotPasswordForm" id="forgotPasswordForm" action="<?php echo base_url('user/forgot-password'); ?>">
                                <div class="formbox boxs">
                                    <!-- <h6>Fill the form</h6> -->
                                   
									<div class="row">
                                        <div class="col-sm-12">
											
                                            <div class="form-group">
                                                <label for="regiter_email">Email Id <sup>*</sup></label>
                                                <input type="email" name="regiter_email" class="form-control" id="regiter_email" placeholder="Enter your registered email id">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="loginbtn">SEND LINK</button>
                                            </div>

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
<!-- login modal end -->
<div id="mobileOTP" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">

                    <div class="col-sm-6 modalflex nopadding" >
                        <div class="reg_ryt boxs" >
                            <form method="post" name="otpForm" id="otpForm" action="<?php echo base_url('site/doCheckPartnerOtp'); ?>">
                                <div class="formbox boxs">
                                    <h6>ENTER OTP SENT ON YOUR MOBILE</h6>
                                    <p id="error_msg"></p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="otp">OTP <sup>*</sup></label>
                                                <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter One Time Password">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="otpBtn">Submit</button>
                                            </div>
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

<div id="courierOTP" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">

                    <div class="col-sm-6 modalflex nopadding" >
                        <div class="reg_ryt boxs" >
                            <form method="post" name="courierOtpForm" id="courierOtpForm" action="<?php echo base_url('site/doCheckCourierOtp'); ?>">
                                <div class="formbox boxs">
                                    <h6>ENTER OTP SENT ON YOUR MOBILE</h6>
                                    <p id="courier_error_msg"></p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="courireOtp">OTP <sup>*</sup></label>
                                                <input type="text" name="courireOtp" class="form-control" id="courireOtp" placeholder="Enter One Time Password">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="courierOtpBtn">Submit</button>
                                            </div>
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


<div id="userUniqueid" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">

                    <div class="col-sm-6 modalflex nopadding" >
                        <div class="reg_ryt boxs" >
                            <form method="post" name="courierOtpForm" id="courierOtpForm" action="<?php echo base_url('ecommerce/doCheckCourierOtp'); ?>">
                                <div class="formbox boxs">
                                    <h6>Tell Your Friend This Unique Code And Earn!!</h6>
                                    <p id="courier_error_msg"></p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p><b><?php echo $user_data['unique_id'];?></b></p>
                                            </div>
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

<!--    top button-->
<div class="top">
    <i class="fa fa-arrow-circle-up"></i>
</div>
<!--    top button-->
<input type="hidden" id="base-url" value="<?php echo base_url(); ?>"/>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/slick.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<?php if (!empty($map_search)) { ?>

    <script>
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            //        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };


                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

    </script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCda3VpSiUTaG60fI3sH4Ch2L1ch0Fo06A&libraries=places&callback=initAutocomplete" async defer></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCda3VpSiUTaG60fI3sH4Ch2L1ch0Fo06A&libraries=places&callback=initAutocomplete"></script>
    <script src=<?php echo base_url('public/js/jquery.geocomplete.js'); ?>></script>


    <script>
        var user_lat = '';
        var user_lng = '';
        var options = {
            map: "#map",
            mapOptions: {
                streetViewControl: false,
                scrollwheel: true
            },
            markerOptions: {
                draggable: true
            },

        };
        $("#address").geocomplete(options).bind("geocode:result", function (event, result) {
            $('#address').val(result.formatted_address);
            var map = $("#address").geocomplete("map");
            map.setZoom(14);
            map.setCenter(result.geometry.location);
        });

        $("#address").bind("geocode:dragged", function (event, latLng) {
            var user_lat = console.log('Dragged Lat: ' + latLng.lat());
            var user_lng = console.log('Dragged Lng: ' + latLng.lng());
            user_lat = latLng.lat();
            user_lng = latLng.lng();
            //            alert(user_lat);
            //            alert(user_lng);
            var url = $('#base-url').val();
            $.post(url + '/site/setUserLocation', {latitude: user_lat, longitude: user_lng}, function (out) {
                if (out.result === 1) {
                    $('.btn_btn').text('Find Restaurant and Store in your Area');
                    $('.btn_btn').css('background', 'Red');
                    $('#set-address').attr("disabled", false);
                }
                if (out.result === 0) {
                    $('.btn_btn').text('Provide House number');
                    $('.btn_btn').css('background', '#bf6126');
                    $('#set-address').attr("disabled", true);
                }
            });
            var map = $("#address").geocomplete("map");
            map.panTo(latLng);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latLng
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var road = results[0].address_components[1].long_name;
                        var town = results[0].address_components[2].long_name;
                        var county = results[0].address_components[3].long_name;
                        var country = results[0].address_components[4].long_name;
                        $('#address').val(road + ' ' + town + ' ' + county + ' ' + country);
                    }
                }
            });

        });


        $('.locationbtn #address').keyup(function () {
            $('#map2').hide();
        });

        $('.locbox img.find_bn').click(function () {
            $('#map').hide();
            $('.locationbtn #address').val('');
            $('.map_inner3').css('display', 'block');
        });


        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        var map, infoWindow;
        var geocoder;

        function initMap() {
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map2'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 14,
                scrollwheel: true
            });
            infoWindow = new google.maps.InfoWindow;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    //                    alert(position.coords.latitude);
                    //                    alert(position.coords.longitude);

                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable: true,
                        title: 'Your position'
                    });
                    /*infoWindow.setPosition(pos);
                     infoWindow.setContent('Your position');
                     marker.addListener('click', function() {
                     infoWindow.open(map, marker);
                     });
                     infoWindow.open(map, marker);*/
                    map.setCenter(pos);


                    updateMarkerPosition(marker.getPosition());
                    geocodePosition(pos);

                    // Add dragging event listeners.
                    google.maps.event.addListener(marker, 'dragstart', function () {
                        updateMarkerAddress('Dragging...');
                    });

                    google.maps.event.addListener(marker, 'drag', function () {
                        updateMarkerStatus('Dragging...');
                        updateMarkerPosition(marker.getPosition());
                    });

                    google.maps.event.addListener(marker, 'dragend', function () {
                        updateMarkerStatus('Drag ended');
                        geocodePosition(marker.getPosition());
                        map.panTo(marker.getPosition());
                    });

                    google.maps.event.addListener(map, 'click', function (e) {
                        updateMarkerPosition(e.latLng);
                        geocodePosition(marker.getPosition());
                        marker.setPosition(e.latLng);
                        map.panTo(marker.getPosition());
                    });

                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function (responses) {
                if (responses && responses.length > 0) {

                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

        function updateMarkerStatus(str) {
            console.log(str);
        }

        function updateMarkerPosition(latLng) {
            var url = $('#base-url').val();
            var user_lat = latLng.lat();
            var user_lng = latLng.lng();
            $.post(url + '/site/setUserLocation', {latitude: user_lat, longitude: user_lng}, function (out) {
                if (out.result === 1) {
                    $('.btn_btn').text('Find Restaurant and Store in your Area');
                    $('.btn_btn').css('background', 'Red');
                    $('#set-address').attr("disabled", false);
                }
                if (out.result === 0) {
                    $('.btn_btn').text('Provide House number');
                    $('.btn_btn').css('background', '#bf6126');
                    $('#set-address').attr("disabled", true);
                }
            });
//            console.log([
//                latLng.lat(),
//                latLng.lng()
//            ].join(', '));
        }

        function updateMarkerAddress(str) {
            document.getElementById('address').value = str;
            var url = $('#base-url').val();
            $.post(url+'/site/setAddress',{address:str},function(){
                
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }


    </script>

<?php }
?>



<?php if($title=='Cart'|$title=='delivery'|$title=='Payment'){
?>
<script src="<?php echo base_url('public/js/cart.js'); ?>"></script>
<?php
}else{
?>
<script src="<?php echo base_url('public/js/ecommerce.js'); ?>"></script>
<?php
} ?>


<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script> 
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
<?php if (!empty($webcam)) {
    ?>
    <script>
        "use strict";

        function dragNdrop(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            var previewImg = document.getElementById("imgPrime");
            previewImg.setAttribute("src", fileName);
            preview.innerHTML = "";
            preview.appendChild(previewImg);
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }
    </script>
    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
    </script>
    <script language="JavaScript">
        function setup() {
            Webcam.reset();
            Webcam.attach('#my_camera');
        }
        function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap(function (data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                        '<h2>Here is your image:</h2>' +
                        '<img src="' + data_uri + '"/>';
            });
        }
    </script>


    <script type="text/javascript" src="<?php echo base_url('assets/js/webcam.min.js'); ?>"></script>

<?php }
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
// Set your publishable key
    Stripe.setPublishableKey('pk_test_vJ4le6Wr7z1Xz57l4QzJLBxz00ttl0Q6bf');

// Callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // Enable the submit button
            $('#payment_tbn').removeAttr("disabled");
            // Display the errors on the form
            $(".payment-status").html('<p>' + response.error.message + '</p>');
        } else {
            var form$ = $('#payment_form');
            // Get token id
            var token = response.id;
            // Insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // Submit form to the server
            form$.get(0).submit();
        }
    }
    
    $(document).ready(function () {
        $('#payment_form').validate({ // initialize the plugin
            rules: {
                card_holder: {
                    required: true,
                    minlength: 3
                },
                card_number: {
                    required: true,
                    minlength: 16
                    
                },
                month: {
                    required: true
                },
                year: {
                    required: true
                },
                card_code: {
                    required: true,
                    minlength: 3
                }
            }
        });
    });
    // On form submit
    $(document).on('submit', '#payment_form', function (evt) {
        evt.preventDefault();
        // Disable the submit button to prevent repeated clicks
        $('#payment_tbn').attr("disabled", "disabled");
        
//        var month = $('.carddropbtn1').children('span').text();
//        var year = $('.carddropbtn2').children('span').text();
        // Create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val(),
//            exp_month: month,
//            exp_year: year,
            cvc: $('#card_code').val()
        }, stripeResponseHandler);

        // Submit from callback
        return false;
    });
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

</body>

</html>