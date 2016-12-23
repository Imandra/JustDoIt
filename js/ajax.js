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
                        if (data == 'Информация отправлена на Ваш email') {
                            swal('Спасибо!', data, 'success');
                        }
                        else {
                            swal('Ошибка!', data, 'error');
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
                    /*$('#webform-client-form-1')[0].reset();
                    $('#edit-submitted-name').attr('required','required');
                    $('#edit-submitted-phone').attr('required','required');
                    $('#edit-submitted-mail').attr('required','required');*/
                    $('#op').prop('disabled', false);
                }
            ]
        });
    });
});

