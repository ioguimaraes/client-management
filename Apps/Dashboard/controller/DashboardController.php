<?php

class DashboardController extends Controller
{
    public function home()
    {
        $this->contentType('clean');
        include 'Apps/Dashboard/view/home.php';
    }

    public function get_clients()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $data = [];
        $client_list = $model->getClients();
        $debug = [];

        if(!empty($client_list)){
            while($row = $client_list->fetch_assoc()) {
                $data[] = [
                    "Id" => $row['client_id'],
                    "Nome" => $row['client_name'],
                    "CPF" => $row['client_cpf'],
                    "RG" => $row['client_rg'],
                    "Telefone" => $row['client_phone'],
                    "Data Nascimento" => $row['client_birthdate'],
                    "Actions" => '<button type="button" class="open-view-edit btn btn-info" id="' .$row['client_id']. '" name="' .$row['client_id']. '" data-bs-toggle="modal" data-bs-target="#modal-edit-client">Editar</button>
                    <button type="button" class="delete-client btn btn-danger" id="' .$row['client_id']. '" name="' .$row['client_id']. '">Excluir</button>'
                ];
            }
        }

        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function get_client()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $data = $model->getClient($_GET['client_id']);
        $addresses = $model->getAddress($_GET['client_id']);

        if(!empty($addresses)) {
            while($row = $addresses->fetch_assoc()) {
                $data['client_address'][] = $row;
            }
        } else {
            $data['client_address'] = [];
        }

        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function set_client()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        foreach($_POST as $key => $value) {
            if(empty($value)) {
                echo json_encode(['status' => false, 'data' => "Preencha todos os campos para poder realizar o cadastro do novo cliente!"]);
                die();
            }
        }

        $check = $model->checkClient($_POST['client-cpf']);

        if($check) {
            echo json_encode(['status' => false, 'data' => "Cliente já cadastrado com esse CPF!"]);
        } else {
            $model->saveClient($_POST['client-name'], $_POST['client-cpf'], $_POST['client-rg'], $_POST['client-phone'], $_POST['client-birthdate']);
            echo json_encode(['status' => true, 'data' => 'Criação de cliente realizada com sucesso!']);  
        }
    }

    public function put_client()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $model->putClient($_POST['client_id'], $_POST['client-edit-name'], $_POST['client-edit-cpf'], $_POST['client-edit-rg'], $_POST['client-edit-phone'], $_POST['client-edit-birthdate']);

        echo json_encode(['status' => true, 'data' => 'Atualização do cliente realizada com sucesso!', 'debug' => $_POST]);
    }

    public function delete_client()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $model->deleteClient($_POST['client_id']);

        echo json_encode(['status' => true, 'data' => 'Cliente excluído com sucesso!']);
    }

    public function set_address()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $model->setAddress($_POST['client_id'], $_POST['address-cep'], $_POST['address-street'], $_POST['address-neighborhood'], $_POST['address-number'], $_POST['address-complement'], $_POST['address-city'], $_POST['address-state'], $_POST['address-country']);

        echo json_encode(['status' => true, 'data' => 'Endereço adicionado com sucesso!']);
    }

    public function delete_address()
    {
        $this->contentType('ajax');
        $model = new DashboardModel();

        $model->deleteAddress($_POST['address_id']);

        echo json_encode(['status' => true, 'data' => 'Endereço excluído com sucesso!']);
    }
}