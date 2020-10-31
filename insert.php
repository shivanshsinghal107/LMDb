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
echo "Connection Succesful"."<br>";
}
$name=$email=$username=$pass=$cpass='';
$flag=1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$name=$_POST["name"];
$email=$_POST["email"];
$username=$_POST["username"];
$pass=$_POST["pass"];
$cpass=$_POST["cpass"];
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$flag=0;
echo "Incorrect mail ID<br>";
}
if($pass!=$cpass)
{
$flag=0;
echo "passwords doesn't match <br>";
}
$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number    = preg_match('@[0-9]@', $pass);
$specialChars = preg_match('@[^\w]@', $pass);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
    echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
$flag=0;
}




if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
$flag=0;
echo "Check your name entry <br>";
}
$sql="Select * from users where username=$username";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
echo " username already taken, try using different username";
$flag=0;
}
$headers = "From: sv191000@gmail.com" . "\r\n" ;
ini_set("SMTP", "ssl://smtp.gmail.com");
ini_set("smtp_port", "465");
$subject="Registration Successful";
$body="We heartly welcome you to LMDB, Here you can check out review of movies and web series, and also can review the any show on our website"


if($flag)
{
$que="Insert into users(username,name,email,password) values ('$username','$name','$email','$pass')";
if(mysqli_query($conn,$que))
{
echo '<h4>Thank you for registering</h4>'."<br>";
if(mail($email, $subject, $body, $headers))
echo "Mail sent successfully";
else
echo "Error in sending mail";

}
else
{
echo "Error updating record: " . mysqli_error($conn)."<br>";
}
}
else
{
echo 'check your details again<br>';
}
?>
<a href='home.php'><h1>home page</h1></a>
</body>

</html>
