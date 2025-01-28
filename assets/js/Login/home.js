$(document).ready(function () {

    $('#login').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/login/login',
            data: $('#login-form').serialize(),
            success: function (response) {
                if(response.status) {
                    alert(response.data);
                    window.location = APPLICATION_NAME + '/dashboard/home';
                } else {
                    alert(response.data);
                }
            },
            error: function (err) {
                alert(err.data);
            }
        })
    })
});