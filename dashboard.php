<?php 
include('db.php'); 
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Note: Real project mein yahan session check lagana zaroori hai security ke liye
if(isset($_POST['add_student'])) {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $maths = $_POST['maths'];
    $science = $_POST['science'];
    $english = $_POST['english'];
    $hindi = $_POST['hindi'];
    $sst = $_POST['sst'];

    // Student insert karein
    $query1 = "INSERT INTO students (roll_no, name, class) VALUES ('$roll_no', '$name', '$class')";
    // Marks insert karein
    $query2 = "INSERT INTO results (roll_no, maths, science, english, hindi, sst) VALUES ('$roll_no', '$maths', '$science', '$english', '$hindi', '$sst')";

    if(mysqli_query($conn, $query1) && mysqli_query($conn, $query2)) {
        echo "<script>alert('Student & Marks Added Successfully!');</script>";
    } else {
        echo "<script>alert('Error! Roll number might already exist.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Admin Dashboard</h2>
            <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
        </div>
        <h5 class="text-secondary">Add Student Result</h5>
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Roll Number:</label>
                    <input type="number" name="roll_no" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Student Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Class:</label>
                <input type="text" name="class" class="form-control" placeholder="e.g. Class 10" required>
            </div>
            <hr>
            <h5 class="text-secondary">Enter Marks (Out of 100)</h5>
            <div class="row mb-3">
                <div class="col"><label>Maths:</label><input type="number" name="maths" class="form-control" max="100" required></div>
                <div class="col"><label>Science:</label><input type="number" name="science" class="form-control" max="100" required></div>
                <div class="col"><label>English:</label><input type="number" name="english" class="form-control" max="100" required></div>
                 <div class="col"><label>hindi:</label><input type="number" name="hindi" class="form-control" max="100" required></div>
                  <div class="col"><label>Sst:</label><input type="number" name="sst" class="form-control" max="100" required></div>
            </div>
            <button type="submit" name="add_student" class="btn btn-dark w-100">Submit Student Record</button>
        </form>
    </div>
</div>
</body>
</html>