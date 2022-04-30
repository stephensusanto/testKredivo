<?php
SESSION_START();
include("koneksi.php");
if(!isset ($_SESSION['id_user'])){
    header("location:login.php"); 
}else{
    $movie = $_GET['id_movie'];
    $user = $_SESSION['id_user'];

    $query = "SELECT id_list from watchlist WHERE fk_id_user = '".$user."' and id_movie='".$movie."'";
    $runQuery = mysqli_query($koneksi,$query);
    $check =mysqli_num_rows($runQuery);
    if($check > 0){
        header("location:curl.php");
    }else{
        $insertWatchList ="INSERT into watchlist(fk_id_user, id_movie,date_add_list) VALUES('".$user."', '".$movie."', NOW())";
        $run = mysqli_query($koneksi,$insertWatchList);
        if($run){
            header("location:curl.php"); 
        }else{
            echo "Error please try again";
        }
    }
}


?>