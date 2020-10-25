<?php

require("init.php");

$file = "picpath/" . $_FILES["profile"]["name"];

$fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
$allowed_types = ["jpg", "png", "jpeg", "gif"];


if ($_FILES["profile"]["size"] / 1024 /1024 > 10) {
    header("Location: ../profile.php?message=Your file is too large.");
} else if(!in_array($fileType, $allowed_types)) {
     header("Location: ../profile.php?message=Only JPG, JPEG, PNG & GIF files are allowed.");
} else {

    $file = "picpath/" . hash('ripemd160', $_FILES['profile']['name'] . round(microtime(true) * 1000)) . "." . $fileType;

    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $file)) {
        $db = new Database();
        $result = $db->update('users', ['profile_picture'], ["{$file}"], "`id`={$_SESSION['user']['id']}");
        $db->close();
        header("Location: ../profile.php?success=Profile picture uploaded successfully");
    } else {
        header("Location: ../profile.php?error=Something went wrong!");
    }
}
?>