$(window).on('load', function () {

    var lastScrollTop = 0;
    $('#header.sticky-on-upscroll').addClass('show-sticky-onscroll'); // Up Scroll
    window.addEventListener("scroll", function () {
        var st = $(this).scrollTop();
        if (st > lastScrollTop) {
            $('#header.sticky-on-upscroll').removeClass('show-sticky-onscroll'); // Down Scroll
        } else {
            $('#header.sticky-on-upscroll').addClass('show-sticky-onscroll'); // Up Scroll
        }
        lastScrollTop = st;
    });

    $('.select_location_toggle').off('click').on('click', function (e) {
        $('.select_user_box').removeClass('select_user_box_show');
        $('.select_location_box').toggleClass('select_location_box_show');
        e.stopPropagation();
        e.preventDefault();
    });

    $('.select_user_toggle').off('click').on('click', function (e) {
        $('.select_location_box').removeClass('select_location_box_show');
        $('.select_user_box').toggleClass('select_user_box_show');
        e.stopPropagation();
        e.preventDefault();
    });

    // var current = location.pathname;
    // $('#primary-menu .mega_menu').each(function(){
    //     var $this = $(this).find('.main_menu_href');
    //     if($this.attr('href').indexOf(current) >= 10 || $this.attr('href').indexOf(current) === 0){
    //         $(this).addClass('active');
    //     }
    // })

    var city_select2 = $("#cbCity").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Thành Phố...',
        allowClear: true,
    });

    $("#cbDistrict").select2({
        theme: "bootstrap",
        placeholder: 'Chọn quận...',
        disabled: true
    });


    city_select2.change(function () {
        const id = $(this).val();
        ajaxLoadDistrict(id);
    });
});

function ajaxLoadDistrict(city_id) {
    $.ajax({
        type: 'GET',
        url: '/ajax/load-district',
        data: {
            city_id: city_id,
        },
        success: function (response) {
            $('#loadDistrict').html(response);
            $("#cbDistrict").select2({
                disabled: false,
            });
            $('#loadDistrict').addClass('disableFalse');
        }
    });
}

function validateLoginForm(form_id) {
    $('.show_err').html("");

    var form = $('#' + form_id);
    var err = '';
    var password = form.find('.login-form-password');
    var email = form.find('.login-form-email');

    if (email.val().length === 0) {
        err += '<p>* Email không được trống \n</p>';
        email.addClass('error');
    } else {
        var regular_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regular_email.test(email.val())) {
            err += '<p>* Email không đúng</p>';
            email.addClass('error');
        } else {
            email.removeClass('error');
        }
    }

    if (password.val().length === 0) {
        err += '<p>* Mật khẩu không được để trống \n</p>';
        password.addClass('error');
    } else if (password.val().length < 2) {
        err += '<p>* Mật khẩu quá ngắn \n</p>';
        password.addClass('error');
    } else {
        password.removeClass('error');
    }
    if (err.length > 0) {
        $('.show_err').append(err);
        return false;
    }
    return true;
}