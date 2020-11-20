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
        $post = $db->select("posts", ['title', 'text', 'images'], "`id`={$post_id}");
        $post_data = $post->fetch_assoc();
        $images = json_decode($post_data['images']);
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

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <?php 
                                $count = 0;
                                foreach($images as $image){
                                    if($count > 0){
                                        ?>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src=<?php print($image); ?>>
                                            </div>
                                        <?php
                                    } else{
                                        ?>
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src=<?php print($image); ?>>
                                            </div>
                                        <?php
                                    }
                                    
                                    $count++;
                                }


                            ?>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                    <br />
                    <br />

                    <h2><?php print($post_data['title']);?></h2>

                    <p>
                        <?php print("{$post_data['text']}");?>
                    </p>

                    <h4>Comments</h4>
                    
                    <ul class="list-group">
                        <?php 
                            $reviews = $db->select("reviews", ['text'], "`post_id` = {$post_id}");
                            while($row = $reviews->fetch_assoc()){
                                ?>

                                    <li class="list-group-item">
                                        <?php print($row['text']);?>
                                    </li>
                                    <br/>

                                <?php
                            }
                        
                        ?>
                    </ul>

                    <form action="main/post-review-helper.php" method="POST">
                        <div class="form-group">
                            <input class="form-control" type="text" hidden value=<?php print($post_id) ?> name="post_id" />
                            <textarea class="form-control" name="review" placeholder="Comment Here"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
