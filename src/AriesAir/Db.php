<?php

namespace AriesAir;

class Db
{
    protected $db;

    public function __construct()
    {

        try {
            $this->db = new \PDO('mysql:host=127.0.0.1;dbname=ariesairdatawarehouse;charset=utf8', 'root', '');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}