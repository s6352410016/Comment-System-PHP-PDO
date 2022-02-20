<?php

    session_start();
    include('db.php');

    if(isset($_POST['login'])){
        $username = $_POST['username']; 
        $password = md5($_POST['password']);

        $checklogin = $conn->prepare("SELECT * FROM data WHERE username = :username AND password = :password");
        $checklogin->bindParam(':username' , $username);
        $checklogin->bindParam(':password' , $password);
        $checklogin->execute();
        $data = $checklogin->fetch();

        if($checklogin->rowCount() > 0){
            $_SESSION["fullname"] = $data['fullname'];
            header("location: index.php");
        }else{
            $_SESSION['error'] = "Invalid Username or password";
            header("location: login.php");
        }
    }
?>