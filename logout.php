<?php

session_start();

echo "<script>alert('Logged out successfully'); window.location='http://localhost/lmdb/lmdb.php';</script>";

setcookie('username', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');

session_unset();

?>
