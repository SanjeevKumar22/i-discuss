<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = 'SELECT cat_name,cat_id FROM `categories` LIMIT 3';
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    echo '<li><a class="dropdown-item" href="thread.php?catid=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></li>';
}
echo ' </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
        </ul>';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    echo ' <form class="d-flex" action="search.php" method="get">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                
                
            </form><p class="text-light mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
            <a href="partial/logout.php" class="btn btn-success" type="submit">Logout</a>';
} else {
    echo '
            <form class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <div class="mx-2">
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>
        </div>';
}

echo '</div>
</div>
</nav>';
include 'partial/_signup.php';
include 'partial/_login.php';

if (isset($_GET['a']) && $_GET['a'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Signup Successful.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

if (isset($_GET['b']) && $_GET['b'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Login Successful.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
// else
// {
//     echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//     <strong>Falied!</strong> Login Unsuccessful.
//     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//   </div>';
// }
if (isset($_GET['c']) && $_GET['c'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Logout Successful.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}