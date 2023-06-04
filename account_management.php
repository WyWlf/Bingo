<?php
session_start();
require 'connection.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $encrypt_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_username = "SELECT username from user_accounts where username = ?";
    $sth_check = $conn->prepare($check_username);
    $sth_check->bindParam(1, $_POST['username'], PDO::PARAM_STR);
    $sth_check->execute();

    $bool = $sth_check->rowCount();

    if ($bool == 1){
        echo "Username is already registered";
    } else {


    $sql = "INSERT INTO user_accounts (username, password, type) SELECT * FROM ( SELECT ? AS username, ? AS password, ? AS type) AS tmp 
    WHERE NOT EXISTS (
        SELECT * FROM user_accounts where username = ?
    ) LIMIT 1";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $_POST['username'], PDO::PARAM_STR);
        $sth->bindParam(2, $encrypt_pass, PDO::PARAM_STR);
        $sth->bindParam(3, $_POST['type'], PDO::PARAM_STR);
        $sth->bindParam(4, $_POST['username'], PDO::PARAM_STR);
        $sth->execute();
        echo"Account successfully registered";
}} else {
    echo "Please fill all the required fields";
}
