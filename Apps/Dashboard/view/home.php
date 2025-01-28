<?php
if( !isset($_SESSION['user_id']) ) {
    header("Location: " . APPLICATION_NAME . "/login/home");
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equip="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equip="X-UA-Compatible" content="IE=Edge"/>
    
    <title>Client Management | Dashboard</title>

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="<?=APPLICATION_NAME?>/assets/css/datatables.min.css" rel="stylesheet"></script>
</head>
<body>

    <script>
        var APPLICATION_NAME = '<?= APPLICATION_NAME;?>';
    </script>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-2">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Menu</h5>
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action list-group-item-info" id="add-client" data-bs-toggle="modal" data-bs-target="#modal-add-client">Adicionar Cliente</button>
                        <button type="button" class="list-group-item list-group-item-action list-group-item-danger" id="logout">Sair</button>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Clientes</h5>
                        <div class="row">
                            <div class="col-12">
                                <table class="table caption-top datatable heighlight display centered" id="table_client" name="table_client">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">RG</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Data Nascimento</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-content"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="modal-add-client" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Adicionar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="save-client-form">
                        <div class="row">
                            <div class="col-12">
                                <label for="client-name" class="form-label">Nome Cliente</label>
                                <input id="client-name" name="client-name" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="client-cpf" class="form-label">CPF</label>
                                <input id="client-cpf" name="client-cpf" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="client-rg" class="form-label">RG</label>
                                <input id="client-rg" name="client-rg" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="client-phone" class="form-label">Telefone</label>
                                <input id="client-phone" name="client-phone" class="form-control" type=tel>
                            </div>
                            <div class="col-12">
                                <label for="client-birthdate" class="form-label">Data Nascimento</label>
                                <input id="client-birthdate" name="client-birthdate" class="form-control" type="date">
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" id="save-client">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="modal-edit-client" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Vizualizar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="accordion accordion-flush" id="accordion-client">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-client-info" aria-expanded="false" aria-controls="collapse-client-info">Informações do Cliente</button>
                            </h2>
                            <div id="collapse-client-info" class="accordion-collapse collapse" data-bs-parent="#accordion-client">
                                <div class="accordion-body">
                                    <div class="list-group" id="collapse-client-info-body"></div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-client" aria-expanded="false" aria-controls="collapse-client">Editar Cliente</button>
                            </h2>
                            <div id="collapse-client" class="accordion-collapse collapse" data-bs-parent="#accordion-client">
                                <div class="accordion-body">
                                    <form id="save-edit-client-form">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="client-edit-name" class="form-label">Nome Cliente</label>
                                                <input id="client-edit-name" name="client-edit-name" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="client-edit-cpf" class="form-label">CPF</label>
                                                <input id="client-edit-cpf" name="client-edit-cpf" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="client-edit-rg" class="form-label">RG</label>
                                                <input id="client-edit-rg" name="client-edit-rg" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="client-edit-phone" class="form-label">Telefone</label>
                                                <input id="client-edit-phone" name="client-edit-phone" class="form-control" type=tel>
                                            </div>
                                            <div class="col-12">
                                                <label for="client-edit-birthdate" class="form-label">Data Nascimento</label>
                                                <input id="client-edit-birthdate" name="client-edit-birthdate" class="form-control" type="date">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-success" id="save-edit-client">Salvar</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-client-address" aria-expanded="false" aria-controls="collapse-client-address">Adicionar Endereço</button>
                            </h2>
                            <div id="collapse-client-address" class="accordion-collapse collapse" data-bs-parent="#accordion-client">
                                <div class="accordion-body">
                                <form id="address-client-form">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="address-cep" class="form-label">CEP</label>
                                                <input id="address-cep" name="address-cep" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-street" class="form-label">Logradouro</label>
                                                <input id="address-street" name="address-street" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-neighborhood" class="form-label">Bairro</label>
                                                <input id="address-neighborhood" name="address-neighborhood" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-number" class="form-label">Número</label>
                                                <input id="address-number" name="address-number" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-complement" class="form-label">Complemento</label>
                                                <input id="address-complement" name="address-complement" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-city" class="form-label">Cidade</label>
                                                <input id="address-city" name="address-city" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-state" class="form-label">Estado</label>
                                                <input id="address-state" name="address-state" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="address-country" class="form-label">País</label>
                                                <input id="address-country" name="address-country" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-success" id="save-address-client">Salvar Endereço</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete-client" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Excluir cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>O Cliente será excluido permanentemente, deseja prosseguir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="delete-confirmed">Confirmar Exclusão</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="<?=APPLICATION_NAME?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=APPLICATION_NAME?>/assets/js/datatables.min.js"></script>
    <script src="<?=APPLICATION_NAME?>/assets/js/Dashboard/home.js?v=<?=date('YmdHis')?>" type="module"></script>
</body>
</html>