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
                        $('#response').html(data);
                        alert(data);
                        document.sub.reset();
                    }
                }
            ],
            error: [
                function (xhr) {
                    $('#response').text('Ошибка, код состояния HTTP: ' +
                        xhr.status + ' ' + xhr.statusText);
                    alert('Ошибка, код состояния HTTP: ' +
                        xhr.status + ' ' + xhr.statusText);
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

