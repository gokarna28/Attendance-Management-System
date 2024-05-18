<?php
include ("dbconnect.php");
session_start();
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM student WHERE student_id = $student_id";
    $result = mysqli_query($conn, $query);
    if ($result && $total = mysqli_num_rows($result) == 1) {
        $student_data = mysqli_fetch_assoc($result);
        echo $student_data['student_name'];
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}
?>

<a href="logout.php">Logout</a>