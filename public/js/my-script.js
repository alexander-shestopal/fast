$(document).ready(function() {
    $('#my-form').submit(function(event) {
        event.preventDefault();
        // Создание и отправка события
        $.post('/your-route', function() {
            alert('Событие было отправлено!');
        });
    });
});
