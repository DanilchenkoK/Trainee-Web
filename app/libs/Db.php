<?php

namespace app\libs;

use PDO;

class Db
{
    private static $instance = null;
    private $db;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $config = require 'app/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . ';charset=utf8;', $config['user'], $config['password']);
    }
    
    public function query($sql, $params = [])
    {
        $tmp = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $tmp->bindValue(':' . $key, $value, $type);
            }
        }
        $tmp->execute();
        return $tmp;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
