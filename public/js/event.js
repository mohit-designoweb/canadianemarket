var Event = function () {
    this.__construct = function () {
        this.loader();
        this.tooltip();
        this.commonForm();
        this.imageCommonForm();
        this.imageCommonForm1();
        this.contentWrapper();
        this.changeStatus();
        this.changeState();
        this.changeCity();
        this.changeLanguage();
		this.changeStatusOpenOrClose();
        this.delete();
        this.jobtype();
		this.getGeoLocation();
		this.deleteImage();
        this.addRow();
        this.deleteRow();
		this.courierWrapper();
        this.doUpdateOrderStatus();
        this.getCourierList();
        this.doAllotOrder();
        this.waitForCourier();
        this.courierNotification();
        this.courierAgentWrapper();
        this.outForDelivery();
        this.itemRecieved();
        this.changeCourierStatus();
		this.commonFormPassword();
		this.getLiveTracking();
		this.forgotPassword();
		this.updateForgotPassword();
    };
    
    this.loader=function(){
        $(document).ready(function(){
             $(".loader").fadeOut("slow");
        });
    };

    this.tooltip = function () {
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    };

    this.commonForm = function () {
        $(document).on('submit', '#common-form', function (evt) {
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".loader").fadeOut("slow");
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                }
                if (out.result === 1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 1000);
                }
            });
        });
    };

    this.imageCommonForm = function () {
        $("#image-common-form").submit(function (evt) {
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (out) {
                    $(".loader").fadeOut("slow");
                    $(".form-group > .error").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                            $("#" + i).focus();
                        }
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === 1) {
                        window.location.href = out.url;
                    }
                }
            });
        });
    };

 this.imageCommonForm1 = function () {
        $("#image-common-form1").submit(function (evt) {
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function (out) {
                    $(".loader").fadeOut("slow");
                    $(".form-group > .error").remove();
                    if (out.result === 0) {
                            $("#userfile").after('<span class="error" style="position: absolute;">' + out.errors + '</span>');
                     }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === 1) {
                        window.location.href = out.url;
                    }
                }
            });
        });
    };
    this.contentWrapper = function () {
        $(document).ready(function () {
            var url = $('#content-wrapper').data('url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                    $('#example').DataTable({
                        responsive: true,
                        destroy: true
                    });
                }
            });
        });
    };

    this.changeStatus = function () {
        $(document).on('click', '.change-status', function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.post(url, function (out) {
                if (out.result === 1) {
                    obj.contentWrapper();
                }
            });
        });
    };
	
	this.changeStatusOpenOrClose = function () {
        $(document).on('click', '.cstm-switch-input', function (e) {
            e.preventDefault();
            var url = $(this).attr("value");
            //alert(url);
            $.post(url, function (out) {
            
                if (out.result === 1) {
                    obj.contentWrapper();
                }
            });
        });
    };

    this.changeState = function () {
        $(document).on('change', '#country_id', function () {
            var country_id = $(this).val();
            var url = $(this).data('url');
            $.post(url, {country_id: country_id}, function (res) {
                $("#state_id").html(res);
                $("#city_id").html("<option>Select the City</option>");
            });
        });
    };

    this.changeCity = function () {
        $(document).on('change', '#state_id', function () {
            var state_id = $(this).val();
            var url = $(this).data('url');
            $.post(url, {state_id: state_id}, function (res) {
                $("#city_id").html(res);
            });
        });
    };

    this.changeLanguage = function () {
        $(document).on('click', '.anc_lang', function (e) {
            e.preventDefault();
            var val = $(this).attr("value");
            var url = $(this).attr("href");
            $.post(url, {lang: val}, function () {
                location.reload();
            });
        });
    };
    
    this.delete=function(){
      $(document).on('click','.delete',function(e){
          e.preventDefault();
          var url = $(this).attr("href");
          var result = confirm("Are you sure, you want to delete?");
          if(result==true)
          {
              $.post(url,'',function(out){
                 window.location.href = out.url;
             });
          }
      });  
    };
    
    this.jobtype=function(){
        $(document).on('change','#job_category_id',function(e){
            e.preventDefault();
            var val = $(this).val();
            var url = $(this).data('url');
           // alert(url);
            $.post(url,{val:val},function(out){
                $("#job_type_id").html(out.content_wrapper);
            }); 
        });
    };
	
	this.getGeoLocation = function () {
        $(document).ready(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            function showPosition(position) {
                var url = $('#base-url').val();
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post(url + '/site/setUserLocation', {latitude: latitude, longitude: longitude}, function () {
                    // location.reload();
                });
            }

        });
    };
	this.deleteImage = function () {
        $(document).on('click', '.delete-image', function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            var result = confirm("Are You Sure, You Want To Delete");
            if (result === true) {
                $.post(url, '', function () {
                    obj.contentWrapper();
                });
            }
        });
    };

    this.addRow = function () {
        $(document).on('click', '.corner_clone_add', function (evt) {
            evt.preventDefault();
            var $tr = $('.corner_clone:last');
            var $clone = $tr.clone(true);
            $clone.find('#specification').val('');
            $clone.find('.col-md-1').html('<span><a href="#" class="remove_corner"><i class="fa fa-minus-square"></i></a></span>');
            $('.corner_row').before($clone);
        });
    };

    this.deleteRow = function () {
        $(document).on('click', '.remove_corner', function (evt) {
            evt.preventDefault();
            var $tr = $(this).closest('.corner_clone');
            $tr.remove();
            var url = $(this).attr('href');
            if (url !== '') {
                $.post(url, '', function () {});
            }

        });
    };
	this.doUpdateOrderStatus = function () {
        $(document).on('change', '#status', function (evt) {
            evt.preventDefault();
            var selectedValue = $(this).val();
            var url = $(this).attr('data-url');
            $.post(url, {status: selectedValue}, function (out) {
                window.location.href = out.url;

            });

        });
    };
   
    this.getGeoLocation = function () {

        $(document).on('click', '#start-service', function () {
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            function showPosition(position) {
                var url = $('#base-url1').val();
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post(url + '/courier/setCourierLocation', {latitude: latitude, longitude: longitude}, function () {
//                    location.reload();
                });
            }
        });

        $(document).on('click', '#get-location', function () {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            function showPosition(position) {
                var url = $('#base-url1').val();
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post(url + '/courier/setCourierLocation', {latitude: latitude, longitude: longitude}, function () {
                    location.reload();
                });
            }

        });
    };
    
	this.commonFormPassword = function(){
        $(document).on('submit','#common-form-password', function(evt){
           evt.preventDefault();
           $(".loader").fadeIn("slow");
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            
            $.post(url, postdata, function (out) {
                $(".loader").fadeOut("slow");
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                }
                if (out.result === 1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 1000);
                }
            });
            
        });
    }
	 this.courierWrapper = function () {
        $(document).ready(function () {
            var url = $('#courier-wrapper').attr('data-url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-wrapper').html(out.courier_wrapper);
                }
            });
        });
    };

    this.doUpdateOrderStatus = function () {
        $(document).on('change', '#status', function (evt) {
            evt.preventDefault();
            var status = $(this).val();
            var url = $(this).attr('data-url');
            $.post(url, {status: status}, function (out) {
                if (out.result === 1) {
                    $('#courier-wrapper').html(out.courier_wrapper);
                }
            });
        });
    };

    this.getCourierList = function () {
        $(document).on('click', '#refresh-courier', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-wrapper').html(out.courier_wrapper);
                }
            });
        });
    };


    this.doAllotOrder = function () {
        $(document).on('change', '#courier_id', function (evt) {
            evt.preventDefault();
            var url = $(this).data('url');
            var courier_id = $(this).val();
            $.post(url, {courier_id: courier_id}, function (out) {
                if (out.result === -1) {
                    $('#courier_id').val('');
                    $('#courier_id').parents('.col-6').append('<span class="error">' + out.msg + '</span>');
                }
                if (out.result === 1) {
                    $('#courier-wrapper').html(out.courier_wrapper);
                    obj.waitForCourier();
                }
            });
        });
    };

    this.waitForCourier = function () {
        $(document).ready(function () {
            var interval = setInterval(function () {
                var url = $('#courier-confirmation').data('url');
                if (url !== 'undefined') {
                    $.post(url, '', function (out) {
                        if (out.result === -1) {
                            $('#courier-wrapper').html(out.courier_wrapper);
                            clearInterval(interval);
                        }
                        if (out.result === 1) {
                            $('#courier-wrapper').html(out.courier_wrapper);
                            clearInterval(interval);
                        }
                    });
                }
            }, 3000);
        });
    };

    this.courierNotification = function () {
        $(document).ready(function () {
            var interval = setInterval(function () {
                var url = $('#notification-wrapper').data('url');
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        $('#notification-wrapper').html(out.notification_wrapper);
                        $('#notification-icon').after('<span class="notification-counter"></span>');
//                        clearInterval(interval);
                    }
                });
            }, 3000);
        });
    };

    this.courierAgentWrapper = function () {
        $(document).ready(function () {
            var url = $('#courier-order-wrapper').attr('data-url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-order-wrapper').html(out.courier_order_wrapper);
                }
            });
        });
    };

    this.changeCourierStatus = function () {
        $(document).on('click', '.change-courier-status', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-order-wrapper').html(out.courier_order_wrapper);
                    obj.checkForAcceptOrder();
                }
                if (out.result === -1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.checkForAcceptOrder = function () {
        var acceptInterval = setInterval(function () {
            var url = $('#courier-waiting').data('url');
//            alert(url);
            if (url !== 'undefined') {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        $('#courier-order-wrapper').html(out.courier_order_wrapper);
                        clearInterval(acceptInterval);
                    }
                });
            }
        }, 3000);
    };

    this.outForDelivery = function () {
        $(document).on('click', '#out-for-delivery', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-wrapper').html(out.courier_wrapper);
                }
            });
        });
    };

    this.itemRecieved = function () {
        $(document).on('click', '#item-recieved', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#courier-order-wrapper').html(out.courier_order_wrapper);
                }
            });
        });
    };
	 this.getLiveTracking = function () {
        $(document).on('click', '#accept-order', function () {
            var courier_lat = '';
            var courier_lng = '';
            var user_lat = $('#user_lat').val();
            var user_lng = $('#user_lng').val();
            alert(user_lat);
            alert(user_lng);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
            function showPosition(position) {
                var url = $('#base-url1').val();
                courier_lat = position.coords.latitude;
                courier_lng = position.coords.longitude;
                $.post(url + '/courier/setCourierLocation', {latitude: courier_lat, longitude: courier_lng}, function () {
                    var markers = [
                        {
                            "title": 'User Point',
                            "lat": user_lat,
                            "lng": user_lng,
                            "description": 'User Address'
                        }
                        ,
                        {
                            "title": 'Courier Point',
                            "lat": courier_lat,
                            "lng": courier_lng,
                            "description": 'Courier Live Location Point'
                        }

                    ];


                    var mapOptions = {
                        center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                        zoom: 18,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
                    var infoWindow = new google.maps.InfoWindow();
                    var lat_lng = new Array();
                    var latlngbounds = new google.maps.LatLngBounds();
                    for (i = 0; i < markers.length; i++) {
                        var data = markers[i];
                        var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                        lat_lng.push(myLatlng);
                        var marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            title: data.title
                        });
                        latlngbounds.extend(marker.position);
                        (function (marker, data) {
                            google.maps.event.addListener(marker, "click", function (e) {
                                infoWindow.setContent(data.description);
                                infoWindow.open(map, marker);
                            });
                        })(marker, data);
                    }
                    map.setCenter(latlngbounds.getCenter());
                    map.fitBounds(latlngbounds);

                    //***********ROUTING****************//

                    //Initialize the Path Array
                    var path = new google.maps.MVCArray();

                    //Initialize the Direction Service
                    var service = new google.maps.DirectionsService();

                    //Set the Path Stroke Color
                    var poly = new google.maps.Polyline({map: map, strokeColor: '#4986E7'});

                    //Loop and Draw Path Route between the Points on MAP
                    for (var i = 0; i < lat_lng.length; i++) {
                        if ((i + 1) < lat_lng.length) {
                            var src = lat_lng[i];
                            var des = lat_lng[i + 1];
                            path.push(src);
                            poly.setPath(path);
                            service.route({
                                origin: src,
                                destination: des,
                                travelMode: google.maps.DirectionsTravelMode.DRIVING
                            }, function (result, status) {
                                if (status == google.maps.DirectionsStatus.OK) {
                                    for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                                        path.push(result.routes[0].overview_path[i]);
                                    }
                                }
                            });
                        }
                    }
                    //location.reload();
                });


            }
        });
        
        $(document).ready(function () {
            var user_lat = $('#user_lat').val();
            var user_lng = $('#user_lng').val();
            var courier_lat = $('#courier_lat').val();
            var courier_lng = $('#courier_lng').val();
            var markers = [
                {
                    "title": 'User Point',
                    "lat": user_lat,
                    "lng": user_lng,
                    "description": 'user Address'
                }
                ,
                {
                    "title": 'Courier Point',
                    "lat": courier_lat,
                    "lng": courier_lng,
                    "description": 'Courier Live Location Point'
                }

            ];


            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var infoWindow = new google.maps.InfoWindow();
            var lat_lng = new Array();
            var latlngbounds = new google.maps.LatLngBounds();
            for (i = 0; i < markers.length; i++) {
                var data = markers[i];
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                lat_lng.push(myLatlng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: data.title
                });
                latlngbounds.extend(marker.position);
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent(data.description);
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);

            //***********ROUTING****************//

            //Initialize the Path Array
            var path = new google.maps.MVCArray();

            //Initialize the Direction Service
            var service = new google.maps.DirectionsService();

            //Set the Path Stroke Color
            var poly = new google.maps.Polyline({map: map, strokeColor: '#4986E7'});

            //Loop and Draw Path Route between the Points on MAP
            for (var i = 0; i < lat_lng.length; i++) {
                if ((i + 1) < lat_lng.length) {
                    var src = lat_lng[i];
                    var des = lat_lng[i + 1];
                    path.push(src);
                    poly.setPath(path);
                    service.route({
                        origin: src,
                        destination: des,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                                path.push(result.routes[0].overview_path[i]);
                            }
                        }
                    });
                }
            }
        },2000);
	 };
	 
	 this.forgotPassword = function(){
        
        $(document).on('submit','#common-form-forgot-password' , function(e){
            e.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
           
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                  
                    $("#error_msg").html(out.errors).css('color','red');
                    $("#email").focus();
                }
                if (out.result === 1) {
                    //alert(out.msg);
					 //$("#error_msg").html(out.msg).css('color','red');
					var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-success alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(9000);
					 
                    //window.location.href = out.url;
                }
            });
            
        });
    }
	
	this.updateForgotPassword = function(){
        $(document).on('submit','#update-forgot-password', function(e) {
             e.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            //alert(url);
            //alert(postdata);
            
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    //alert(out.result);
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    //alert(out.errors);
                    $("#error_msg").html(out.errors).css('color','red');
                    $("#email").focus();
                }
                if (out.result === 1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
					$("#error_msg").fadeOut(9000);
                    window.location.href = out.url;
                }
            });
            
        });
    }

	 
	 
    
    this.__construct();
};
var obj = new Event();