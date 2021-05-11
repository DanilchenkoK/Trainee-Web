<?php
return [
    //HomeController
    '' => [
        'controller' => 'home',
        'action' => 'index'
    ],
    'add-user' => [
        'controller' => 'home',
        'action' => 'addUser'
    ],
   
    'user/{id:\d+}' => [
        'controller' => 'home',
        'action' => 'user'
    ],

    'edit/{id:\d+}' => [
        'controller' => 'home',
        'action' => 'edit'
    ]

];
