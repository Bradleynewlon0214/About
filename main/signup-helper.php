<?php

    require("init.php");
    
    $register_data = [
        "first_name" => sanitize($_POST['first_name']),
        "last_name" => sanitize($_POST['last_name']),
        "username" => sanitize($_POST['username']),
        "email" => sanitize($_POST['email']),
        "password" => sanitize($_POST['password']),
        "password_repeat" => sanitize($_POST['password_repeat']),
    ];

    $user = new User([], $register_data);

    header('Location: ../about.php');

?>