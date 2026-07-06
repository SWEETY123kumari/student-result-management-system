<?php
// 1. Errors dekhne ke liye settings
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// 2. Direct Database Connection
$host = "localhost:3307";
$user = "root";
$pass = "";
$dbname = "srms";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error = "";

// 3. Login Check Logic
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - SRMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">

<div class="container" style="max-width: 400px;">
    <div class="card shadow p-4 bg-white rounded">
        <h3 class="text-center mb-4 text-primary">Admin Login</h3>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger text-center p-2"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>
        </form>
        
        <div class="text-center">
            <a href="index.php" class="text-muted text-decoration-none">&larr; Back to Student Panel</a>
        </div>
    </div>
</div>

</body>
</html>