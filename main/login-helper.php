<?php
    require("init.php");
    
    $login_data = [
        "email" => sanitize($_POST['email']),
        "password" => sanitize($_POST['password'])
    ];

    $user = new User($login_data, []);

    header('Location: ../index.php');

?>