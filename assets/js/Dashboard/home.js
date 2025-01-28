$(document).ready(function () {

    var client_id = 0;
    var myTable = null;

    function loadDatatableClient()
    {
        $('#table_client').dataTable().fnDestroy();
        myTable = $('#table_client').dataTable({
            "ajax": APPLICATION_NAME + '/dashboard/get_clients/',
            responsive: false,
            columns: [
                {data: "Id"},
                {data: "Nome"},
                {data: "CPF"},
                {data: "RG"},
                {data: "Telefone"},
                {data: "Data Nascimento"},
                {data: "Actions"}
            ],
            dom: 'frtip',
            "lengthMenu": [[10, 25, 50 -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "_MENU_"
            }
        });

        $('#table_client_wrapper').css('width', '100%', 'important');
        
    }

    loadDatatableClient();

    $('#save-client').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/dashboard/set_client',
            data: $('#save-client-form').serialize(),
            success: function (response) {
                if(response.status) {
                    alert(response.data);
                    $('#modal-add-client').modal('toggle');
                    loadDatatableClient();
                } else {
                    alert(response.data);
                }
            },
            error: function (err) {
                alert(err.data);
            }
        })
    });

    $(document.body).on('click', '.open-view-edit', function () {
        client_id = $(this).attr('name');
        $('#collapse-client-info-body').append("");
        $.ajax({
            type: 'GET',
            url: APPLICATION_NAME + '/dashboard/get_client/?client_id=' + client_id,
            success: function (response) {
                let client_data = "";
                let address_data = "";
                Object.keys(response.data).forEach(key => {
                    if(key === 'client_address') {
                        response.data[key].forEach(key2 => {
                            address_data += "<a href='#' class='list-group-item list-group-item-action list-group-item-address' aria-current='true'>" + 
                            "<div class='d-flex w-100 justify-content-between'>" + 
                            "<h5 class='mb-1'>Endereço</h5><small class='delete-address' id='" +key2.cl_address_id+ "' name='" +key2.cl_address_id+ "'>DELETE</small></div>" +
                            "<small>" + key2.cl_address_street + ", " + key2.cl_address_number + 
                            " (" + key2.cl_address_complement + ") " + key2.cl_address_neighborhood + ", " + key2.cl_address_city + " - " + key2.cl_address_state + 
                            ". CEP: " + key2.cl_address_cep + " | " + key2.cl_address_country + "</small></a>"
                        });
                    } else {
                        let index = key.split('_');
                        let index_input = index[0] + '-edit-' + index[1];
                        $('#' + index_input).val(response.data[key]);
                        if(!['id', 'state', 'at'].includes(index[1]))client_data += "<div class='list-group-item list-group-item-client'>" +index[1]+ ": " + response.data[key] +"</div>";
                    }
                });

                $('.list-group-item-address').remove();
                $('.list-group-item-client').remove();
                $('#collapse-client-info-body').append(client_data + address_data);
            },
            error: function (err) {
                alert(err.data)
            }
        });
    });

    $('#save-edit-client').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/dashboard/put_client/',
            data: $('#save-edit-client-form').serialize() + '&client_id=' + client_id,
            success: function (response) {
                alert(response.data);
                $('#modal-edit-client').modal('toggle');
                loadDatatableClient();
            },
            error: function (err) {
                alert(err.data);
            }
        });
    });

    $(document.body).on('click', '.delete-client', function () {
        $('#modal-delete-client').modal('show');
        client_id = $(this).attr('name');
    });

    $('#delete-confirmed').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/dashboard/delete_client',
            data:  'client_id=' + client_id,
            success: function (response) {
                alert(response.data);
                $('#modal-delete-client').modal('toggle');
                loadDatatableClient();
            },
            error: function (err) {
                alert(err.data)
            }
        });
    });

    $('#save-address-client').on('click', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/dashboard/set_address',
            data: $('#address-client-form').serialize() + '&client_id=' + client_id,
            success: function (response) {
                alert(response.data);
                $('#address-client-form').trigger('reset');
                $('#modal-edit-client').modal('toggle');
                loadDatatableClient();
            },
            error: function (err) {
                alert(err.data)
            }
        });
    });

    $(document.body).on('click', '.delete-address', function () {
        $.ajax({
            type: 'POST',
            url: APPLICATION_NAME + '/dashboard/delete_address',
            data:  'address_id=' + $(this).attr('name'),
            success: function (response) {
                alert(response.data);
                $('#modal-edit-client').modal('toggle');
                loadDatatableClient();
            },
            error: function (err) {
                alert(err.data)
            }
        });
    });

    $('#logout').on('click', function () {
        $.ajax({
            type: 'GET',
            url: APPLICATION_NAME + '/login/logout',
            success: function (response) {
                if(response.status) {
                    alert(response.data);
                    window.location = APPLICATION_NAME + '/login/home';
                } else {
                    alert(response.data);
                }
            },
            error: function (err) {
                alert(err.data);
            }
        })
    });
});