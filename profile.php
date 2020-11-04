<?php

$username = $_COOKIE['username'];

echo "<h1>$username's Profile</h1>";

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');
$query = "SELECT * FROM mreviews WHERE username = '$username'";
$res = mysqli_query($connection, $query);

echo "<table border='0px'>";
//echo "<tr>";
//echo "<th></th>";
//echo "<th>Name</th>";
//echo "<th>Rating</th>";
//echo "<th>Review</th>";
//echo "</tr>";
for($i = 0; $i < mysqli_num_rows($res); $i++){
  $row = mysqli_fetch_assoc($res);
  $mid = $row['mid'];
  $rating = $row['rating'];
  $review = $row['review'];

  $que = "SELECT * FROM movies WHERE id = '$mid'";
  $result = mysqli_query($connection, $que);
  $movie = mysqli_fetch_assoc($result);

  $name = $movie['name'];
  $img = "image".$mid.".jpg";

  echo "<tr>";
  echo "<td><img src='movies/$img' style='width:155px;height:225px;' alt='cover photo'></td>";
  echo "<td>$name</td>";
  echo "<td>$rating</td>";
  echo "<td>$review</td>";
  echo "</tr>";
}

$query = "SELECT * FROM sreviews WHERE username = '$username'";
$res = mysqli_query($connection, $query);

for($i = 0; $i < mysqli_num_rows($res); $i++){
  $row = mysqli_fetch_assoc($res);
  $sid = $row['sid'];
  $rating = $row['rating'];
  $review = $row['review'];

  $que = "SELECT * FROM series WHERE id = '$sid'";
  $result = mysqli_query($connection, $que);
  $series = mysqli_fetch_assoc($result);

  $name = $series['name'];
  $img = "image".$sid.".jpg";

  echo "<tr>";
  echo "<td><img src='series/$img' style='width:155px;height:225px;' alt='cover photo'></td>";
  echo "<td>$name</td>";
  echo "<td>$rating</td>";
  echo "<td>$review</td>";
  echo "</tr>";
}

echo "</table>";

?>
