$(function () {
    $('#pay').on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'text',
            success: [
                function (data) {
                    if (data) {
                        $('#response').html(data);
                        document.pay.reset();
                    }
                }
            ],
            error: [
                function (xhr) {
                    $('#response').text('Ошибка, код состояния HTTP: ' +
                        xhr.status + ' ' + xhr.statusText);
                }
            ]
        });
    });
});

