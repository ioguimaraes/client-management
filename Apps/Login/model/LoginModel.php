<?php

class LoginModel extends Model
{
    public function checkUserExist($email)
    {
        return $this->_connection->query("SELECT user_id FROM users WHERE user_email = '{$email}'")->num_rows;
    }

    public function checkAccess($email, $password)
    {
        return $this->_connection->query("SELECT user_id FROM users WHERE user_email = '{$email}' AND user_password = '{$password}'")->num_rows;
    }

    public function createAccess($name, $email, $password)
    {
        return $this->_connection->query("INSERT INTO users (user_name, user_email, user_password) 
        VALUES ('{$name}', '{$email}', '{$password}')");
    }

    public function getUser($email)
    {
        return $this->_connection->query("SELECT * FROM users WHERE user_email = '{$email}'")->fetch_assoc();
    }
}