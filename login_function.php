<?php
session_start();
require 'connection.php';

if(!empty($_POST['username']) && !empty($_POST['password'])){
    $hashed_pw = "SELECT password,type from user_accounts where username = ?";
    $sth = $conn->prepare($hashed_pw);
    $sth -> bindParam(1, $_POST['username'], PDO::PARAM_STR);
    $sth -> execute();
    $count = $sth->rowCount();
    $result = $sth->fetch(PDO::FETCH_ASSOC);


    if ($count > 0){
        $decrpyt_pass = password_verify($_POST['password'], $result['password']);
        if ($decrpyt_pass == 1){
            $_SESSION['user'] = $_POST['username'];
            echo $result['type'];
        } else {
            echo "Wrong Password";
            echo $decrpyt_pass;
        }
    } else {
        echo "Account not found";
    }
    
} else {
    echo "Check your inputs and try again";
}
?>