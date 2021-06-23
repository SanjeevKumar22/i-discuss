<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Welcome to i-Discuss-Coder Forums</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/_header.php'; ?>
    <?php
    $id = $_GET['catid'];



    $sql = "SELECT * FROM `categories` WHERE cat_id=$id";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $catname = $row['cat_name'];
        $catdesc = $row['cat_desc'];
        $catid = $row['cat_id'];
    }
    ?>
    <?php
    $a = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = $_POST['title'];
        $title = str_replace("<", "&lt;", $title);
        $title = str_replace(">", "&gt;", $title);
        $sno = $_SESSION['sno'];

        $desc = $_POST['st'];
        $desc = str_replace("<", "&lt;", $desc);
        $desc = str_replace(">", "&gt;", $desc);
        $tid = $_SESSION['sno'];
        $sql = "INSERT INTO `threads` (`title`, `th_desc`, `catid`, `user_id`, `dt`) VALUES ('$title', '$desc', '$catid', '$tid', current_timestamp())";
        $res = mysqli_query($conn, $sql);
        $a = true;
    }
    ?>
    <?php if ($a) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully!</strong> Submitted.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } ?>

    <div class="container">
        <div class="jumbotron bg-light my-4">
            <h1 class="display-4 text-center">Welcome <?php echo $catname; ?> Forum</h1>
            <p class="lead"> <?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        echo ' 
    <div class="container">
        <h1>Start Discussions</h1>
        <form action="". echo $_SERVER["REQUEST_URI"];."" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Elaborate your Problem</label>
        <div class="form-floating">
            <textarea class="form-control" name="st" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2"></label>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>
    </div>';
    } else {

        echo '<div class="container">
        <div class="alert alert-info" role="alert">
            Login! to Elaborate your Problem
        </div>';
    }
    ?>
    <div class="container" id="ques">


        <?php

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE catid=$id";
        $res = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($res);
        $alert = false;
        if ($num == 0) {
            $alert = true;
        }
        while ($row = mysqli_fetch_assoc($res) and $num > 0) {
            $tname = $row['title'];
            $tdesc = $row['th_desc'];
            $ttime = $row['dt'];
            $id = $row['user_id'];
            $sql1 = "SELECT uemail FROM `users` where sno=$id";
            $res2 = mysqli_query($conn, $sql1);
            $row2 = mysqli_fetch_assoc($res2);

            echo '<div class="media my-3">
                    <img src="https://source.unsplash.com/64x64/?nature,water" class="mr-3" alt="...">
                    <div  class="media-body">
                     <h6 class="font-weight-bold my-0" style="float:right;">Asked by: ' . $row2['uemail'] . ' at ' . $ttime . '</h6>
                        <h5 class="mt-0"><a class="text-dark" href="thread1.php?id=' . $row['id'] . '">' . $tname . '</a></h5>
                        <p>' . $tdesc . '</p> 
                    </div>
                   
                </div>';
        }
        ?>
        <?php
        if ($alert) {
            echo '<p>Be the first person to Question</p>';
        }
        ?>


    </div>




    <?php include 'partial/_footer.php'; ?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>