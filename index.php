<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    @media print {
        /* Purana rule (Jo chal raha hai) */
        body * {
            visibility: hidden;
        }
        .card.bg-white, .card.bg-white * {
            visibility: visible;
        }
        .card.bg-white {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }

        /* 🔥 NAYA RULE: Yeh line print ke waqt button ko poori tarah gayab kar degi */
        .card.bg-white button, 
        .card.bg-white .btn, 
        button {
            display: none !important;
            visibility: hidden !important;
        }
    }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow p-4 mt-4 bg-white">
        <h3 class="text-center mb-4">Check Your Result</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Enter Roll Number:</label>
                <input type="number" name="roll_no" class="form-control" required>
            </div>
            <button type="submit" name="search" class="btn btn-primary w-100">Get Result</button>
        </form>
        <div class="text-center mt-3">
            <a href="admin_login.php" class="text-muted text-decoration-none">Admin Login</a>
        </div>
    </div>

    <?php
    if(isset($_POST['search'])) {
        $roll_no = $_POST['roll_no'];
        
        // Student aur uske marks fetch karne ke liye JOIN query
        $query = "SELECT s.name, s.roll_no, s.class, r.maths, r.science, r.english , r.hindi, r.sst
                  FROM students s 
                  JOIN results r ON s.roll_no = r.roll_no 
                  WHERE s.roll_no = '$roll_no'";
        
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $total = $row['maths'] + $row['science'] + $row['english'] + $row['hindi'] + $row['sst'];
            ?>
            <div class="card shadow p-4 mt-4 bg-white">
                <h4 class="text-center">Markshseet</h4>
                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                <p><strong>Roll_no:</strong> <?php echo $row['roll_no']; ?></p>
                <p><strong>Class:</strong> <?php echo $row['class']; ?></p>
                <table class="table table-bordered text-center">
                    <thead><tr><th>Subject</th><th>Marks</th></tr></thead>
                    <tbody>
                        <tr><td>Maths</td><td><?php echo $row['maths']; ?></td></tr>
                        <tr><td>Science</td><td><?php echo $row['science']; ?></td></tr>
                        <tr><td>English</td><td><?php echo $row['english']; ?></td></tr>
                        <tr><td>Hindi</td><td><?php echo $row['hindi']; ?></td></tr>
                        <tr><td>Sst</td><td><?php echo $row['sst']; ?></td></tr>
                        <tr class="table-dark"><td><strong>Total</strong></td><td><strong><?php echo $total; ?>/500</strong></td></tr>
                    </tbody>
                </table>
                <button onclick="window.print()" class="btn btn-success mt-3">Print Result</button>
            </div>
            <?php
        } else {
            echo "<div class='alert alert-danger mt-3 text-center'>Result Not Found!</div>";
        }
    }
    ?>
</div>
</body>
</html>