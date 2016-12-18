$(function () {
    $('#webform-client-form-1').on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'text',
            beforeSend: function () {
                $('#op').attr('disabled', 'disabled');
            },
            success: [
                function (data) {
                    if (data) {
                        if (data == 'Информация отправлена на Ваш email') {
                            swal('Спасибо!', data, 'success');
                        }
                        else {
                            swal('Ошибка!', data, 'error');
                        }
                        document.sub.reset();
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

