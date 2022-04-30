<?php
SESSION_START();
include("koneksi.php");
$movie = $_GET['id_list'];

echo $query = "DELETE from watchlist where id_list = '".$movie."'";
$runQuery = mysqli_query($koneksi,$query);

if($runQuery){
    header("location:watchList.php");
}else{
    echo "Error please try again later";
}

?>