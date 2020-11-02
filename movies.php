<?php

$id = $_GET['id'];
$image = 'image'.$id.'.jpg';
$path = "movies/$image";

$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'lmdb';

// connect to the database
$connection = mysqli_connect($host, $user, $password, $db_name);
$query = "SELECT * FROM `movies` WHERE id = '$id'";
$res = mysqli_query($connection, $query);

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
if($id > 10)
  $id -= 10;

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

?>
