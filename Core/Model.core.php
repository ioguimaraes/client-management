<?php

class Model
{
    public $_connection;

    public function __construct()
    {
        try {

            /*$this->_connection = new PDO(
                "{DB_TYPE}:Server={DB_HOST};Database={DB_NAME}",
                DB_USER,
                DB_PASSWORD
            );*/

            $this->_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        } catch (Exception $e) {
            echo "Error Date: " . date('Y-m-d H:i:s');
            echo "Error Message: " . $e->getMessage() . '\n\r';
            echo "Error Line: " . $e->getLine() . '\n\r';

            $this->_connection = false;
        }
    }

    public function __destruct()
    {
        $this->_connection = false;
    }
}