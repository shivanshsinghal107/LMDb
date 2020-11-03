<html>
<body>

<?php

$conn = mysqli_connect("localhost", "root", "", "lmdb");
session_start();

if(!$conn)
  die("Connection Failed");
else{
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      $row = mysqli_fetch_assoc($res);
      $cpass = $row['password'];
    }
    else
      echo "<script>alert('Please register first'); window.location = 'http://localhost/lmdb/register.html';</script>";

    if($pass == $cpass){
      setcookie('username', $username, time() + (86400 * 30), "/");
      setcookie('password', $pass, time() + (86400 * 30), "/");
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $pass;
      echo "<script>alert('Login Successful, Welcome Back $username'); window.location = 'http://localhost/lmdb/lmdb.php'</script>";
    }
    else
      echo "Password entered is incorrect, Check your password and try again";
  }
  else
    echo "<script>window.location = 'http://localhost/lmdb/login.html';</script>";
}

?>

</body>
</html>
