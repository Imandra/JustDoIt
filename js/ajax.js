$(function () {
    $('#webform-client-form-1').on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: 'handler.php',
            type: form.attr('method'),
            data: formData,
            dataType: 'text',
            beforeSend: function () {
                $('#op').attr('disabled', 'disabled');
            },
            success: [
                function (data) {
                    if (data) {
                        if (data == 'Информация отправлена на ваш email') {
                            swal('Спасибо!', data, 'success');
                        } else if (data == 'Введите корректный email') {
                            swal('Ошибка!', data, 'error');
                        } else {
                            swal('Ошибка!', 'Не удалось подключиться к почтовому серверу', 'error');
                        }
                    }
                }
            ],
            error: [
                function (xhr) {
                    swal('Ошибка!', xhr.status + ' ' + xhr.statusText, 'error');
                }
            ],
            complete: [
                function () {
                    $('#op').prop('disabled', false);
                }
            ]
        });
    });
});

