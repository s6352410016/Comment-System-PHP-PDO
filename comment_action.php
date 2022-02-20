<?php

    session_start();
    include('db.php');

    if(isset($_POST['comment'])){
        if(empty($_POST['message'])){
            $_SESSION['error'] = "You must add comment";
            header("location: index.php");
        }else{
            $message = $_POST['message'];
            $fullname = $_SESSION["fullname"];
            $sql = $conn->prepare("INSERT INTO message(fullname , message) VALUES(:fullname , :message)");
            $sql->bindParam(":message" , $message);
            $sql->bindParam(":fullname" , $fullname);
            $sql->execute();

            if($sql){
                header("location: index.php");
            }
        }
    }
?>