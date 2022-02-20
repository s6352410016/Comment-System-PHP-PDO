<?php

    session_start();
    include('db.php');

    if(isset($_POST['register'])){
       $fullname = $_POST['fullname']; 
       $username = $_POST['username']; 
       $password = md5($_POST['password']);

       $checkusername = $conn->prepare("SELECT * FROM data WHERE username = :username");
       $checkusername->bindParam(":username" , $username);
       $checkusername->execute();

       if($checkusername->rowCount() > 0){
           $_SESSION['error'] = "Username is already exist";
           header("location: register.php");
       }else{
           $insert = $conn->prepare("INSERT INTO data(fullname , username , password) VALUES(:fullname , :username , :password)");
           $insert->bindParam(":fullname" , $fullname);
           $insert->bindParam(":username" , $username);
           $insert->bindParam(":password" , $password);
           $insert->execute();

           if($insert){
            $_SESSION['success'] = "Register successfully";
            header("location: login.php"); 
           }
        }
    }
?>