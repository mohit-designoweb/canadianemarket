var Event = function () {
    this.__construct = function () {
        this.addCategory();
        this.imageUpload();
        this.partnerForm();
        this.courierForm();
        this.pagination();
        this.getCity();
        /*  this.getGeoLocation(); */
        this.sameDivHeight();
        this.getRestaurantMenu();
        this.search();
        this.search_product();
        this.search_store_product();
        this.filteration();
        this.filteration_product();
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
        this.imageCommonForm();
        this.storeAddToCart();
        this.cashOnDelivery();
        this.restaurant_tips();
        this.userHistory();
        this.orderCancel();
        this.giftAddressType();
        this.rating();
        this.review();
        this.userSubscribe();
        this.storeProductWishlist();
        this.frontSearchData();
        this.setAddress();
        this.restaurantReorder();
        this.productReorder();
        this.orderReturn();
        this.getActiveStoreCount();
        this.updateForgotPassword();
        this.removeFromWishlist();
    };

    this.addCategory = function () {
        $(document).on('submit', '#registerForm, #myAccountForm,#gift-card-form,#rate_review, #review', function (evt) {
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
                    if (out.id == "") {
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                    } else {
                        $("#error_msg2").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg2").html(message + out.msg);
                        $("#error_msg2").fadeOut(2000);
                    }

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

        $(document).on('submit', '#forgotPasswordForm', function (evt) {
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
                    $("#regiter_email").parents(".form-group").append('<span class="error">' + out.errors + '</span>');
                    $("#regiter_email").focus();
                }
                if (out.result === 1) {
                    alert(out.msg);
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-success alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(9000);
                    //window.location.href = out.url;
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
    this.imageCommonForm = function () {
        $("#image-common-form").submit(function (evt) {
            evt.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (out) {
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
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        setTimeout(function () {
                            window.location.href = out.url;
                        });

                    }
                }
            });
        });
    };

    this.imageUpload = function () {
        $(document).on('change', '#FileUpload1,#image-common-form', function (e) {
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
        });

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

    this.getCity = function () {

        $(document).ready(function () {
            var country_id = $('#country').val();
            var url = $('#country').data('url');
            $.post(url, {country_id: country_id}, function (out) {
                if (out.result === 1) {
                    $('#city').html(out.content);
                }
            });
        });

        $(document).on('change', '#country', function (evt) {
            evt.preventDefault();
            var country_id = $(this).val();
            var url = $(this).data('url');
            $.post(url, {country_id: country_id}, function (out) {
                if (out.result === 1) {
                    $('#city').html(out.content);
                }
            });
        });

        $(document).on('change', '#city', function (evt) {
            evt.preventDefault();
            var city_id = $(this).val();
            var url = $('#city').data('url');
            url = url + '/' + city_id;
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });

        $(document).on('click', '#select-city', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    /*
     this.getGeoLocation = function () {
     //        $(document).ready(function () {
     //            if (navigator.geolocation) {
     //                navigator.geolocation.getCurrentPosition(showPosition);
     //            } else {
     //                alert("Geolocation is not supported by this browser.");
     //            }
     //            function showPosition(position) {
     //                var url = $('#base-url').val();
     //                var latitude = position.coords.latitude;
     //                var longitude = position.coords.longitude;
     //                $.post(url + '/site/setUserLocation', {latitude: latitude, longitude: longitude}, function () {});
     //            }
     //        });
     
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
     
     */

    this.sameDivHeight = function () {
        $(document).ready(function () {
            /*var heights = $(".p_items_content").map(function () {
             return $(this).height();
             }).get();
             maxHeight = Math.max.apply(null, heights);
             
             $(".p_items_content").height(maxHeight);*/

// 			var ccHeight = 1;
//             $('.exTab2').each(function () {
// 				var hegihtt = $(this).innerHeight();

// 				if (ccHeight < hegihtt) {
// 					ccHeight = hegihtt;
// 				}
//             });
//             // alert(ccHeight);
//             $('.exTab2').css('min-height', ccHeight);
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
                    obj.sameDivHeight();
                    var ccHeight = 1;
                    $('.exTab2').each(function () {
                        var hegihtt = $(this).innerHeight();

                        if (ccHeight < hegihtt) {
                            ccHeight = hegihtt;
                        }
                    });
                    // alert(ccHeight);
                    $('.exTab2').css('min-height', ccHeight);
                }
            });
        });

        $(document).on('click', '.common-menu', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $('.common-menu').removeClass('active');
            $(this).addClass('active');
            var total_store = $(this).children("span").html();
            $("#store_cnt").html(total_store);
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                    obj.sameDivHeight();
                    var ccHeight = 1;
                    $('.exTab2').each(function () {
                        var hegihtt = $(this).innerHeight();

                        if (ccHeight < hegihtt) {
                            ccHeight = hegihtt;
                        }
                    });
                    // alert(ccHeight);
                    $('.exTab2').css('min-height', ccHeight);
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
                    obj.sameDivHeight();

                }
            });

        });
    };
    this.search_product = function () {
        $(document).on('keyup', '#serach-product', function (evt) {
            evt.preventDefault();
            var val = $(this).val();
            var url = $('#market-place-product').data('url');
            $.post(url, {search_val: val}, function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                    obj.sameDivHeight();
                }
            });

        });
    };
    this.search_store_product = function () {
        $(document).on('keyup', '#search-store-product', function (evt) {
            evt.preventDefault();
            var val = $(this).val();
            var url = $('#search-store-product-url').data('url');
            //alert(url);
            $.post(url, {search_val: val}, function (out) {
                if (out.result === 1)
                {
                    $('#content-wrapper').html(out.content_wrapper);
                    obj.sameDivHeight();
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
                    obj.sameDivHeight();
                }
            });
        });
    };
    this.filteration_product = function () {
        $(document).on('click', '.filteration-product', function (evt) {
            evt.preventDefault();
            var val = $(this).data('val');
            var url = $('#market-place-product').data('url');
            $.post(url, {filter_val: val}, function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                    obj.sameDivHeight();
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
                     swal({
                        title: "Updated",
                        text: "Item Added To Cart!",
                        icon: "success",
                        button: "Ok",
                    });
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
                    swal({
                        title: "Updated",
                        text: "Item Remove From Cart!",
                        icon: "success",
                        button: "Ok",
                    });
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
            var search_val = $('#search_val').val();
            var url = $('#get-id-url').val();
            $.post(url, {cat: cat, type: type, location: location, search_val: search_val}, function (out) {
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
            var form = $(this);
            var url = $(this).attr("action");
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
        $(document).on('click', '.sku', function (evt) {
            var groupName = new Array();
            var product_id = $('#product_id').val();
            var url = $('#sku-url').val();
            $.each($('input:radio.sku:checked'), function () {
                groupName.push($(this).val());
            });
            $.post(url, {group_name: groupName, product_id: product_id}, function (out) {
                if (out.result === 1) {
                    $.post(out.url, '', function (out) {
                        if (out.result === 1) {
                            $('#product-detail-wrapper').html(out.content_wrapper);
                        }
                    });
                }
                if (out.result === -1) {
                    alert(out.msg);
                    location.reload();
                }
            });
        });
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
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    $("#error_msg").parent('.ship_head').append('<span class="error">' + out.msg + '</span>')
                }
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.storeAddToCart = function () {
        $(document).on('click', '.addCart_btn', function (evt) {
            evt.preventDefault();
            var id = $('#id').val();
            var qty = $('#qty').val();
            var price = $('#price').val();
            var name = $('#name').val();
            var module = $('#module').val();
            var url = $('#cart-url').val();
            $.post(url, {id: id, qty: qty, price: price, name: name, module: module}, function (out) {

                swal({
                    title: "Success",
                    text: "Product Added In Cart Sucessfully!",
                    icon: "success",
                    // button: "Ok",
                });
                setTimeout(function () {
                    location.reload();
                }, 2000);
            });

        });
    };

    this.cashOnDelivery = function () {
        $(document).on('click', '#cash_delivery', function () {
            var data = confirm('Are you sure order place cash on delivery ?.');
            if (data === true) {
                var url = $(this).data('url');
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        window.location.href = out.url;
                    }
                });
            }
        });
    }

    this.restaurant_tips = function () {
        $(document).on('click', '#apply-tip', function (evt) {
            evt.preventDefault();
            var tip = $("input[name='tip']:checked").val();
            var tip_value;
            var url = $(this).data('url');
            if (tip === 'tip_value') {
                tip_value = $('#tip_value').val();
                if (tip_value === '') {
                    alert('Please enter the tip value');
                    return 1;
                }
            }
            $.post(url, {tip: tip, tip_value: tip_value}, function (out) {
                if (out.result === 1) {
                    $('#order-wrapper').html(out.order_wrapper);
                }
            });

        });
    };

    this.userHistory = function () {
        $("#order_histroy").ready(function () {

            var url = '';
            if ($('.user_history').hasClass('active')) {
                url = $('.user_history').attr('href');
            }

            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#history-wrapper').html(out.content_wrapper);
                }
            });
        });

        $(document).on('click', '.user_history', function (evt) {
            evt.preventDefault();
            $('.user_history').removeClass('active');
            var url = $(this).attr('href');
            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#history-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.orderCancel = function () {
        $(document).on('click', '.order_cancel', function (evt) {
            evt.preventDefault();
            var data = confirm('Are you sure cancel your order .?.');
            if (data === true) {
                var url = $(this).attr('href');
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        alert(out.msg);
                        obj.userHistory();
                    }
                });
            }
        });
    };

    this.giftAddressType = function () {
        $("#email_address").ready(function () {
            $("#receiver_address").hide();
            $("#emailid").show();
        });
        $(document).on('click', '#shipping_address', function () {
            $("#emailid").hide();
            $("#receiver_address").show();
        });
        $(document).on('click', '#email_address', function () {
            $("#receiver_address").hide();
            $("#emailid").show();
        });
    };

    this.rating = function () {
        $(document).on("click", "#rate_review", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                $("#review_main_form").html(res.content_wrapper);
            });
        });
    };

    this.review = function () {
        $(document).on("click", "#restaurant_review", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                $("#resto_review").html(res.content_wrapper);
            });
        });
    };

    this.userSubscribe = function () {
        $(document).on('click', '#user-subscribe', function (evt) {
            evt.preventDefault();
            var postdata = $('#subscribe').val();
            var url = $(this).attr('href');

            $.post(url, {postdata: postdata}, function (out) {
                if (out.result === 0)
                {
                    for (var i in out.errors) {
                        $('#error_show').html(out.errors[i]).css('color', 'red');
                        //$("#" + i).parents(".input_group").append('<span class="error">' + out.errors[i] + '</span>');
                    }

                } else if (out.result === -1) {
                    $('#error_show').html(out.msg).css('color', 'red');
                } else if (out.result === 1)
                {
                    $('#error_show').hide();
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    $("#error_msg").fadeOut(5000);
                    $('#subscribe').val('');

                }
            });

        });
    };

    this.storeProductWishlist = function () {
        $(document).on('click', '.product-wishlist-heart', function (evt) {
            evt.preventDefault();
            if ($(this).children('i').hasClass('wishlist-color')) {
                $(this).children('i').removeClass('wishlist-color');
            } else {
                $(this).children('i').addClass('wishlist-color');
            }
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    alert(out.msg);
                    //location.reload();
                }
            });
        });
    };



    this.frontSearchData = function () {
        $(document).ready(function () {
            $('#search').keyup(function () {
                var url = $(this).attr("data-url");
                var postdata = $(this).val();
                $.post(url, {postdata: postdata}, function (out) {
                    if (out.result === 1) {
                        $('.searchresults').slideDown();
                        $("#search_founds").html(out.search_wrapper);
                    }
                    if (out.result === -1) {
                        $('.searchresults').slideUp();
                    }
                });
            });
        });
    };

    this.setAddress = function () {
        $(document).on('click', '#set-address', function (evt) {
            evt.preventDefault();
            var url = $(this).data('url');
            var address = $('#address').val();
            $.post(url, {address: address}, function (out) {
                if (out.result === 1) {
                    $('.btn_btn').text('Provide House number');
                    $('.btn_btn').css('background', '#bf6126');
                    $('#set-address').attr("disabled", true);
                    window.location.href = out.url;
                }

            });
        });
    };

    this.restaurantReorder = function () {
        $(document).on("click", ".store_product_reorder", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                $("#product_reorders").html(res.content_wrapper);
            });
        });
    };

    this.productReorder = function () {
        $(document).on("click", ".restaurant_reorder", function () {
            var url = $(this).data('url');

            $.post(url, '', function (res) {
                $("#restaurant_reorders").html(res.content_wrapper);
            });
        });
    };

    this.frontSearchData = function () {
        $(document).ready(function () {
            $('#search').keyup(function () {
                var url = $(this).attr("data-url");
                var postdata = $(this).val();
                $.post(url, {postdata: postdata}, function (out) {
                    if (out.result === 1) {
                        $('.searchresults').slideDown();
                        $("#search_founds").html(out.search_wrapper);
                    }
                    if (out.result === -1) {
                        $('.searchresults').slideUp();
                    }
                });
            });
        });
    };

    this.orderReturn = function () {
        $(document).on('click', '.return_item', function (evt) {
            evt.preventDefault();
            var data = confirm('Are you sure return this item . ?');
            if (data == true)
            {
                var url = $(this).attr('href');
                //alert(url);
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        alert(out.msg);

                        window.location.href = out.url;
                    }
                });
            }
        });
    }

    this.getActiveStoreCount = function () {
        $(document).ready(function () {
            var total_store = $(".pro_drop_menu").children('.active').children("span").html();
            $("#store_cnt").html(total_store);
        });
    };


    this.updateForgotPassword = function () {
        $(document).on('submit', '#update-forgot-password', function (e) {
            e.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            alert(url);
            //alert(postdata);

            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    //alert(out.result);
                    for (var i in out.errors) {
                        alert(out.msg);
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    alert(out.msg);
                    $("#error_msg,#error_msg_forgot_password").html(out.errors).css('color', 'red');
                    $("#email").focus();
                }
                if (out.result === 1) {
                    alert(out.msg);
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg,#error_msg_forgot_password").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg,#error_msg_forgot_password").html(message + out.msg);
                    $("#error_msg,#error_msg_forgot_password").fadeOut(9000);
                    //window.location.href = out.url;
                }
            });

        });
    };
    this.removeFromWishlist = function ()
    {
        $(document).on('click', '.removeWishlist', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            $.post(url, '', function (out) {
                if (out.result === 1)
                {
                    location.reload();
                }
            });
        });
    };

    this.__construct();
};
var obj = new Event();