<?php

namespace app\controllers;

use app\components\Controller;
use app\components\View;

class HomeController extends Controller
{

  public function indexAction()
  {
    $users = $this->model->getUsers();
    $this->view->render('Главная', ['users' => $users]);
  }

  public function userAction()
  {
    $user = $this->model->getUser($this->route['id']);
    $this->view->sendResponceJson(null, $user[0]);
  }

  public function addUserAction()
  {
    if (!$this->model->checkData($_POST, ['first_name', 'last_name', 'email'])) {
      View::errorCode(400);
    }
    $user = $this->model->addUser($_POST);
    $this->view->sendResponceJson('add-user', $user[0]);
  }

  public function editAction()
  {
    if (!$this->model->checkData($_POST, ['id', 'first_name', 'last_name', 'email', 'create_date'])) {
      View::errorCode(400);
    }
    $user = $this->model->editUser($_POST);
    $this->view->sendResponceJson('update', $user[0]);
  }
}
