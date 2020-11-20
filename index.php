<!DOCTYPE html>
<html>
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
                <div class="col-sm-8 blog-main">
                    <?php 
                        $db = new Database();
                        $posts = $db->select('posts', ['id', 'user_id', 'title', 'text', 'images'], "1");
                        
                        while($row = $posts->fetch_assoc()){
                            ?>

                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <h2 class="card-title"><a href=<?php print("viewpost.php?id={$row['id']}"); ?>>
                                            <?php print($row['title']); ?>
                                        </a></h2>
                                        <p class="card-text"><?php print("{$row['text']}"); ?></p>
                                    </div>
                                </div>


                            <?php
                        }
                    ?>
                </div>

                <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset">
                        <h4>About</h4>
                        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    </div>
                    <div class="sidebar-module">
                        <h4>Archives</h4>
                        <ol class="list-unstyled">
                        <li><a href="#">March 2014</a></li>
                        <li><a href="#">February 2014</a></li>
                        <li><a href="#">January 2014</a></li>
                        <li><a href="#">December 2013</a></li>
                        <li><a href="#">November 2013</a></li>
                        <li><a href="#">October 2013</a></li>
                        <li><a href="#">September 2013</a></li>
                        <li><a href="#">August 2013</a></li>
                        <li><a href="#">July 2013</a></li>
                        <li><a href="#">June 2013</a></li>
                        <li><a href="#">May 2013</a></li>
                        <li><a href="#">April 2013</a></li>
                        </ol>
                    </div>
                    <div class="sidebar-module">
                        <h4>Elsewhere</h4>
                        <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
