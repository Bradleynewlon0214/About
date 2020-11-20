<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link ref="stylesheet/css" href="css/main.css" />
    </head>
    <?php
        require("main/init.php"); 
        require("includes/header.php");
    ?>

    <body>
        <?php 
            require("includes/nav.php");
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

            $db = new Database();

            $user = $db->select('users', ['id', 'username', 'profile_picture'], "`id`={$_SESSION['user']['id']}");
            $user_data = $user->fetch_assoc();
        
        ?>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <?php
            print($user_data['profile_picture']);
        ?>

            <div class="container">
                <div class="container">
                <div class="row">
                    <h2> Hello, <?php print($user_data['username']);?>!</h2>
                </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <img src=<?php print($user_data['profile_picture'])?>/>

                            <br/>

                            <form method="POST" action="main/upload-helper.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="uploadButton">Upload Profile Picture!</label>
                                    <input type="file" class="form-control-file" name="profile" id="uploadButton"/>
                                </div>
                                <input type="submit" class="btn btn-dark" name="submit"/>
                            </form>
                        </div>

                        <div class="col-lg-6">
                        <h3><a href="newpost.php" >New Post</a></h3>
                        </div>

                    </div>
                
                </div>
            </div>


            


    </body>
</html>