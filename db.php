<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'daily_db';

if (!$mysqli = new mysqli($host, $username, $password, $db))
    echo "Error db connection: ".$mysql->errno();
