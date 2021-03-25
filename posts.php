<?php

function get_posts($db) : string 
{
    $sql = 'SELECT * FROM `posts` WHERE `user_login` ='.$_SESSION['login'];
    
    if (!$req = $db->query($sql))
        return json_encode(array( 'posts_amount' => false ));

    return json_encode(array($req->fetch_assoc()));
}