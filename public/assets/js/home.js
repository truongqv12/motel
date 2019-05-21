$('#contact_us').submit(function (e) {
    e.preventDefault();
    var email = $("input[name=email]");
    var btn = $("button[name=submit_contact]");

    if (email.val() === '') {
        alert('Email không được để trống !!!');
        email.addClass('error');
        return false;
    }
    if (email.val() !== '' && IsEmail(email.val()) === false) {
        alert('Email sai định dạng !!!');
        email.addClass('error');
        return false;
    }
    else {
        $.ajax({
            type: "POST",
            url: '/ajax/lien-he',
            data: {
                'email' : email.val()
            },
            success: function success(result) {
                alert('Đăng ký thành công! Cảm ơn bạn đã quan tâm');
                email.val('');
                btn.attr("disabled","disabled");
            },
            error: function (err) {
                console.log(err)
            }
        });
    }

});

function IsEmail(email) {
    var regular_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regular_email.test(email)) {
        return false;
    } else {
        return true;
    }
};