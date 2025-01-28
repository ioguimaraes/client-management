<?php

class LoginController extends Controller
{
    public function home()
    {
        $this->contentType('clean');
        include 'Apps/Login/view/login.php';
    }

    public function register()
    {
        $this->contentType('clean');
        include 'Apps/Login/view/register.php';
    }

    public function create_user() 
    {
        try{
            $this->contentType('json');
            $model = new LoginModel();

            foreach($_POST as $key => $value) {
                if(empty($value)) {
                    echo json_encode(['status' => false, 'data' => "Preencha todos os campos para poder realizar o cadastro do novo usuário!"]);
                    die();
                }
            }

            $check = $model->checkUserExist($_POST['user-email']);

            if($check) {
                echo json_encode(['status' => false, 'data' => "Email já está sendo utilizado por outro usuário!"]);
            } else {
                $model->createAccess($_POST['user-name'], $_POST['user-email'], MD5($_POST['user-password']));
                echo json_encode(['status' => true, 'data' => "Usuário criado com sucesso! Redirecionando ...."]);   
            }
        } catch(Exception $e) {
            echo json_encode(['status' => false, 'data' => "Error: {$e->getMessage()}"]);
        }
    }

    public function login()
    {
        $this->contentType('json');
        $model = new LoginModel();

        foreach($_POST as $key => $value) {
            if(empty($value)) {
                echo json_encode(['status' => false, 'data' => "Preencha usuário e senha para poder seguir com o acesso na ferramenta!"]);
                die();
            }
        }
        
        $check = $model->checkAccess($_POST['user-email'], MD5($_POST['user-password']));

        if($check) {
            $user = $model->getUser($_POST['user-email']);

            $_SESSION = $user;

            echo json_encode(['status' => true, 'data' => 'Login realizado com sucesso! Redirecionando ....']);
        } else {
            echo json_encode(['status' => false, 'data' => "Email ou senha inválidos!"]);
        }
    }

    public function logout()
    {
        $this->contentType('json');

        $_SESSION = [];
        session_destroy();
        echo json_encode(['status' => true, 'data' => "Logout realizado com sucesso!"]);
        
    }
}