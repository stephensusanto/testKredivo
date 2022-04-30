<?php
include("koneksi.php");
$username = $_POST['username'];
$pass = md5($_POST['pass']);

$query = "INSERT INTO user(username, password, date_join) VALUES('".$username."', '".$pass."', NOW())";
$run = mysqli_query($koneksi,$query);
if($run){
    header("location:login.php");
}
else{
    echo "error try again later";
}

?>