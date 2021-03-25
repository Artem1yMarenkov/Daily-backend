<?php

function singin($db) : string 
{
    $login = trim(urldecode(htmlspecialchars($_POST['login'])));
    $password = md5(trim(urldecode(htmlspecialchars($_POST['password']))));

    $sql = "SELECT `password` FROM `users` WHERE `login`=".$login;

    if (!$req = $db->query($sql))
        return json_encode(array('login'=> false));

    elseif ($req->fetch_assoc() == 0) 
        return json_encode(array('login'=> false));

    elseif ($req->fetch_assoc()['password'] != $password)
        return json_encode(array('login'=> false));

    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $req->fetch_assoc()['password'];

    unset($login, $password, $sql);

    return json_encode(array('login' => true, 'session' => true));
}


function logout()
{
    unset($_SESSION);
    
    return json_encode(array('login' => false, 'session' => false));
}