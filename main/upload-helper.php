<?php

require("init.php");


require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$bucket = "cs230-s3-newlon";


$file = "picpath/" . $_FILES["profile"]["name"];

$fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
$allowed_types = ["jpg", "png", "jpeg", "gif"];


if ($_FILES["profile"]["size"] / 1024 /1024 > 10) {
    header("Location: ../profile.php?message=Your file is too large.");
} else if(!in_array($fileType, $allowed_types)) {
     header("Location: ../profile.php?message=Only JPG, JPEG, PNG & GIF files are allowed.");
} else {

    $file = hash('ripemd160', $_FILES['profile']['name'] . round(microtime(true) * 1000)) . "." . $fileType;

    $url = "";

    try{

        $s3Client = S3Client::factory(
            array(
                'region' => 'us-east-2',
                'version' => 'latest',
                'credentials' => array(
                    'key' => 'AKIA2JLJBQVJTF2DACMB',
                    'secret' => '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'
                )
            )
        );
    
        $result = $s3Client->putObject([
            'Bucket' => $bucket,
            'Key' => $_FILES['profile']['name'],
            'SourceFile' => $_FILES['profile']['temp_name'],
            'ACL' => 'public-read'
        ]);

        $url = $result->get('ObjectURL');
    
    } catch(Aws\S3\Exception\S3Excepttion $e){
        die("Error uploading file: " . $e->getMessage());
    }


    try {
        $db = new Database();
        $result = $db->update('users', ['profile_picture'], ["{$url}"], "`id`={$_SESSION['user']['id']}");
        $db->close();
        header("Location: ../profile.php?success=Profile picture uploaded successfully");
    } catch(Exception $e) {
        header("Location: ../profile.php?error=Something went wrong!");
    }
}
?>