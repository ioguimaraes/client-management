$(document).ready(function () {

    $('#create-user').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/login/create_user',
            data: $('#create-access-form').serialize(),
            success: function (response) {
                if(response.status) {
                    alert(response.data)
                    window.location = APPLICATION_NAME + '/login/home';
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