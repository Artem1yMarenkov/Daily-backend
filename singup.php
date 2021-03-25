<?php 

function singup($db) : string 
{
    $login = trim(urldecode(htmlspecialchars($_POST['login'])));
    $password = md5(trim(urldecode(htmlspecialchars($_POST['password']))));

    $sql = "INSERT INTO `users` (`login`, `password`) VALUES ($login, $password)";

    if (!$db->query($sql)) {
        return json_encode(array('registration'=> false));
    }

    unset($login, $password, $sql);

    return json_encode(array('registration'=> true));
}
