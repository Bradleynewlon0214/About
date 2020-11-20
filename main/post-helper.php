<?php

require("init.php");
require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$bucket = "cs230-s3-newlon";

$uploaded_files = array();

$allowed_types = ["jpg", "png", "jpeg", "gif"];

if(isset($_POST['submit'])){
    foreach($_FILES['files']['tmp_name'] as $key => $val){
    

        $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
        $file_name = $_FILES['files']['name'][$key]; 
        $file_size = $_FILES['files']['size'][$key];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    
        if($file_size / 1024 / 1024 > 50){
            header("Location: ../newpost.php?message=Your file is too large.");
        } else if(!in_array($file_ext, $allowed_types)) {
            header("Location: ../newpost.php?message=Only JPG, JPEG, PNG & GIF files are allowed.");
        } else{
            
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
                    'Key' => $file_name,
                    'SourceFile' => $file_tmpname,
                    'ACL' => 'public-read'
                ]);

                $url = $result->get('ObjectURL');

                array_push($uploaded_files, $url);
            
            } catch(Aws\S3\Exception\S3Excepttion $e){
                die("Error uploading file: " . $e->getMessage());
            }

        }
        
    }

    try{
        $db = new Database();
        $result = $db->insert('posts', ['user_id', 'title', 'text', 'images'], ["{$_SESSION['user']['id']}", "{$_POST['title']}",  "{$_POST['text']}", json_encode($uploaded_files)]);
        $db->close();
        header("Location: ../newpost.php?success=Profile picture uploaded successfully");
    } catch(Exception $e){
        header("Location: ../newpost.php?error=Something went wrong!");
    } 
}




// $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
// $allowed_types = ["jpg", "png", "jpeg", "gif"];


// if ($_FILES["cover"]["size"] / 1024 /1024 > 10) {
//     header("Location: ../newpost.php?message=Your file is too large.");
// } else if(!in_array($fileType, $allowed_types)) {
//      header("Location: ../newpost.php?message=Only JPG, JPEG, PNG & GIF files are allowed.");
// } else {

//     $file = "picpath/" . hash('ripemd160', $_FILES['cover']['name'] . round(microtime(true) * 1000)) . "." . $fileType;

//     if (move_uploaded_file($_FILES["cover"]["tmp_name"], $file)) {
//         $db = new Database();
//         $result = $db->insert('posts', ['user_id', 'text', 'image'], ["{$_SESSION['user']['id']}", "{$_POST['text']}", "{$file}"]);
//         $db->close();
//         header("Location: ../newpost.php?success=Profile picture uploaded successfully");
//     } else {
//         header("Location: ../newpost.php?error=Something went wrong!");
//     }
// }
?>