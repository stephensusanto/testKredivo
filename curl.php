<?php
SESSION_START();
include("fungsi.php");

if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$api_key = "89daf5876750f560bb45bd0721931962";
$baseImage = "https://image.tmdb.org/t/p/w500";
$listMovie = http_request("https://api.themoviedb.org/4/list/1?page=".$page."&api_key=".$api_key);

// ubah string JSON menjadi array
$list = json_decode($listMovie, TRUE);
$numberPage = $list['total_pages'] ;

$page_first_result = ($page-1) * count($list['results']);  
?>

<!DOCTYPE html>
<html>
<head>
    <title>Watch List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .pagination {
        display: inline-block;
        }

        .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        }

        .pagination a.active {
        background-color: #4CAF50;
        color: white;
        }

        .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
</head>

<body>
    <center><h1> Watch List Movie</h1></center>
    <div class="row">
        <div class="col-lg-8">

        </div>
        <center>
            <?php
            if(!isset ($_SESSION['id_user'])){
                ?>
                <div class="col-lg-4">
                <a href='register.php'>Join us</a>
                <a href='login.php'> Sign in</a>
            </div>
            <?php
            }else{
                ?>
                <div class="col-lg-4">
                <a href='watchList.php'> Check Your Watch List</a>
            </div>
            <?php
            }
            ?>
        </center>
    </div>
    <div class="container">
        <div class="row">
        <?php     
          for ($i = 0; $i<count($list['results']); $i++){
                echo "<div class='col-lg-3'>";
                echo "<center><img widht='200px' height='200px' src='".$baseImage."".$list['results'][$i]['poster_path']."'</img><br>".$list['results'][$i]['original_title']."</center>";
                echo "<center>
                <a href='prosesList.php?id_movie=".$list['results'][$i]['id']."'>
                    <button>Add to Wishlist</button>
                </a>
                </center><br>";
                echo "</div>";
            } 
            ?>
        </div>
    </div>
    <center>
    <div class="pagination">
        <?php
        for($page = 1; $page<= $numberPage; $page++) {  
            $pages = (!isset ($_GET['page']))?1:$_GET['page'];
            $class = ($pages == $page)?"active":"";
            echo '<a href = "curl.php?page=' . $page . '"class="'.$class.'">' . $page . ' </a>';  
        } 
        ?>
    </div>


</body>
</html>