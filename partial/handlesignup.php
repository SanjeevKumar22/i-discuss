<?php
$showerr='false';
$a=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $username=$_POST['signupemail'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $existsql="select * from `users` where uemail='$username'";
    $res=mysqli_query($conn,$existsql);
    $num=mysqli_num_rows($res);
    if($num>0){
        $showerr='Email is already exists';
    }
    else{
        if($pass==$cpass){
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` (`uemail`, `upass`,`dt`) VALUES ('$username', '$hash', current_timestamp())";
                $res=mysqli_query($conn,$sql);
                if($res){
                    $showerr=true;
                    header("Location:/forum/index.php?a=true");
                }
        }
        else{
            $showerr='Password do not match';
           
           
        }
    }
    // header("Location:/forum/index.php?success=false&error=$showerr");
}
?>