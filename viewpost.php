<!DOCTYPE html>
<html>
    <head> 
        <title>View Post</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>

    <?php
        require('main/init.php');
        require("includes/header.php");
        $post_id = $_GET['id'];
        $db = new Database();
        $post = $db->select("posts", ['text', 'image'], "`id`={$post_id}");
        $post_data = $post->fetch_assoc();
    ?>
    <body>

        <?php 
            require("includes/nav.php");
        ?>

        <div class="segment purple">
            <div class="container">

            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="column">
                    <img src=<?php print("{$post_data['image']}"); ?>>
                    <p>
                        <?php print("{$post_data['text']}");?>
                    </p>

                    <h4>Reviews</h4>
                    
                    <?php 
                        $reviews = $db->select("reviews", ['text'], "`post_id` = {$post_id}");
                        while($row = $reviews->fetch_assoc()){
                            ?>

                                <p>
                                    <?php print($row['text']);?>
                                </p>
                                <br/>

                            <?php
                        }
                    
                    ?>
                    <form action="main/post-review-helper.php" method="POST">
                        <input type="text" hidden value=<?php print($post_id) ?> name="post_id" />
                        <textarea name="review"></textarea>
                        <input type="submit" />
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
