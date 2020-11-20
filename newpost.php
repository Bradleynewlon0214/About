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

        <br />
        <br />
        <br />
        <br />


        <div class="container">
            <div class="row">
            
                <div class="col-lg-12">

                    <h3>New Post!</h3>
                    <form method="POST" action="main/post-helper.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="uploadButton">Upload Image(s)</label>
                            <input type="file" class="form-control-file" name="files[]" id="uploadButton" multiple/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title" />
                            <textarea class="form-control" name="text" placeholder="Content"></textarea>
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-dark" name="submit"/>
                        </div>

                       
                    </form>


                </div>
            
            </div>
            
        </div>


    </body>
</html>