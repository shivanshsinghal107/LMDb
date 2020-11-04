<?php

session_start();

echo "<h3>Logged out successfully</h3>";
echo "<a href='lmdb.php'>Home</a>";

unset($_COOKIE['username']);
unset($_COOKIE['password']);
setcookie('username', '', time() - 3600);
setcookie('password', '', time() - 3600);

session_unset();

?>
