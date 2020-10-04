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
    
    <?php 
        if(isset($_GET['success'])){
            print("<div class='alert alert-success' role='alert'>");
            print($_GET['success']);
            print("</div>");
        }

        if(isset($_GET['error'])){
            print("<div class='alert alert-danger' role='alert'>");
            print($_GET['error']);
            print("</div>");
        }

        if(isset($_GET['message'])){
            print("<div class='alert alert-warning' role='alert'>");
            print($_GET['message']);
            print("</div>");
        }
    
    ?>
        <div class="segment">
        </div>
        <div class="segment purple">
            <div class="container">

                <?php
                    print("<img src='{$_SESSION['user']['profile_picture']}'/>");
                ?>

                <br/>

                <form method="POST" action="upload-helper.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="uploadButton">Upload Profile Picture!</label>
                        <input type="file" class="form-control-file" name="profile" id="uploadButton" />
                    </div>
                    <input type="submit" class="btn btn-dark" name="submit"/>
                </form>
            </div>
        </div>

    </body>
</html>