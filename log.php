<html>
<body>
<?php
$conn=mysqli_connect("localhost","root","","lmdb");
session_start();
if(!$conn)
{
die("Connection Failed");
}
else
{


$umail=$pass='';

$flag=1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$umail=$_POST["umail"];
$pass=$_POST["pass"];
}

if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
$sql="select password from users where usermame='$umail'";
if(mysqli_query($conn,$sql))
{
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$cpass=$row['password'];
}
else
{
echo "Error" . mysqli_error($conn)."<br>";
}
}
else
{
$sql="select username,password from uapp where email='$umail'";
if(mysqli_query($conn,$sql))
{
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$cpass=$row['password'];
$umail=$row['username'];
}
else
{
echo "Error" . mysqli_error($conn)."<br>";
}
}
if($pass==$cpass)
{
echo "<h4> Login Successful, Welcome Back $umail </h4>";
setcookie('Username', $umail, time() + (86400 * 30), "/");
setcookie('Password', $pass, time() + (86400 * 30), "/");
session['Username']=$umail;
session['Password']=$pass
}
else
{
echo "Password entered is incorrect, Check your password and try again";
}
}

