<?php

$username = $_COOKIE['username'];

echo "<h1>$username's Profile</h1>";

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');
$query = "SELECT time, rating, review, type, mid AS id FROM mreviews WHERE username = '$username' UNION SELECT time, rating, review, type, sid AS id FROM sreviews WHERE username = '$username' ORDER BY time DESC";
$res = mysqli_query($connection, $query);

echo "<table border='0px'>";
//echo "<tr>";
//echo "<th></th>";
//echo "<th>Name</th>";
//echo "<th>Rating</th>";
//echo "<th>Review</th>";
//echo "</tr>";
echo mysqli_error($connection);
for($i = 0; $i < mysqli_num_rows($res); $i++){
  $row = mysqli_fetch_assoc($res);
  if($row['type'] == 'movies'){
    $id = $row['id'];
    $que = "SELECT * FROM movies WHERE id = '$id'";
    $img = "movies/image".$id.".jpg";
  }
  else{
    $id = $row['id'];
    $que = "SELECT * FROM series WHERE id = '$id'";
    $img = "series/image".$id.".jpg";
  }
  $rating = $row['rating'];
  $review = $row['review'];

  $result = mysqli_query($connection, $que);
  $content = mysqli_fetch_assoc($result);

  $name = $content['name'];

  echo "<tr>";
  echo "<td><img src='$img' style='width:155px;height:225px;' alt='cover photo'></td>";
  echo "<td>$name</td>";
  echo "<td>$rating</td>";
  echo "<td>$review</td>";
  echo "</tr>";
}

// $query = "SELECT * FROM sreviews WHERE username = '$username'";
// $res = mysqli_query($connection, $query);
//
// for($i = 0; $i < mysqli_num_rows($res); $i++){
//   $row = mysqli_fetch_assoc($res);
//   $sid = $row['sid'];
//   $rating = $row['rating'];
//   $review = $row['review'];
//
//   $que = "SELECT * FROM series WHERE id = '$sid'";
//   $result = mysqli_query($connection, $que);
//   $series = mysqli_fetch_assoc($result);
//
//   $name = $series['name'];
//   $img = "image".$sid.".jpg";
//
//   echo "<tr>";
//   echo "<td><img src='series/$img' style='width:155px;height:225px;' alt='cover photo'></td>";
//   echo "<td>$name</td>";
//   echo "<td>$rating</td>";
//   echo "<td>$review</td>";
//   echo "</tr>";
// }

echo "</table>";

?>
