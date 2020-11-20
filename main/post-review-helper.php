<?php 

    require("init.php");

    $text = $_POST['review'];
    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['post_id'];

    $db = new Database();

    $db->insert('reviews', ['user_id', 'text', 'post_id'], [$user_id, $text, $post_id]);


    // print_r($_POST);

    header("Location: ../index.php"); 


?>