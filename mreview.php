<?php

$username = $_COOKIE['username'];

$rating = $_POST['rating'];
$review = $_POST['review'];
$id = $_POST['id'];

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'lmdb');

$query = "SELECT * FROM mreviews WHERE mid = '$id' AND username = '$username'";
$res = mysqli_query($connection, $query);
if(mysqli_num_rows($res) > 0){
  $query = "UPDATE mreviews SET rating = '$rating', review = '$review' WHERE mid = '$id' AND username = '$username'";
  $res = mysqli_query($connection, $query);

  if($res)
    echo "<script>alert('Rating & Review updated'); window.location = window.history.back();</script>";
  else
    echo "<script>alert('Error updating rating & review'); window.location = window.history.back();</script>";
}
else{
  $query = "INSERT INTO mreviews (mid, username, rating, review) VALUES ('$id', '$username', '$rating', '$review')";
  $res = mysqli_query($connection, $query);

  if($res)
    echo "<script>alert('Rating & Review submitted'); window.location = window.history.back();</script>";
  else
    echo "<script>alert('Error submitting rating & review'); window.location = window.history.back();</script>";
}

?>
