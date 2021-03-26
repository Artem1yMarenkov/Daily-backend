<?php

require 'db.php';

/**
  sinup(): create new user account in db
*/

function singup($db) : string
{
    $login = trim(urldecode(htmlspecialchars($_POST['login'])));
    $password = md5(trim(urldecode(htmlspecialchars($_POST['password']))));


    # Check login len
    if (strlen($login) > 11 || strlen($login) < 4) {
      return json_encode(
        array('registration' => false, 'error' => 'login lenght is incorrect')
      );
    }

    # Check password len
    if (strlen($password) > 50 || strlen($password) < 6 ) {
      return json_encode(
        array('registration' => false, 'error' => 'password lenght is incorrect')
      );
    }


    # Prepare request to db
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


    # Send request to db
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

?>
