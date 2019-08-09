var Event = function () {
    this.__construct = function () {
        this.orderWrapper();
        this.removeFromCart();
        this.increaseQuantity();
        this.applyCoupon();
        this.removeCoupon();
        this.checkEMarket();
        this.tip();
        this.storeCheckOut();
        this.doAddShippingAddress();
        this.cashOnDelivery();
    };

    this.orderWrapper = function () {
        $(document).ready(function () {
            var url = $('#content-wrapper').data('url');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.removeFromCart = function () {
        $(document).on('click', '.removeCart', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            $.post(url, '', function (out) {
                if (out.result === 1) {
                     swal({
                        title: "Updated",
                        text: "Item Deleted From Cart!",
                        icon: "success",
                        button: "Ok",
                        });
                      setTimeout(function(){ location.reload(); }, 2000);
                    //location.reload();
                }
            });
        });

    };

    this.increaseQuantity = function () {
        var url;
        var qty;
        $(document).on('click', '.add_btn1', function (evt) {
            evt.preventDefault();
            qty = $(this).prev('.qty').val();
            url = $(this).prev('.qty').data('url');
            var result1 = (qty >= 1) ? qty++ : 1;
            $(this).prev('input').val(qty);
            $.post(url, {qty: qty}, function (out) {
                if (out.result === 1) {
                    obj.orderWrapper();
                }
            });

        });

        $(document).on('click', ' .sub_btn', function (evt) {
            evt.preventDefault();
            qty = $(this).next('.qty').val();
            url = $(this).next('.qty').data('url');
            var result = (qty <= 1) ? 1 : qty--;
            $(this).next('input').val(qty);
            $.post(url, {qty: qty}, function (out) {
                if (out.result === 1) {
                    obj.orderWrapper();
                }
            });
        });
    };

    this.applyCoupon = function () {
        $(document).on('click', '#apply-coupon', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            var coupon = $('#coupon').val();
            $.post(url, {coupon: coupon}, function (out) {
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
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.removeCoupon = function () {
        $(document).on('click', '#remove-coupon', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            $.post(url, '', function (out) {
                if (out.result === 1) {
                    $('#content-wrapper').html(out.content_wrapper);
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
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });
        });
    };

    this.tip = function () {
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
                    $('#content-wrapper').html(out.content_wrapper);
                }
            });

        });

    };

    this.storeCheckOut = function () {
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

    this.doAddShippingAddress = function () {
        $(document).on('submit', '#shipping_form', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                $(".readaggre>.tick > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                        $("#" + i).parents(".tick").parents('.readaggre').append('<span class="error">' + out.errors[i] + '</span>');
                        $("#"+i).focus();
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

    this.cashOnDelivery = function () {
       
        $(document).on('click', '#cash_on_delivery', function () {
            var data  = confirm('Are you sure order place cash on delivery ?.');
            if(data === true){
               var url = $(this).data('url');
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                       window.location.href = out.url;
                    }
                });
            }      
        });
    };

    this.__construct();
};
var obj = new Event();