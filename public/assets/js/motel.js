$(document).ready(function () {
    load_icheck();

    $('.check_step_1').on('ifChecked', function () {
        $('#step-2').addClass('show');
    });

    $('.check_step_1').on('ifUnchecked', function () {
        $('#step-2').removeClass('show');
    });

    $('.check_step_2').on('ifChecked', function () {
        $('#step-3').addClass('show');
    });
    $('.check_step_2').on('ifUnchecked', function () {
        $('#step-3').removeClass('show');
    });
});

function validateFormMotel() {
    $('.show_err').html("");

    var form = $('#formMotel');
    var err = false;
    const title = form.find('.form_title');
    const phone = form.find('.form_phone');
    const price = form.find('.form_price');
    const area = form.find('.form_area');
    const address = form.find('#maps_address');
    const city_id = $('#cbCity');
    const district_id = $('#cbDistrict');
    const ward_id = $('#cbWard');

    if (title.val().length === 0) {
        err = false;
        title.addClass('error');
    } else if (title.val().length <= 10) {
        err = true;
        title.addClass('error');
        $('.error_title').html('* Tiêu đề qá ngắn');
    } else {
        title.removeClass('error');
    }

    if (area.val().length === 0) {
        err = true;
        area.addClass('error');
    } else {
        area.removeClass('error');
    }

    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

    if (phone.val().length === 0) {
        err = true;
        phone.addClass('error');
    } else if (vnf_regex.test(phone.val()) === false) {
        err = true;
        phone.addClass('error');
        $('.error_phone').html('* Số điện thoại không đúng');
    } else {
        phone.removeClass('error');
    }
    if (parseInt(city_id.val()) === 0 || city_id.val() === '') {
        city_id.parent().find('.select2').find('.select2-selection').addClass('error');
        err = true;
    }
    else {
        city_id.removeClass('error');
    }

    if (parseInt(district_id.val()) === 0 || district_id.val() === '' || district_id.val() == null) {
        district_id.parent().find('.select2').find('.select2-selection').addClass('error');
        err = true;
    }
    else {
        district_id.parent().find('.select2').find('.select2-selection').removeClass('error');
    }

    if (parseInt(ward_id.val()) === 0 || ward_id.val() === '' || ward_id.val() == null) {
        ward_id.parent().find('.select2').find('.select2-selection').addClass('error');
        err = true;
    }
    else {
        ward_id.parent().find('.select2').find('.select2-selection').removeClass('error');
    }

    if (price.val().length === 0) {
        price.addClass('error');
        err = true;
    } else {
        price.removeClass('error');
    }

    if (address.val().length === 0) {
        address.addClass('error');
        err = true;
    } else {
        address.removeClass('error');
    }

    if (err) {

        const position = $('#step-3');
        $("body, html").animate({
            scrollTop: position
        } /* speed */);

        toastr.error('Vui lòng điền đầy đủ thông tin');
        return false;
    }
    return true;
}