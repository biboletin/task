<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!defined('DB_HOST_ADDRESS')) {
    define('DB_HOST_ADDRESS', 'localhost');
}
if (!defined('DB_ENGINE')) {
    define('DB_ENGINE', 'mysqli');
}
if (!defined('DB_PORT')) {
    define('DB_PORT', 3306);
}
if (!defined('DB_USER')) {
    define('DB_USER', 'brcomp');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', 'brcomp');
}
if (!defined('DB_DATABASE_NAME')) {
    define('DB_DATABASE_NAME', 'tests');
}
if (!defined('DATABASE_CHARSET')) {
    define('DATABASE_CHARSET', 'utf8');
}

define('LOGGED_IN', 1);

include 'Db/Interfaces/SQLQuery.php';
include 'Db/Databases/MySQLConnection.php';
include 'Db/Databases/MySQLiConnection.php';
include 'Db/Databases/PDOConnection.php';
include 'Db/DatabaseConnector.php';

$db = new DataBaseConnector();
$mysqli = $db->setEngine('mysqli')->makeConnection();