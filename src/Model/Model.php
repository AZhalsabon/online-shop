<?php

class PdoConnection
{
    protected PDO $pdo;

    public function __consrtuct()
    {
        $this->pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    }
}