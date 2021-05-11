<?php

namespace app\components;

use app\libs\Db;

abstract class Model
{
    public $db;
    public function __construct()
    {
        $this->db = Db::getInstance();
    }
}
