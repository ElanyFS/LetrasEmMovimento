<?php
return [
    "POST" => [
        '/user/create' => 'Home@createStore',
    ],

    "GET" => [
        '/' => 'Home@index',
        '/cadastro' => 'Home@modal',
        // '/formulario' => "User@create",   
    ]
];

