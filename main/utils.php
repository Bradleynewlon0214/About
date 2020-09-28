<?php
    function sanitize($data){
        return htmlentities(strip_tags($data));
    }
?>