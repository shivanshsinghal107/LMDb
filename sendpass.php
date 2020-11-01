<html>
<body>
<?php
$conn=mysqli_connect("localhost","root","","lmdb");
if(!$conn)
{
die("Connection Failed");
}
else
{
$umail=$pass='';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$umail=$_POST["umail"];
}

if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
$sql="select email,password from users where usermame='$umail'";
if(mysqli_query($conn,$sql))
{
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$pass=$row['password'];
$umail=$row['email'];
}
else
{
echo "Error" . mysqli_error($conn)."<br>";
}
}
else
{
$sql="select password from uapp where email='$umail'";
if(mysqli_query($conn,$sql))
{
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$pass=$row['password'];
}
else
{
echo "Error" . mysqli_error($conn)."<br>";
}
}

$headers = "From: sv191000@gmail.com" . "\r\n" ;
ini_set("SMTP", "ssl://smtp.gmail.com");
ini_set("smtp_port", "465");
$subject="Forgot Passwprd";
$body="your current password is  ".$pass;

if(mail($email, $subject, $body, $headers))
echo "Mail sent successfully";
else
echo "Error in sending mail";

echo "<a href='sigin.php'> Go Back to Signin page</a>";
}
