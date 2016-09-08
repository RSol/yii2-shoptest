$("#card_form").on('submit', function(event) {
    event.preventDefault();
    event.stopPropagation();

    $("#card_form").yiiActiveForm('validateAttribute', 'cardform-item');
    $("#card_form").yiiActiveForm('validateAttribute', 'cardform-count');

    setTimeout(function () {
        if ($("#card_form .has-error").length > 0) {
            return false;
        }

        $.ajax({
            method: 'POST',
            url: $("#card_form").attr('action'),
            data: $("#card_form").serialize(),
            beforeSend: function () {
                $('#load-screen').delay(10).fadeIn();
            },
            complete: function () {
                $('#load-screen').delay(10).fadeOut();
            },
            success: function (data) {
                if (data.success) {
                    $("#card").html(data.result);
                    return false;
                } else {
                    for (var item in data.errors) {
                        $("#card_form").yiiActiveForm('updateAttribute', 'cardform-' + item, data.errors[item]);
                    }
                }
            }
        });
    }, 200);

    return false;
});

$(document).on('click', '.card_delete_item', function (event) {

    if (confirm("Вы уверены, что хотите удалить этот товар из корзины?")) {
        $.ajax({
            method: 'POST',
            url: $(this).attr('href'),
            beforeSend: function () {
                $('#load-screen').delay(10).fadeIn();
            },
            complete: function () {
                $('#load-screen').delay(10).fadeOut();
            },
            success: function (data) {
                if (data.success) {
                    $("#card").html(data.result);
                    return false;
                }
            }
        });
    }

    event.preventDefault();
    event.stopPropagation();
    return false;
});