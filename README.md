# Daily-backend doc
Backend for our little pet project on PHP/MySQL and JavaScript.

[Our frontend rep](https://github.com/TigranZakk/daily)

## How it works?
### About creating new user
To create new user you need send POST request to `singup.php` file.

This script take two POST params :

```php
$login = $_POST['login'];
$password = $_POST['password'];
```
After that script start checking of input data. You can meet errors of this type in json:
1.'login lenght is incorrect' error: It means that login lenght is less than 4 or longer than 11.
2.'password lenght is incorrect' error: It means that password lenght is less than 8 or longer than 50. 


Then script sends data to db and return report about it in json

##### To be continued...
