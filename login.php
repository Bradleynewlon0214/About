<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <?php
        require("includes/header.php");
        require("main/init.php");
    ?>


    <body>

        <?php 
        
          require("includes/nav.php");
        
        ?>

        
        <form class="form-signin" method="POST" action="main/login-helper.php">
            
            <h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
            
            <input name="email" type="email" class="form-control" placeholder="E-Mail" required autofocus>
            
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
            <a class="btn btn-lg btn-primary btn-block" href="signup.php">Or Signup</a>
        </form>
    </body>
</html>