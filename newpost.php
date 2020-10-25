<!DOCTYPE html>
<html>
    <head> 
        <title>Profile</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>

    <?php
        require("includes/header.php");
        require("main/init.php");
    ?>
    <body>
        <?php 
            require("includes/nav.php");
        ?>
        <div class="segment"></div>


        <div class="container">
            <h3>New Post!</h3>
            <form method="POST" action="main/post-helper.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="uploadButton">Upload Image</label>
                    <input type="file" class="form-control-file" name="cover" id="uploadButton" />
                    <textarea name="text"></textarea>
                </div>
                <input type="submit" class="btn btn-dark" name="submit"/>
            </form>
        </div>


    </body>
</html>