<?php
if( isset($_SESSION['user_id']) ) {
    header("Location: " . APPLICATION_NAME . "/dashboard/home");
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equip="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equip="X-UA-Compatible" content="IE=Edge"/>
    
    <title>Client Management | Register</title>

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <script>
        var APPLICATION_NAME = '<?= APPLICATION_NAME;?>';
    </script>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Criar Login</h5>
                        <form id="create-access-form">
                            <div class="row">
                                <div class="col-12">
                                    <label for="user-name" class="form-label">Nome de Usuário</label>
                                    <input id="user-name" name="user-name" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="user-email" class="form-label">E-mail</label>
                                    <input id="user-email" name="user-email" class="form-control" type="email">
                                </div>
                                <div class="col-12 ">
                                    <label for="user-password" class="form-label">Senha</label>
                                    <input id="user-password" name="user-password" class="form-control" type="password">
                                </div>
                                <div class="col-12">
                                    <a href="<?=APPLICATION_NAME?>/login/home">Voltar para tela de login</a>
                                </div>
                                <div class="col=12">
                                    <a class="btn btn-primary" id="create-user">Criar</a>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?=APPLICATION_NAME?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=APPLICATION_NAME?>/assets/js/Login/register.js"></script>
</body>
</html>