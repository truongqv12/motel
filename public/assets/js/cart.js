$(".plus_update").on('click', function () {
    var total_money_order = Number($('input[name=total_money_order]').val());
    var pro_id = $(this).data('id');
    var price_item = Number($('input[name=price_item_' + pro_id + ']').val());
    var inputQty = $(this).parents('.quantity').find('.qty_update[data-id=' + pro_id + ']');
    var minus_update = $(this).parents('.quantity').find('.minus_update[data-id=' + pro_id + ']');

    var productQuantity = Number(inputQty.val()),
        intRegex = /^\d+$/;
    var max = inputQty.attr('max');

    if (productQuantityPlus === Number(max)) {
        $(".plus_update[data-id='" + pro_id + "']").attr('disabled', true);
    }
    else if (intRegex.test(productQuantity) && productQuantity >= 1) {
        minus_update.removeAttr('disabled');
        var productQuantityPlus = productQuantity + 1;
        inputQty.val(productQuantityPlus);
        if (productQuantityPlus === Number(max)) {
            $(".plus_update[data-id='" + pro_id + "']").attr('disabled', true);
        }
    }
    else {
        var productQuantityPlus = 1;
        inputQty.val(productQuantityPlus);
    }

    ajaxUpdateQuantity(pro_id, productQuantityPlus, price_item, total_money_order)
    return false;
});
$(".minus_update").on('click', function () {
    var total_money_order = Number($('input[name=total_money_order]').val());
    var pro_id = $(this).data('id');
    var price_item = Number($('input[name=price_item_' + pro_id + ']').val());

    var inputQty = $(this).parents('.quantity').find('.qty_update[data-id=' + pro_id + ']');
    var plus_update = $(this).parents('.quantity').find('.plus_update[data-id=' + pro_id + ']');
    var productQuantity = Number(inputQty.val()),
        intRegex = /^\d+$/;
    var max = Number(inputQty.attr('max'));

    if (intRegex.test(productQuantity) && productQuantity <= max) {
        if (productQuantity > 1) {
            plus_update.removeAttr('disabled')
            var productQuantityMinus = productQuantity - 1;
            inputQty.val(productQuantityMinus);
            if (productQuantityMinus === Number(max)) {
                $(".minus_update[data-id='" + pro_id + "']").attr('disabled', true);
            }
        }
        else if (productQuantity === 1) {
            $(".minus_update[data-id='" + pro_id + "']").attr('disabled', true);
        }
    } else {
        var productQuantityMinus = 1;
        inputQty.val(productQuantityMinus);
    }
    ajaxUpdateQuantity(pro_id, productQuantityMinus, price_item, total_money_order)
    return false;
});
$('.qty_update').change(function () {
    var total_money_order = Number($('input[name=total_money_order]').val());
    var sendCheck = false;
    var pro_id = $(this).data('id');
    var price_item = Number($('input[name=price_item_' + pro_id + ']').val());
    var inputQty = $('.qty_update[data-id=' + pro_id + ']');
    var minValue = parseInt(inputQty.attr('min'));
    var maxValue = parseInt(inputQty.attr('max'));
    var valueCurrent = parseInt(inputQty.val());
    var plus_update = $(this).parents('.quantity').find('.plus_update[data-id=' + pro_id + ']');
    var minus_update = $(this).parents('.quantity').find('.minus_update[data-id=' + pro_id + ']');

    if (valueCurrent == maxValue) {
        plus_update.attr('disabled', true);
        sendCheck = true;
    } else if (valueCurrent > minValue) {
        minus_update.removeAttr('disabled')
        plus_update.removeAttr('disabled')
        sendCheck = true;
    }
    else if (valueCurrent == minValue) {
        minus_update.attr('disabled', true);
        plus_update.removeAttr('disabled');
        sendCheck = true;
    } else {
        alert('Bạn chưa nhập số lượng sản phẩm!');
        minus_update.attr('disabled', true);
        $(this).val(1);
        sendCheck = false;
    }

    if (valueCurrent > maxValue) {
        alert('Bạn không thể nhập quá số lượng sản phẩm còn lại!');
        plus_update.attr('disabled', true);
        $(this).val(maxValue);
        ajaxUpdateQuantity(pro_id, maxValue, price_item, total_money_order)
        sendCheck = false;
    }

    if (sendCheck) {
        ajaxUpdateQuantity(pro_id, valueCurrent, price_item, total_money_order)
    }

});
$(".qty_update").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (!(e.keyCode !== 65) && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

function ajaxUpdateQuantity(product_id, quantity, price_item, total_money_order) {
    $.ajax({
        type: 'POST',
        url: '/ajax/update-cart',
        data: {
            product_id: product_id,
            quantity: quantity,
            price_item: price_item,
            total_money_order: total_money_order,
        },
        success: function (result) {
            var data = $.parseJSON(result);
            $('input[name=total_money_order]').val(data['total_money_order'])
            $('#total_money_order').text(formatMoney(data['total_money_order']));
        }
    });
}

function formatMoney(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + ' đ';
}

function validateFormCheckout() {
    $('.show_err').html("");
    var err = '';
    var ship_name = $('input[name=ship_name]');
    var ship_phone = $('input[name=ship_phone]');
    var ship_email = $('input[name=ship_email]');
    var ship_address = $('input[name=ship_address]');

    if (ship_name.val().length === 0) {
        err += '* Họ tên không được để trống \n';
        ship_name.addClass('error');
    } else {
        ship_name.removeClass('error');
    }

    if (ship_phone.val().length === 0) {
        err += '* Số điên thoại không được để trống \n';
        ship_phone.addClass('error');
    } else if (!checkPhoneNumber(ship_phone.val())) {
        err += '* Số điện thoại không đúng \n';
        ship_phone.addClass('error');
    } else {
        ship_phone.removeClass('error');
    }

    if (ship_address.val().length === 0) {
        err += '* Địa chỉ không được để trống \n';
        ship_address.addClass('error');
    } else if (ship_address.val().length < 10) {
        err += '* Địa chỉ không đầy đủ \n';
        ship_address.addClass('error');
    } else {
        ship_address.removeClass('error');
    }

    if (ship_email.val().length === 0) {
        err += '* Email không được để trống \n';
        ship_email.addClass('error');
    } else if (!validateEmail(ship_email.val())) {
        err += '* Email không đúng \n';
        ship_email.addClass('error');
    }
    else {
        ship_email.removeClass('error');
    }

    if (err.length > 0) {
        alert(err)
        // $('.show_err').append(err);
        return false;
    }

    $('#checkout').submit();
}

function checkPhoneNumber(phone) {
    var vnf_regex = /(09|03|07|08|05)+([0-9]{8})\b/g;
    return vnf_regex.test(phone);
}

// function validCharForStreetAddress(address) {
//     return "^\\d+\\s[A-z àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]+\\s[A-z àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]+".indexOf(address) >= 0;
// }

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}