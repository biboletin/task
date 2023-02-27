<?php

use \MySQLi;

class Sql extends MySQLi
{
    public function __construct()
    {
        parent::__construct(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB);
    }
}