<?php

require 'db.php';

function singup($db) : string
{
    $login = trim(urldecode(htmlspecialchars($_POST['login'])));
    $password = md5(trim(urldecode(htmlspecialchars($_POST['password']))));


    if (strlen($login) > 11 || strlen($login) < 4) {
      return json_encode(
        array('registration' => false, 'error' => 'login lenght is incorrect')
      );
    }


    if (strlen($password) > 50 || strlen($password) < 6 ) {
      return json_encode(
        array('registration' => false, 'error' => 'password lenght is incorrect')
      );
    }


    if (!($sql = $db->prepare("INSERT INTO `users` (`login`, `password`) VALUES (?, ?)"))) {
        return json_encode(
          array('registration' => false, 'error' => $sql->error)
        );
    }


    if (!($sql->bind_param("ss", $login, $password))) {
        return json_encode(
          array('registration' => false, 'error' => $sql->error)
        );
    }


    if (!$sql->execute()) {

        switch ($sql->error) {

          case "Duplicate entry '$login' for key 'PRIMARY'":
            return json_encode(
              array('registration' => false, 'error' => 'login is not available')
            );
            break;

          default:
            return json_encode(
              array('registration' => false, 'error' => $sql->error)
            );
            break;

        }
    }

    unset($login, $password, $sql);

    return json_encode(array('registration' => true, 'error' => false));
}

print_r(singup($mysqli));

?>
