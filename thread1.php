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
    $id = $_GET['id'];
    $sql = "SELECT * FROM `threads` WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $tname = $row['title'];
        $tdesc = $row['th_desc'];
        $tid = $row['id'];
        $id = $row['user_id'];
        $sql1 = "SELECT uemail FROM `users` where sno=$id";
        $res2 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($res2);
        $postedby = $row1['uemail'];
    }
    ?>
    <?php
    $a = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $com = $_POST['comment'];
        $com = str_replace("<", "&lt;", $com);
        $com = str_replace(">", "&gt;", $com);
        $sno = $_SESSION['sno'];
        if ($com != null) {
            $sql = "INSERT INTO `comments` ( `content`, `tid`,`cby`, `dt`) VALUES ('$com', '$tid','$sno', current_timestamp())";
            $res = mysqli_query($conn, $sql);
            $a = true;
        }
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
            <h1 class="display-4 text-center"> <?php echo $tname; ?> </h1>
            <p class="lead"> <?php echo $tdesc; ?> </p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <b>Posted By :<b><?php echo $postedby; ?> </b></b>
            </p>
        </div>
    </div>

    <?php

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        echo ' <div class="container" id="ques">
        <h1> Post Your Comment</h1>
        <form action="".echo $_SERVER["REQUEST_URI"]."" method="post">

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Type your Comment</label>
        <div class="form-floating"> 
            <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea2"style="height: 100px"></textarea>
            <label for="floatingTextarea2"></label> 
            
    </div>
    </div>
    <button type="submit" class="btn btn-success">Post Comment</button>
    </form>';
    } else {

        echo '<div class="container">
        <div class="alert alert-info" role="alert">
            Login! for Comment
        </div>';
    }
    ?>
    <div class="container" id="ques">


        <?php
        $sql = "SELECT * FROM `comments` where tid='$tid'";
        $res = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($res);
        $alert = false;
        if ($num == 0) {
            $alert = true;
        }
        while ($row = mysqli_fetch_assoc($res) and $num > 0) {
            $time = $row['dt'];
            $c = $row['content'];


            $id = $row['cby'];

            $sql1 = "SELECT uemail FROM `users` where sno=$id";
            $res2 = mysqli_query($conn, $sql1);
            $row2 = mysqli_fetch_assoc($res2);
            echo '<div class="media my-2">
            <img class="mr-3" width=30px src="data:image/png;base64,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" alt="Generic placeholder image">
            <h6 class="font-weight-bold my-0 " style="float:right;">Asked by:' . $row2['uemail'] . ' at ' . $time . '</h6>
            <div class="media-body">
              
              ' . $c . '
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