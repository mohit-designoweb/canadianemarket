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
        this.storeWrapper();
        this.deliveryCharge();
        this.editProductWrapper();
        this.productFileUploadForm();
        this.restaurantWrapper();
        this.bulkAction();
        this.editMenuWrapper();
        this.storeWrapperCommonForm();
        this.storeWrapperImageCommonForm();
        this.restaurantWrapperCommonForm();
        this.restaurantWrapperImageCommonForm();
        this.storeOrderWrapper();
    };

    this.loader = function () {
        $(document).ready(function () {
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
            var cls = $(this).children("i").attr("class");

            if (cls == "fe fe-thumbs-down") {
                $(this).html("Active <i class='fe fe-thumbs-up'></i>");
                if ($(this).parent("td").prev("td").html() == "Inactive") {
                    $(this).parent("td").prev("td").html("Active");
                }
            } else {
                $(this).html("Inactive <i class='fe fe-thumbs-down'></i>");
                if ($(this).parent("td").prev("td").html() == "Active") {
                    $(this).parent("td").prev("td").html("Inactive");
                }
            }
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

    this.delete = function () {
        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            var result = confirm("Are you sure, you want to delete?");
            if (result == true)
            {
                $.post(url, '', function (out) {
                    window.location.href = out.url;
                });
            }
        });
    };

    this.jobtype = function () {
        $(document).on('change', '#job_category_id', function (e) {
            e.preventDefault();
            var val = $(this).val();
            var url = $(this).data('url');
            // alert(url);
            $.post(url, {val: val}, function (out) {
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

    this.commonFormPassword = function () {
        $(document).on('submit', '#common-form-password', function (evt) {
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
        $(document).on('click', '#path', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var address = $(this).text();
            var latitude;
            var longitude;
            $(document).ready(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
                function showPosition(position) {
                    // var url = $('#base-url').val();
                    latitude = position.coords.latitude;
                    longitude = position.coords.longitude;
                    $.post(url, {address: address, lat: latitude, long: longitude}, function (res) {
                        //alert(res.url);
                        window.open(res.url, '_blank');
                    });
                }
            });
        });
    };

    this.forgotPassword = function () {

        $(document).on('submit', '#common-form-forgot-password', function (e) {
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

                    $("#error_msg").html(out.errors).css('color', 'red');
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

    this.updateForgotPassword = function () {
        $(document).on('submit', '#update-forgot-password', function (e) {
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
                    $("#error_msg").html(out.errors).css('color', 'red');
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

    };
    this.address = function ()
    {
        $(document).on("click", "#address-detail", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                if (res.result == 1) {
                    $("#address-div").html(res.content_wrapper);
                }
            });
        });
    };
    this.restaurantAddress = function ()
    {
        $(document).on("click", "#rest-address-detail", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                if (res.result == 1) {
                    $("#res-address-div").html(res.content_wrapper);
                }
            });
        });
    };
    this.userAddress = function ()
    {
        $(document).on("click", "#user-add-detail", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                if (res.result == 1) {
                    $("#user-address-div").html(res.content_wrapper);
                }
            });
        });
    };
    this.updateOrderStatus = function ()
    {
        $(document).on("click", "#update-order-status", function () {
            var url = $(this).data('url');
            $.post(url, '', function (res) {
                if (res.result === 1) {
                    window.location.href = res.url;
                }
            });
        });
    };


    this.storeWrapper = function () {
        $(document).ready(function () {
            var url = '';
            if ($('.storetabs').hasClass('active')) {
                url = $('.storetabs').attr('href');
            }


            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#store-wrapper').html(out.store_content_wrapper);
                }
            });
        });
        $(document).on('click', '.storetabs', function (evt) {
            evt.preventDefault();
            $('.storetabs').removeClass('active');
            var url = $(this).attr('href');
            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#store-wrapper').html(out.store_content_wrapper);
                    $('#example').DataTable({
                        responsive: true,
                        destroy: true
                    });
                }
            });
        });

        $(document).on('click', '.storetabs-edit', function (evt) {
            evt.preventDefault();
//            $('.storetabs').removeClass('active');
            var url = $(this).attr('href');
//            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#store-wrapper').html(out.store_content_wrapper);
                    $('#example').DataTable({
                        responsive: true,
                        destroy: true
                    });
                }
            });
        });

    };

    this.deliveryCharge = function () {
        $("#off").ready(function () {
            $("#chargeapply").hide();
        });
        $(document).on('click', '#on', function () {
            $("#chargeapply").show();
        });
        $(document).on('click', '#off', function () {
            $("#chargeapply").hide();
            $("#custombox").hide();
        });
        $("#default").ready(function () {
            $("#custombox").hide();
        });
        $(document).on('click', '#custom', function () {
            $("#custombox").show();
        });
        $(document).on('click', '#default', function () {
            $("#custombox").hide();
        });
    };

    this.editProductWrapper = function () {

        $(document).on('click', '.editProduct', function (evt) {
            $('#myModal').modal('show');
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#edit_product_wrapper').html(out.edit_product_wrapper);
                }
            });
        });
    }

    this.productFileUploadForm = function () {
        $(document).on('submit', '#file-import-form', function (evt) {
            evt.preventDefault();

            $(".loader").fadeIn("slow");
            alert($(this).attr("action"));
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
                            $("#error_msgs").append('<span class="error">' + out.errors[i] + '</span>');
//                            $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
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

    this.restaurantWrapper = function () {
        $(document).ready(function () {
            var url = '';
            if ($('.restauranttabs').hasClass('active')) {
                url = $('.restauranttabs').attr('href');
            }
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#restaurant-wrapper').html(out.restaurant_content_wrapper);
                }
            });
        });
        $(document).on('click', '.restauranttabs', function (evt) {
            evt.preventDefault();
            $('.restauranttabs').removeClass('active');
            var url = $(this).attr('href');
            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#restaurant-wrapper').html(out.restaurant_content_wrapper);
                    $('#example').DataTable({
                        responsive: true,
                        destroy: true
                    });
                }
            });
        });

        $(document).on('click', '.restauranttabs_edit', function (evt) {
            evt.preventDefault();
//            $('.restauranttabs').removeClass('active');
            var url = $(this).attr('href');
//            $(this).addClass('active');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#restaurant-wrapper').html(out.restaurant_content_wrapper);
                    $('#example').DataTable({
                        responsive: true,
                        destroy: true
                    });
                }
            });
        });
    };

    this.bulkAction = function () {
        $(document).on('change', '#bulk_actions', function (evt) {
            evt.preventDefault();
            var value = $(this).val();
            var url = ($(this).attr('data-url')) + value;
            alert(url);
            var checkboxValues = [];
            $(':checkbox:checked').each(function () {
                checkboxValues.push($(this).data('id'));
            });

            $.post(url, {product_ids: checkboxValues, value: value}, function (out) {
                alert(out);
            });

        });
    };

    this.editMenuWrapper = function () {
        $(document).on('click', '.editMenu', function () {
            $('#editMenuModel').modal('show');
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#edit_menu_wrapper').html(out.edit_menu_wrapper);
                }
            });
        });
    };

    this.storeWrapperCommonForm = function () {
        $(document).on('submit', '#store-wrapper-common-form', function (evt) {
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
                        $("#" + i).focus();
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

                    var active_url = $(".storetabs.active").attr('href');

                    $.post(active_url, '', function (out) {
                        if (out.result === 1) {
                            $('#store-wrapper').html(out.store_content_wrapper);
                            $('#example').DataTable({
                                responsive: true,
                                destroy: true
                            });
                        }
                    });
                }
            });
        });
    };

    this.storeWrapperImageCommonForm = function () {
        $(document).on('submit', '#store-wrapper-image-form', function (evt) {
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
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);

                        var active_url = $(".storetabs.active").attr('href');

                        $.post(active_url, '', function (out) {
                            if (out.result === 1) {

                                $('#store-wrapper').html(out.store_content_wrapper);
                                $('#example').DataTable({
                                    responsive: true,
                                    destroy: true
                                });
                            }
                        });
                    }
                }
            });
        });
    };

    this.restaurantWrapperCommonForm = function () {
        $(document).on('submit', '#restaurant-wrapper-common-form', function (evt) {
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
                        $("#" + i).focus();
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

                    var active_url = $(".restauranttabs.active").attr('href');

                    $.post(active_url, '', function (out) {
                        if (out.result === 1) {
                            $('#restaurant-wrapper').html(out.restaurant_content_wrapper);
                            $('#example').DataTable({
                                responsive: true,
                                destroy: true
                            });
                        }
                    });
                }
            });
        });
    };

    this.restaurantWrapperImageCommonForm = function () {
        $(document).on('submit', '#restaurant-wrapper-image-form', function (evt) {
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
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);

                        var active_url = $(".restauranttabs.active").attr('href');

                        $.post(active_url, '', function (out) {
                            if (out.result === 1) {
                                $('#restaurant-wrapper').html(out.restaurant_content_wrapper);
                                $('#example').DataTable({
                                    responsive: true,
                                    destroy: true
                                });
                            }
                        });
                    }
                }
            });
        });
    };
    this.storeOrderWrapper = function(){
        $(document).ready(function(){
            if($('.restaurantorder').hasClass('active')){
               var url = $('.restaurantorder').attr('href');
            }
            $.post(url,'',function(out){
                if(out.result === 1){
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
        $(document).on('click', '.restaurantorder', function (evt) {
            evt.preventDefault();
            $('.restaurantorder').removeClass('active');
            var url = $(this).attr('href');
            $(this).addClass('active');
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

    this.__construct();
};
var obj = new Event();