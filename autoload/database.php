<?php

$dns = 'mysql:host=127.0.0.1;dbname=zoo';
$user = 'root';
$password = '';

try {
    $db = new PDO($dns, $user, $password);
    // echo "connexion established" ;

} catch (Exception $message) {
    echo "There is an issue <br>" . "<pre>$message</pre>";
}

return $db;