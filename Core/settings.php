<?php

//Set Default execution time (INT)
ini_set('max_execution_time', 60);

//APPLICATION VERSION
define('APPLICATION_VERSION', $_ENV['APPLICATION_VERSION']);

//APPLICATION NAME, SAME AS THE PATH(CHAR)
define('APPLICATION_NAME', '/' . $_ENV['APPLICATION_NAME']);

//APPLICATION DEBUG MODE (BOLL)
define('APPLICATION_DEBUG', $_ENV['APPLICATION_DEBUG']);

//SYSTEM CHARSET
define('CHARSET', $_ENV['CHARSET']);

//Database Setting
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_TYPE', $_ENV['DB_TYPE']);
define('DB_PORT', $_ENV['DB_PORT']);