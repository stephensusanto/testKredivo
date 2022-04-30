<?php
SESSION_START();
include("fungsi.php");
include("koneksi.php");
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$api_key = "89daf5876750f560bb45bd0721931962";
$baseImage = "https://image.tmdb.org/t/p/w500";



?>

<!DOCTYPE html>
<html>
<head>
    <title>Watch List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
</head>

<body>
    <center><h1> Your Watch List Movie</h1></center>
    <div class="row">
        <div class="col-lg-8">

        </div>
        <center>
        <div class="col-lg-4">
            <a href = 'curl.php'>back to list Movie </a>
        </div>
</center>
    </div>
    <div class="container">
        <div class="row">
        <?php   
        $query = "SELECT id_movie, id_list FROM watchlist WHERE fk_id_user='".$_SESSION['id_user']."'" ;
        $runQuery = mysqli_query($koneksi,$query);
        while($d = mysqli_fetch_assoc($runQuery)){
            $listMovie = http_request("https://api.themoviedb.org/3/movie/".$d['id_movie']."?api_key=".$api_key);
            $movie = json_decode($listMovie, TRUE);
            echo "<div class='col-lg-3'>";
                echo "<center><img widht='200px' height='200px' src='".$baseImage."".$movie['poster_path']."'</img><br>".$movie['original_title']."</center>";
                echo "<center>
                <a href='deleteList.php?id_list=".$d['id_list']."'>
                    <button>Remove From List</button>
                </a>
                </center><br>";
                echo "</div>";
        }
        
        // ubah string JSON menjadi array
    
            ?>
        </div>
    </div>
  


</body>
</html>