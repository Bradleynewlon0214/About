<?php
    include("main/User.php");
    include("main/utils.php");
    
    $login_data = [
        "email" => sanitize($_POST['email']),
        "password" => sanitize($_POST['password'])
    ];

    print_r($login_data);

    $user = new User($login_data, []);

    header('Location: about.php');

?>