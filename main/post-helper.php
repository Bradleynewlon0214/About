<?php

require("init.php");

$file = "picpath/" . $_FILES["cover"]["name"];

$fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
$allowed_types = ["jpg", "png", "jpeg", "gif"];


if ($_FILES["cover"]["size"] / 1024 /1024 > 10) {
    header("Location: ../newpost.php?message=Your file is too large.");
} else if(!in_array($fileType, $allowed_types)) {
     header("Location: ../newpost.php?message=Only JPG, JPEG, PNG & GIF files are allowed.");
} else {

    $file = "picpath/" . hash('ripemd160', $_FILES['cover']['name'] . round(microtime(true) * 1000)) . "." . $fileType;

    if (move_uploaded_file($_FILES["cover"]["tmp_name"], $file)) {
        $db = new Database();
        $result = $db->insert('posts', ['user_id', 'text', 'image'], ["{$_SESSION['user']['id']}", "{$_POST['text']}", "{$file}"]);
        $db->close();
        header("Location: ../newpost.php?success=Profile picture uploaded successfully");
    } else {
        header("Location: ../newpost.php?error=Something went wrong!");
    }
}
?>