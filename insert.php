<html>
<body>

<?php

$conn = mysqli_connect("localhost", "root", "", "lmdb");
if(!$conn)
  die("Connection Failed");
else{
  $name = $email = $username = $pass = $cpass = '';
  $flag = 1;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $flag = 0;
      echo "Incorrect mail ID<br>";
    }

    if($pass != $cpass){
      $flag = 0;
      echo "Passwords doesn't match<br>";
    }

    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.<br>';
        $flag = 0;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)){
      $flag = 0;
      echo "Check your name entry<br>";
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      echo "Username already taken, try using different username";
      $flag = 0;
    }

    $headers = "From: shivanshsinghal107@gmail.com" . "\r\n" ;
    $subject = "Registration Successful";
    $body = "We heartily welcome you to LMDb, Here you can check out reviews and ratings of movies, web series & TV shows, and also can review any content";

    ini_set("SMTP", "ssl://smtp.gmail.com");
    ini_set("smtp_port", "465");

    if($flag){
      $que = "INSERT INTO users(username, name, email, password) VALUES ('$username','$name','$email','$pass')";
      if(mysqli_query($conn, $que)){
        echo '<h4>Thank you for registering</h4>'."<br>";
        setcookie('username', $username, time() + 7200, "/");
        setcookie('password', $pass, time() + 7200, "/");
        if(mail($email, $subject, $body, $headers))
          echo "<script>alert('Check your mail'); window.location = 'http://localhost/lmdb/lmdb.php'</script>";
        else
          echo "<script>alert('Error sending mail'); window.location = window.history.back();</script>";
      }
      else
        echo "Error updating record: " . mysqli_error($conn)."<br>";
    }
    else
      echo 'Check your details again<br>';
  }
  else
    echo "<script>window.location = 'http://localhost/lmdb/register.html';</script>";;
}

?>

<a href='lmdb.php'><h1>Home</h1></a>
</body>
</html>
