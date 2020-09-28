<!DOCTYPE html>
<html>
    <head> 
        <title>Profile</title>
        <link rel="stylesheet" href="css/main.css" />

    <?php
        require("header.php");
        if(!isset($_SESSION['user'])){
            header("Location: about.php");
        }
    ?>

        <div class="segment purple">
            <div class="container">
                <h1>Hello</h1>
                <a 
                    class="btn btn-dark"
                    href="logout.php"
                >
                    Logout
                </a>
        </div>

    </body>
</html>