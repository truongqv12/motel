function validateRegisterForm(form_id) {
    $('.show_err').html("");

    var form = $('#' + form_id);
    var err = '';
    var username = form.find('.login-form-username');
    var phone = form.find('.login-form-phone');
    var email = form.find('.login-form-email');
    var password = form.find('.login-form-password');
    var password_confirm = form.find('.login-form-password-confirm');

    if (username.val().length === 0) {
        err += '<p>* Họ và tên không được trống</p>';
        username.addClass('error');
    } else {
        username.removeClass('error');
    }

    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

    if (phone.val().length === 0) {
        err += '<p>* Số điện thoại không được trống</p>';
        phone.addClass('error');
    } else if (vnf_regex.test(phone.val()) === false) {
        err += '<p>* Số điện thoại của bạn không đúng định dạng</p>';
        phone.addClass('error');
    } else {
        phone.removeClass('error');
    }

    if (email.val().length === 0) {
        err += '<p>* Email không được trống \n</p>';
        email.addClass('error');
    } else {
        var regular_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regular_email.test(email.val())) {
            err += '<p>* Email không đúng</p>';
            username.addClass('error');
        } else {
            username.removeClass('error');
        }
    }

    if (password.val().length === 0) {
        err += '<p>* Mật khẩu không được trống \n</p>';
        password.addClass('error');
    } else if (password.val().length < 6) {
        err += '<p>* Mật khẩu trên 6 ký tự \n</p>';
        password.addClass('error');
    } else {
        password.removeClass('error');
    }

    if (password_confirm.val() !== password.val() || password_confirm.val().length === 0) {
        err += '<p>* Nhập lại mật khẩu không đúng</p>';
        password_confirm.addClass('error');
    } else {

        password_confirm.removeClass('error');
    }

    if (err.length > 0) {
        $('.show_err').append(err);
        return false;
    }
    return true;
}

function validate_character(check) {
    $regex_vn = /[ àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]/;
    return $regex_vn.test(check);
}
