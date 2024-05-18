<?php
include ("dbconnect.php");
$name = "";
$name_error = "";
$password_error = "";

if (isset($_POST['admin_add'])) {
    $name = $_POST['admin_name'];
    $pass = $_POST['admin_password'];


    // Name validation
    if (empty($name)) {
        $name_error = "Name is required*";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $name_error = "Name can only contain letters and spaces.";
    } elseif (strlen($name) > 40) {
        $name_error = "Full name exceeds 40 characters.";
    }


    if (empty($name_error) || empty($password_error)) {

        $insert_query = "INSERT INTO admin (admin_name, admin_password) VALUES('$name','$pass')";
        $insert_data = mysqli_query($conn, $insert_query);
        if ($insert_data) {
            echo "<script>alert('Successfully admin added to system') </script>";

        } else {
            echo "failed " . mysqli_error($conn);
        }

    }
}

?>