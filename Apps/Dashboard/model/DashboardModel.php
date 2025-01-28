<?php

class DashboardModel extends Model
{
    
    public function getClients()
    {
        return $this->_connection->query("SELECT * FROM client_info WHERE client_state = 1");
    }

    public function getClient($client_id)
    {
        return $this->_connection->query("SELECT * FROM client_info WHERE client_id = {$client_id}")->fetch_assoc();
    }

    public function checkClient($cpf)
    {
        return $this->_connection->query("SELECT client_id FROM client_info WHERE client_cpf = '{$cpf}' AND client_state = 1")->num_rows;
    }

    public function saveClient($name, $cpf, $rg, $phone, $birthdate)
    {
        return $this->_connection->query("INSERT INTO client_info (client_name, client_cpf, client_rg, client_phone, client_birthdate, client_state)
        VALUES ('{$name}', '{$cpf}', '{$rg}', '{$phone}', '{$birthdate}', 1)");
    }

    public function putClient($client_id, $name, $cpf, $rg, $phone, $birthdate)
    {
        return $this->_connection->query("UPDATE client_info 
        SET client_name = '{$name}', client_cpf= '{$cpf}', client_rg= '{$rg}', client_phone= '{$phone}', client_birthdate= '{$birthdate}'
        WHERE client_id = {$client_id}");
    }

    public function deleteClient($client_id)
    {
        return $this->_connection->query("DELETE FROM client_info WHERE client_id = {$client_id}");
    }

    public function getAddress($client_id)
    {
        return $this->_connection->query("SELECT * FROM client_address WHERE client_id = {$client_id}");
    }

    public function setAddress($client_id, $cep, $street, $neighborhood, $number, $complement, $city, $state, $country)
    {
        return $this->_connection->query("INSERT INTO client_address (client_id, cl_address_cep, cl_address_street, cl_address_neighborhood, cl_address_number, cl_address_complement, cl_address_city, cl_address_state, cl_address_country)
        VALUES ({$client_id}, '{$cep}', '{$street}', '{$neighborhood}', {$number}, '{$complement}', '{$city}', '{$state}', '{$country}')");
    }

    public function deleteAddress($address_id)
    {
        return $this->_connection->query("DELETE FROM client_address WHERE cl_address_id = {$address_id}");
    }

}