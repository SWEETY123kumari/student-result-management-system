<?php
session_start();
session_unset(); // Saare session variables delete karein
session_destroy(); // Session khatam karein
header("Location: admin_login.php"); // Login page par redirect karein
exit();
?>