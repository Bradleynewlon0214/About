<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="css/login.css">

        <?php 
            require("header.php");
            if(isset($_SESSION['user'])){
                header("Location: about.php");
            }
        ?>

        
        <form class="form-signin" method="POST" action="signup-helper.php">
            <h1 class="h3 mb-3 font-weight-normal">Signup Here!</h1>

            <input type="text" class="form-control" name="first_name" placeholder="First Name"/>

            <input type="text" class="form-control" name="last_name" placeholder="Last Name"/>

            <input type="text" class="form-control" name="username" placeholder="Username"/>

            <input type="email" class="form-control" name="email" placeholder="Email"/>
 

            <input type="password" class="form-control" name="password" placeholder="Password"/>


            <input type="password" class="form-control" name="password_repeat" placeholder="Repeat Password"/>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
        </form>
    </body>
</html>