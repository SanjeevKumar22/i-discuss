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
    .co {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/_header.php'; ?>


    <div class="container my-3 co">
        <h1 class="py-2">Search Results for <?php echo $_GET['search'] ?></h1>

        <?php 
        $query=$_GET["search"];

        $sql="SELECT * FROM `threads` WHERE MATCH(title,th_desc) against ('$query')" ;
        $res=mysqli_query($conn, $sql);
        $no=mysqli_num_rows($res); 
            while ($row=mysqli_fetch_assoc($res) and $no>0) { 
                    $tname=$row['title'];
                    $tdesc=$row['th_desc']; 
                    $tid=$row['id'];
                    $url="thread1.php?id=".$tid;
              
                    echo '<div class="result">
                                        <h2> <a href='."$url".' class="text-dark">'.$tname.'</a>
                                        </h2>
                                        <p>'.$tdesc.'</p>
            
                         </div>' ;
                }
                if($no==0){

                        echo '<div class="jumbotron jumbotron-fluid bg-light">
                        <div class="container">
                        <h1 class="display-4">No Results Found</h1>
                        <p class="lead">Your search - '.$_GET["search"].' - did not match any documents.

                        Suggestions:
                        
                        </p>
                        <p>
                        Make sure that all words are spelled correctly.
                        <p>
                        Try different keywords.
                        </p>
                        <p>
                        Try more general keywords.</p>
                        </p>
                        </div>
                        </div>';

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