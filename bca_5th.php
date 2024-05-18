<?php
include ("dbconnect.php");
$date = "";
if (isset($_POST['save_btn'])) {
    $date = date("Y/M/d l", strtotime($_POST['date']));
    $checked = isset($_POST['check']) ? $_POST['check'] : [];
    if (!empty($checked)) {
        $successCount = 0;
        $existingCount = 0;
        foreach ($checked as $student_id) {
            // Check if the record already exists in the attendance table
            $existing_query = "SELECT * FROM attendance WHERE student_id = '$student_id' AND date = '$date'";
            $existing_result = mysqli_query($conn, $existing_query);

            if (mysqli_num_rows($existing_result) > 0) {
                // Record already exists
                $existingCount++;
            } else {
                $insert_query = "INSERT INTO attendance(student_id,date)VALUES ('$student_id','$date')";
                $insert_data = mysqli_query($conn, $insert_query);
                if ($insert_data) {
                    $successCount++;
                } else {
                    echo "failed" . mysqli_error($conn);
                }
            }
        }

        if ($successCount > 0) {
            echo "<script>alert('Attendance is done successfully.')</script>";
        }

        if ($existingCount > 0) {
            echo "Attendance is already done.";
        }

    } else {
        echo "<script>alert('No students selected for attendance.')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCA 1st sem</title>
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        :root {
            --primaryColor: #7163ba;
            --secondaryColor: #978ec7;
            --bodyColor: #ebe9e9;
            --lightGreyColor: #f4f5fa;
            --whiteColor: #ffffff;
            --blackColor: #222;
            --lightBlackColor: #454955;
            --darkPurpleColor: #2c2f4e;
            --redColor: rgb(255, 55, 0);
            --greenColor: rgb(89, 183, 110);
            --lightBlue: rgb(52, 116, 245);
            --lightRedColor: #ff0844;

        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: poppins;
            background-color: var(--bodyColor);
        }

        .body_container {
            background-color: var(--whiteColor);
            width: 100%;
            height: 100vh;
            padding: 20px;
        }

        .back_btn button {
            padding: 5px 10px;
            font-size: 20px;
            color: var(--lightBlackColor);
        }

        .body_container h2 {
            display: flex;
            justify-content: center;
            color: var(--lightBlackColor);
        }

        .student_details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
        }

        table {
            margin-top: 20px;
        }

        .student_details input {
            width: 200px;
            font-size: 20px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
            padding: 5px 10px;
            background-color: var(--lightRedColor);
            color: var(--whiteColor);
        }

        label {
            font-size: 20px;
            font-weight: 500;
        }

        .student_details table th {
            border: 1px solid var(--blackColor);
            width: 200px;
            padding: 5px 10px;
            background-color: #36B9C9;
        }

        td {
            border: 1px solid var(--blackColor);
        }

        .data {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .data input {
            transform: scale(2);
        }

        .save_btn {
            display: flex;
            justify-content: right;
        }

        .save_btn button {
            background-color: var(--lightRedColor);
            color: var(--whiteColor);
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
            margin-top: 20px;
            margin-right: 20px;
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="body_container">
        <div class="back_btn">
            <button><a href="bca.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>Make Attendance(BCA 5th)</h2>
        <?php
    // Assuming $conn is your database connection established earlier
    
    $today = date('Y/M/d l');
    $faculty = 'bca';
    $semester = 'five';
    
    // Prepare and execute the query
    $check_query = "SELECT * FROM attendance WHERE faculty='$faculty' AND semester='$semester'";
    $check_data = mysqli_query($conn, $check_query);

    // Check for errors in query execution
    if (!$check_data) {
        echo "Query execution failed: " . mysqli_error($conn);
    } else {
        // Fetch the result
        $check_result = mysqli_fetch_assoc($check_data);

        if ($check_result) {
            // A row was found
            $attendance_date = $check_result['date'];

            if ($attendance_date == $today) {
                // Attendance already recorded for today
                echo "<script>alert('Attendance is already done for today.')</script>";
            } else {
                // Record attendance logic can go here
                echo "Attendance can be recorded for today.";
            }
        }
    }
?>

        <form action="" method="post">
            <div class="student_details">

                <label>Date:</label>
                <input type="date" id="datepicker" name="date" readonly>
                <table>
                    <thead>
                        <th>Sr.no.</th>
                        <th>Name</th>
                        <th>Roll no.</th>
                        <th>Attendance</th>
                    </thead>
                    <tbody>
                        <?php
                        include ("dbconnect.php");

                        $student_query = "SELECT * FROM student WHERE faculty='bca' AND semester='five'";
                        $student_data = mysqli_query($conn, $student_query);
                        if (mysqli_num_rows($student_data) > 0) {
                            $serialNumber = 1;
                            while ($row_student = mysqli_fetch_assoc($student_data)) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="data">
                                            <?php echo $serialNumber ?>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="data">
                                            <?php echo $row_student['student_name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="data">
                                            <?php echo $row_student['student_roll'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="data">
                                            <input type="checkbox" name="check[]"
                                                value="<?php echo $row_student['student_id']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $serialNumber++;
                            }
                        } else {
                            echo "no students";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="save_btn">
                    <button type="submit" name="save_btn">Save</button>
                </div>
            </div>
        </form>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get today's date in the format "YYYY-MM-DD"
            var today = new Date().toISOString().slice(0, 10);

            // Set the value of the date input field to today's date
            document.getElementById('datepicker').value = today;
        });
    </script>
</body>

</html>