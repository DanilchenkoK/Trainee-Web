<?php

namespace app\models;

use app\components\Model;

class Home extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDateTime()
    {
        return date('Y-m-d') . 'T' . date('H:i', strtotime('+3 hour'));
    }

    public function checkData($post, $keys)
    {
        foreach ($keys as $key) {
            if (!isset($post[$key]) or empty($post[$key])) {
                return false;
            }
        }
        return true;
    }

    public function getUsers()
    {
        return  $this->db->row('select * from users');
    }
    public function getUser($id)
    {
        return  $this->db->row('select * from users where id = :id', ['id' => $id]);
    }

    public function addUser($post)
    {
        $this->db->query('insert into users set first_name = :name, last_name = :last, email=:email, create_date=:time', [
            'name' => $post['first_name'],
            'last' => $post['last_name'],
            'email' => $post['email'],
            'time' => $this->getDateTime(),
        ]);

        return $this->db->row('select * from users where id = :id', [
            'id' => $this->db->lastInsertId()
        ]);
    }

    public function editUser($post)
    {
        $this->db->query('update users set 
         create_date = :date,
         update_date = :time,
         first_name = :first,
         last_name = :last, 
         email = :email where id= :id', [
            'date' => $post['create_date'],
            'time' => $this->getDateTime(),
            'first' => $post['first_name'],
            'last' => $post['last_name'],
            'email' => $post['email'],
            'id' => $post['id']
        ]);
        return $this->db->row('select * from users where id = :id', ['id' => $post['id']]);
    }
}
