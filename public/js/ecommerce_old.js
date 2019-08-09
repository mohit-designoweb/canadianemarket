var Event = function () {
    this.__construct = function () {
        this.addCategory();
        this.imageUpload();
        this.partnerForm();
        this.courierForm();
        this.pagination();
        this.getGeoLocation();
        this.getRestaurantMenu();
        this.search();
        this.filteration();
        this.addToCart();
        this.removeFromCart();
        this.orderWrapper();
        this.specialMenuWrapper();
        this.applyCoupon();
        this.removeCoupon();
        this.siteContent();
        this.jobtype();
        this.filteredJob();
        this.contentWrapper();
        this.userWrapper();
        this.fileUploadOnDrop();
        this.profilepicUpload();
		this.checkEMarket();
        this.deliveryType();
        this.restaurantCheckOut();
        this.sku();
        this.doAddShippingAddress();
    };

    this.addCategory = function () {
        $(document).on('submit', '#registerForm, #myAccountForm,#forgotPasswordForm,#gift-card-form', function (evt) {
            evt.preventDefault();
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
            });
        });

        $(document).on('submit', '#loginForm', function (evt) {
            evt.preventDefault();
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
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg1").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg1").html(message + out.msg);
                    $("#error_msg1").fadeOut(2000);
                    if (out.url) {
                        window.location.href = out.url;
                    }
                }
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });

        $(document).on('submit', '#otpForm', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    $("#otp").parents(".form-group").append('<span class="error text-danger">' + out.msg + '</span>');
                    $("#otp").focus();
                }
                if (out.result === 1) {
                    //alert(out.url);
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                    setTimeout(function () {
                        window.location.href = out.url;
                    }, 2000);

                }
            });
        });

        $(document).on('submit', '#courierOtpForm', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        // alert(out.errors[i]);
                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    $("#courireOtp").parents(".form-group").append('<span class="error text-danger">' + out.msg + '</span>');
                    $("#courireOtp").focus();
                }
                if (out.result === 1) {
                    //alert(out.url);
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#courier_error_msg").removeClass('alert-warning alert-success').addClass('alert alert-success alert-dismissable').show();
                    $("#courier_error_msg").html(message + out.msg);
                    $("#courier_error_msg").fadeOut(2000);
                    setTimeout(function () {
                        window.location.href = out.url;
                    }, 2000);

                }
            });
        });
    };

    this.imageUpload = function () {
        $(document).on('change', '#FileUpload1', function (e) {
            e.preventDefault();
            var file_data = $('#FileUpload1').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: $(this).attr("data-url"),
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (out) {
                    $("#error_msg").remove();

                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#" + res).parent("div").parent("div").append('<p id="error_msg"></p>');
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                    }
                    if (out.result === 1) {
                        window.location.href = out.url;
                    }
                }
            });
        })

        $(document).on('click', '#imgFileUpload', function (evt) {
            evt.preventDefault();
            var fileupload = $("#FileUpload1");
            var url = $('#imgForm').attr('action');
            fileupload.click();
            var image = $("#FileUpload1");
        });
    };

    this.partnerForm = function () {
        $(document).on('submit', '#partnerForm', function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                }
                if (out.result === 1) {
                    $('#mobileOTP').modal('show');

                }
            });
        });
    };

    this.courierForm = function () {
        $(document).on('submit', '#courierForm', function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(2000);
                }
                if (out.result === 1) {
                    $('#courierOTP').modal('show');
                }
            });
        });
    };

    this.pagination = function () {
        $(document).on('click', '.pagination-link a', function (evt) {
            evt.preventDefault();

            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
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
                var url = $('#base-url').val();
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post(url + '/site/setUserLocation', {latitude: latitude, longitude: longitude}, function () {
                    location.reload();
                });
            }

        });
    };

    this.getRestaurantMenu = function () {
        $(document).ready(function () {
            var url;
            if ($('.common-menu').hasClass('active')) {
                url = $('.common-menu').attr('href');
            }
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });

        $(document).on('click', '.common-menu', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.search = function () {
        $(document).on('keyup', '#search', function (evt) {
            evt.preventDefault();
            var val = $(this).val();
            var url = $('#restaurant-category').data('url');
            $.post(url, {search_val: val}, function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });

        });
    };

    this.filteration = function () {
        $(document).on('click', '.filteration', function (evt) {
            evt.preventDefault();
            var val = $(this).data('val');
            var url = $('#restaurant-category').data('url');
            $.post(url, {filter_val: val}, function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.addToCart = function () {
        $(document).on('submit', '.add-to-cart', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                if (out.result === 1) {
                    obj.getRestaurantMenu();
                    obj.specialMenuWrapper();
                    obj.orderWrapper();
                }
            });
        });
    };

    this.removeFromCart = function () {
        $(document).on('click', '.removeitem', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    obj.getRestaurantMenu();
                    obj.specialMenuWrapper();
                    obj.orderWrapper();
                }
            });
        });
    };

    this.orderWrapper = function () {
        $(document).ready(function () {
            var url = $('#order-wrapper').data('url');
            var restaurant_id = $('#restaurant_id').val();
            $.post(url, {restaurant_id: restaurant_id}, function (out) {
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
                }
            });
        });
    };

    this.specialMenuWrapper = function () {
        $(document).ready(function () {
            var url = $('#special-menu-wrapper').data('url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#special-menu-wrapper').html(out.special_menu_wrapper);
                }
            });
        });
    };

    this.applyCoupon = function () {
        $(document).on('click', '#apply-coupon', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            var coupon = $('#coupon').val();
            var restaurant_id = $('#restaurant_id').val();
            $.post(url, {coupon: coupon, restaurant_id: restaurant_id}, function (out) {
                $(".couponbox > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents('.apply_coupons').parents('.couponbox').append('<span class="error">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    $("#coupon").parent('.apply_coupons').parents('.couponbox').append('<span class="error">' + out.msg + '</span>')
                }
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
//                    var url = $('#base_url').val();
//                    var html = '<a href="' + url + '/restaurant/remove-coupon" id="remove-coupon">Remove Coupon</a>';
//                    $("#coupon").parents('.apply_coupons').parents('.couponbox').append(html);
                }
            });
        });
    };

    this.removeCoupon = function () {
        $(document).on('click', '#remove-coupon', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            var restaurant_id = $('#restaurant_id').val();
            $.post(url, {restaurant_id: restaurant_id}, function (out) {
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
                }
            });
        });
    };

    this.siteContent = function () {
        $(document).ready(function () {
            var url = '';
            var id = '';
            if ($('.site-content').hasClass('active')) {
                url = $('.site-content').attr('href');
                id = $('.site-content').data('url');
            }
            $.post(url, {cat_id: id}, function (out) {
                $("#help-content-wrapper").html(out.content_wrapper);
            });
        });

        $(document).on("click", ".site-content", function (e) {
            e.preventDefault();
            $('.site-content').removeClass('active');
            $(this).addClass('active');
            var id = $(this).attr('data-url');
            var url = $(this).attr('href');
            $.post(url, {cat_id: id}, function (out) {
//               alert(out);
                $("#help-content-wrapper").html(out.content_wrapper);
            });
        });
    };


    this.jobtype = function () {
        $(document).on('click', ".job_category", function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                $("#career_job_type").html(out.content_wrapper);
            });
        });
        $(document).on('click', '.job_type', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                $("#career_job_location").html(out.content_wrapper);
            });
        });
    };

    this.filteredJob = function () {
        $(document).on('click', '.searchbtn', function (e) {
            e.preventDefault();
            var cat = $("#cat").text();
            var type = $('#type').text();
            var location = $('#location').html();
            var url = $('#get-id-url').val();
            $.post(url, {cat: cat, type: type, location: location}, function (out) {
                $('#job-after-filter').html(out.content_wrapper);
            });
        });
    };
    
    this.contentWrapper = function () {
        $(document).ready(function () {
            var url = $('#product-detail-wrapper').data('url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#product-detail-wrapper').html(out.content_wrapper);
                }
            });
        });
    };
    
    this.userWrapper = function () {
        $(document).ready(function () {
            var url = '';
            if ($('.user-account').hasClass('active')) {
                url = $('.user-account').attr('href');
            }
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
        $(document).on('click', '.user-account,.editimg', function (evt) {
            evt.preventDefault();
            $('.user-account').removeClass('active');
            var url = $(this).attr('href');
            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.fileUploadOnDrop = function () {
        $(document).on('change', '#uploadFile', function (evt) {
            evt.preventDefault();
            var url = $(this).data('url'); 
            var data = new FormData($('#imgForm')[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (out) {
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
//            var fileName = URL.createObjectURL(event.target.files[0]);
//            var preview = document.getElementById("preview");
//            var previewImg = document.getElementById("imgPrime");
//            previewImg.setAttribute("src", fileName);
//            preview.innerHTML = "";
//            preview.appendChild(previewImg);;
        });
    };

    this.profilepicUpload = function () {
        $(document).on('change', '.slidehover', function () {
            alert("hii");
            var form = $(this);
            var url = $(this).attr("action");
            alert(url);
            alert(form);
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (out) {
                    alert(out);
                }
            });
        });
    };
	
	this.checkEMarket = function () {
        $(document).on('click', '#emarket-point', function () {

            var url = $(this).data('url');
            if ($(this).prop("checked") === true) {
                check = 1;
            } else if ($(this).prop("checked") === false) {
                check = 0;
            }
            $.post(url, {check: check}, function (out) {
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
                }
            });
        });
    };

    this.deliveryType = function () {
        $(document).on('change', '.tick_input', function () {
            var delivery_type = $(this).val();
            var url = $(this).data('url');
            $.post(url, {delivery_type: delivery_type}, function (out) {
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
                }
            });
        });
    };

    this.restaurantCheckOut = function () {
        $(document).on('submit', '#do-add-billing', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.sku = function () {
//        $(document).on('change','.sku',function(evt){
//            alert($(this).val());
//        });
    };


    this.doAddShippingAddress = function () {
        $(document).on('submit', '#shipping_form', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === -1) {
//                      alert(out.msg);
                    $("#error_msg").parent('.ship_head').append('<span class="error">' + out.msg + '</span>')
                }
                if (out.result === 1) {
//                    alert(out.url);
                    window.location.href = out.url;
                }
            });
        });
    };
    
    this.__construct();
};
var obj = new Event();