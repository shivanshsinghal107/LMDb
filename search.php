<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="static/index.css" rel="stylesheet">

  <style>
    h2{
      text-align: center;
      padding-top: 30px;
    }

    .card-body{
      background-color: #000;
    }
  </style>

  <title>LMDb</title>
</head>
<body style="background-color: #000; color: white;">

  <?php

  $search = $_GET['search'];
  echo "<h2>Search Results for '$search'</h2>";

  // connect to the database
  $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
  $found = false;
  $query = "SELECT * FROM movies WHERE name LIKE '%$search%' ORDER BY name";
  $res = mysqli_query($connection, $query);
  if(mysqli_num_rows($res) > 0){
    $found = true;
    echo "<div class='container-fluid'>";
    echo "<div class='row'><div class='row gy-4'>";
    for($i = 0; $i < mysqli_num_rows($res); $i++){
      $row = mysqli_fetch_assoc($res);
      $id = $row['id'];
      $name = $row['name'];
      $rating = $row['rating'];
      $img = "static/movies/image".$id.".jpg";
      echo "<div class='col-md-3 col-12'>";
      echo "<div class='card'>";
      echo "<img src='$img' class='card-img-top' alt='cover photo'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>$name ($rating)</h5>";
      //echo "<p class='card-text'>$rating</p>";
      echo "<form action='movies.php'><input type='hidden' name='id' value=$id>";
      echo "<button type='submit' class='btn btn-primary'>Visit</button></form>";
      echo "</div></div></div>";
    }
  }

  $query = "SELECT * FROM series WHERE name LIKE '%$search%'";
  $res = mysqli_query($connection, $query);
  if(mysqli_num_rows($res) > 0){
    if(!$found){
      echo "<div class='container-fluid'>";
      echo "<div class='row'><div class='row gy-4'>";
    }
    $found = true;
    for($i = 0; $i < mysqli_num_rows($res); $i++){
      $row = mysqli_fetch_assoc($res);
      $id = $row['id'];
      $name = $row['name'];
      $rating = $row['rating'];
      $img = "static/series/image".$id.".jpg";
      echo "<div class='col-md-3 col-12'>";
      echo "<div class='card'>";
      echo "<img src='$img' class='card-img-top' alt='cover photo'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>$name ($rating)</h5>";
      //echo "<p class='card-text'>$rating</p>";
      echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
      echo "<button type='submit' class='btn btn-primary'>Visit</button></form>";
      echo "</div></div></div>";
    }
  }

  if($found)
    echo "</div></div></div></div><br>";
  else
    echo "<script>alert('No results found'); window.location = window.history.back();</script>";

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
