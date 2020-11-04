<?php

$id = $_GET['id'];
$image = 'image'.$id.'.jpg';
$path = "movies/$image";

$flag = 0;

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');
$query = "SELECT * FROM movies WHERE id = '$id'";
$res = mysqli_query($connection, $query);

if(mysqli_num_rows($res) > 0){
  $row = mysqli_fetch_assoc($res);
  $name = $row['name'];
  $genre = $row['genre'];
  $rating = $row['rating'];
  $year = $row['year'];
  $duration = $row['duration'];
  $plot = $row['plot'];
  $cast = $row['cast'];
  $budget = $row['budget'];
  //$gross = $row['worldwide_gross'];

  $actors = explode(", ", $cast);
  if($id > 10){
    $id -= 10;
    $flag = 1;
  }

  echo "<img src='$path' style='width:400px;height:100%; float:left; margin-right: 25px;' alt='cover photo'>";
  echo "<h1>$name (Rank: $id)</h1>";
  echo "<h2>Genres: $genre<br>";
  echo "Rating: $rating<br>";
  echo "Release: $year<br>";
  echo "Duration: $duration minutes<br></h2>";
  echo "<h2>Cast:</h2><h3><ul>";
  for($i = 0; $i < count($actors); $i++){
    $actor = explode("/", $actors[$i]);
    echo "<li>".$actor[0];
    if(count($actor) > 1)
      echo ")";
    echo "</li>";
  }
  echo "</ul></h3>";
  echo "<h2>Plot:</h2><h3>$plot</h3>";
  echo "<h2>Budget: $budget</h2>";

  if($flag)
    $id += 10;

  if(isset($_COOKIE['username'])){
    echo "<form action='mreview.php' method='POST'>";
    echo "Rating: <input type='number' name='rating' min='1' max='10'><br>";
    echo "Review: <input type='text' name='review'><br>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='submit'></form>";
  }
}
else
  echo "<script>alert('Select some movie'); window.location = 'http://localhost/lmdb/lmdb.php';</script>";

?>
