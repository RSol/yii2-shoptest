$("#card_form").on('submit', function(event) {
    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
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

    event.preventDefault();
    event.stopPropagation();
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