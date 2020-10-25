<?php 
    if(isset($_SESSION['user'])){
        header("Location: about.php");
    }
?>