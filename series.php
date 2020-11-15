<?php

$id = $_GET['id'];
$image = 'image'.$id.'.jpg';
$path = "static/series/$image";

$flag = 0;

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');
$query = "SELECT * FROM series WHERE id = '$id'";
$res = mysqli_query($connection, $query);

if(mysqli_num_rows($res) > 0){
  $row = mysqli_fetch_assoc($res);
  $name = $row['name'];
  $genre = $row['genre'];
  $rating = $row['rating'];
  $year = $row['year'];
  $duration = $row['duration'];
  $seasons = $row['seasons'];
  $episodes = $row['episodes'];
  $plot = $row['plot'];
  $cast = $row['cast'];

  $actors = explode(", ", $cast);
  if($id > 10 && $id <= 20){
    $id -= 10;
    $flag = 1;
  }
  else if($id > 20){
    $id -= 20;
    $flag = 2;
  }

  echo "<img src='$path' style='width:400px;height:600px; float:left; margin-right: 25px;' alt='cover photo'>";
  echo "<h1>$name (Rank: $id)</h1>";
  echo "<h2>Genres: $genre<br>";
  echo "Rating: $rating<br>";
  echo "Release: $year<br>";
  echo "Seasons: $seasons<br>";
  echo "Episodes: $episodes<br>";
  echo "Avg. Duration: $duration minutes<br></h2>";
  echo "<h2>Cast:</h2><h3><ul>";
  for($i = 0; $i < count($actors); $i++){
    $actor = explode(" /", $actors[$i]);
    echo "<li>".$actor[0];
    if(count($actor) > 1)
      echo ")";
    echo "</li>";
  }
  echo "</ul></h3>";
  echo "<h2>Plot:</h2><h3>$plot</h3>";

  if($flag == 1)
    $id += 10;
  else if($flag == 2)
    $id += 20;

  if(isset($_COOKIE['username'])){
    echo "<form action='sreview.php' method='POST'>";
    echo "Rating: <input type='number' name='rating' min='1' max='10'><br>";
    echo "Review: <input type='text' name='review'><br>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='submit'></form>";
  }
}
else
  echo "<script>alert('Select some series'); window.location = 'http://localhost/lmdb/lmdb.php';</script>";

?>
