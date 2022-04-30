<?php
SESSION_START();
include("koneksi.php");
$username = $_POST['username'];
$pass = md5($_POST['pass']);

$query = "SELECT id_user from user WHERE username= '".$username."' AND password ='".$pass."'";
$run = mysqli_query($koneksi,$query);
$count = mysqli_num_rows($run);
$get = mysqli_fetch_assoc($run);
if($count > 0){   
    $queryUpdate = "UPDATE user SET last_login = NOW() WHERE id_user = '".$get['id_user']."'";
    $runQuery = mysqli_query($koneksi,$queryUpdate);
    if($runQuery){
        $_SESSION['id_user'] = $get['id_user'];
        header("location:curl.php");
    }else{
        echo "error try again later";
    }
    
}
else{
    
}

?>