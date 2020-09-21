<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "cs230";

    $link = mysqli_connect($host, $username, $password, $database);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }



    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    
    if(strlen($first_name) > 255 | strlen($last_name) > 255 | strlen($username) > 255 | strlen($email) > 255) {
        print("First name, last name, username, and email must all be shorter than 255 characters.");
    }

    if($password !== $password_repeat){
        print("Passwords do not match!");
    }

    if(strlen($password) > 255 | strlen($password) < 8){
        print("Passwords must be longer than 8 characters and shorter than 255 characters");
    }


    $sql = "INSERT INTO `users`(`id`, `first_name`, `last_name`, `username`, `email`, `password`, `password_repeat`) VALUES (NULL, '{$first_name}', '{$last_name}', '{$username}', '{$email}', '{$password}', '{$password_repeat}')";
    if(!mysqli_query($link, $sql)){
        print("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);

    header('Location: index.html');

?>