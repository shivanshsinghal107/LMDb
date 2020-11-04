<?php

$username = $_COOKIE['username'];

$rating = $_POST['rating'];
$review = $_POST['review'];
$id = $_POST['id'];

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');
$query = "INSERT INTO sreviews (sid, username, rating, review) VALUES ('$id', '$username', '$rating', '$review')";
$res = mysqli_query($connection, $query);

if($res)
  echo "<script>alert('Rating & Review submitted'); window.location = window.history.back();</script>";
else
  echo "<script>alert('Error submitting rating & review'); window.location = window.history.back();</script>";

?>
