<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $lemail = $_POST['loginemail'];
    $lpass = $_POST['loginpass'];
    $sql = "select * from `users` where uemail='$lemail'";
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($res);

        if (password_verify($lpass, $row['upass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $lemail;
            $_SESSION['sno'] = $row['sno'];
            header("Location:/forum/index.php?b=true");
        }
    }
}