<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet/css" href="css/main.css" />
    </head>
    <?php
        require("includes/header.php");
        require("main/init.php");
    ?>
    <body>
        <?php 
            require("includes/nav.php");
        ?>

        <div class="container">
            <h2>Posts</h2>
            <div class="row">
                <div class="column">
                    <?php 
                        $db = new Database();
                        $posts = $db->select('posts', ['id', 'user_id', 'text', 'image'], "1");

                        while($row = $posts->fetch_assoc()){
                            ?>

                                <div class="container">
                                    <a href=<?php print("viewpost.php?id={$row['id']}"); ?>>
                                        <img src=<?php print("{$row['image']}"); ?> />
                                    </a>
                                    <p><?php print("{$row['text']}"); ?></p>
                                </div>


                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
