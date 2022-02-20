<?php
    session_start();
    include('db.php');

    if(!isset($_SESSION["fullname"])){
        header("location:");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background-color: #ededed;
        }
        .comment{
            width: 100%;
            height: 300px;
            overflow: scroll;
            background-color: #f8f9fa;
        } 
        .comment h5{
            margin: 10px 10px; 
        }
        .flex{
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="flex">
            <h2 style="text-align: center;" class="mt-5">Welcome : <?php echo $_SESSION["fullname"]; ?></h2>
            <a href="logout.php" class="btn btn-danger mt-5">Logout</a>
        </div>
        <h2 class="mt-4">Comment</h2>
        <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php } ?> 
            <div class="comment">
                <?php 
                    $data = $conn->query("SELECT * FROM message");
                    $data->execute();
                    $fetchdata = $data->fetchAll();
                    foreach($fetchdata as $result){
                ?>
                <h5><?php echo $result['fullname'] . " :" . " ". $result['message']; ?></h5>
                <?php } ?>
            </div>
        <form class="form-floating mt-3" action="comment_action.php" method="POST" id="form">
            <textarea name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Comments</label>
            <button type="submit" name="comment" class="btn btn-primary mt-3">Comment</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>