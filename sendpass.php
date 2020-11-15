<html>
<body>

<?php

$conn = mysqli_connect("localhost", "root", "", "lmdb");
if(!$conn)
  die("Connection Failed");
else{
  $username = $_GET['username'];

  $sql = "SELECT * FROM users WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
    $pass = $row['password'];
    $email = $row['email'];

    $headers = "From: shivanshsinghal107@gmail.com" . "\r\n" ;
    $subject = "Forgot Password";
    $body = "Your current password is $pass";

    ini_set("SMTP", "ssl://smtp.gmail.com");
    ini_set("smtp_port", "465");

    if(mail($email, $subject, $body, $headers))
      echo "<script>alert('Check your mail for password'); window.location = 'http://localhost/lmdb/login.html';</script>";
    else
      echo "<script>alert('Error sending mail');</script>";
  }
  else
    echo "<script>alert('Please register first'); window.location = 'http://localhost/lmdb/register.html';</script>";
}

?>

</body>
</html>
