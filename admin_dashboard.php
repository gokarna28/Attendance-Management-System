<?php
include ("dbconnect.php");
require ("add_student.php");
require ("add_admin.php");
require ("add_teacher.php");

session_start();
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM admin WHERE admin_id = $admin_id";
    $result = mysqli_query($conn, $query);
    if ($result && $total = mysqli_num_rows($result) == 1) {
        $admin_data = mysqli_fetch_assoc($result);
        //echo $admin_data['admin_name'];
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="css/admin2s.css" />
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

</head>

<body>
    <!-- <div class="background"></div> -->
    <div class="body_container">

        <div class="sidebar">
            <div class="side_menu">
                <div class="logo_img">logo</div>
                <div class="menu_item">
                    <div class="item active" id="dashboard" onclick="dashboardInfo()">
                        <i class="fa-solid fa-gauge"></i>
                        <p>Dashboard</p>
                    </div>
                    <div class="item" id="student" onclick="studentInfo()">
                        <i class="fa-solid fa-user-plus"></i>
                        <p>Add Student</p>
                    </div>
                    <div class="item" id="application" onclick="applicationInfo()">
                        <i class="fa-solid fa-person-circle-check"></i>
                        <p>Applications</p>
                    </div>
                    <div class="item" id="teacher" onclick="teacherInfo()">
                        <i class="fa-solid fa-user-plus"></i>
                        <p>Add Teacher</p>
                    </div>
                    <div class="item" id="admin" onclick="adminInfo()">
                        <i class="fa-solid fa-user-tie"></i>
                        <p>Add Admin</p>
                    </div>
                </div>
                <a href="logout.php">
                    <div class="item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </div>
                </a>

            </div>

        </div>

        <!-- main section -->
        <div class="main_section">

            <!-- header -->
            <div class="search_container">
                <div class="header">
                    <span>Admin</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="search_btn">
                    <input type="text" placeholder="Search here">
                    <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                </div>
                <div class="profile_container">
                    <div class="profile_btn">
                        <div class="letter">
                            <?php echo substr($admin_data['admin_name'], 0, 1); ?>
                        </div>
                        <p>
                            <?php echo $admin_data['admin_name'] ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- dashboard section -->
            <div class="dashboard_container">
                dashboard
            </div>

            <!-- student info -->
            <div class="student_container hide">
                <h3>Student Details</h3>
                <div class="faculty_btn">
                    <p class="faculty_active" onclick="bcaStudent()" id="BCA">BCA</p>|
                    <p class="" onclick="csitStudent()" id="CSIT">CSIT</p>|
                    <p class="" onclick="bbmStudent()" id="BBM">BBM</p>
                </div>
                <div class="stuedent_details">
                    <div class="add_btn">
                        <button onclick="formPopup()">Add Student</button>
                    </div>
                    <table class="bca ">
                        <thead>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- retriving student data form student table for bca  -->
                            <?php
                            $student_query = "SELECT * FROM student WHERE faculty='bca'";
                            $student_data = mysqli_query($conn, $student_query);
                            if (mysqli_num_rows($student_data) > 0) {
                                while ($row_student = mysqli_fetch_assoc(($student_data))) {
                                    //echo $row_student['student_name'];
                            
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_name'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_email'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_roll'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['semester'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action_btn">
                                                <a href="#" class="edit_btn"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="#" class="delete_btn"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                    <table class="csit hide">
                        <thead>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- retriving student data form student table for bca  -->
                            <?php
                            $student_query = "SELECT * FROM student WHERE faculty='csit'";
                            $student_data = mysqli_query($conn, $student_query);
                            if (mysqli_num_rows($student_data) > 0) {
                                while ($row_student = mysqli_fetch_assoc(($student_data))) {
                                    //echo $row_student['student_name'];
                            
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_name'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_email'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_roll'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['semester'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action_btn">
                                                <a href="#" class="edit_btn"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="#" class="delete_btn"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                    <table class="bbm hide">
                        <thead>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- retriving student data form student table for bca  -->
                            <?php
                            $student_query = "SELECT * FROM student WHERE faculty='bbm'";
                            $student_data = mysqli_query($conn, $student_query);
                            if (mysqli_num_rows($student_data) > 0) {
                                while ($row_student = mysqli_fetch_assoc(($student_data))) {
                                    //echo $row_student['student_name'];
                            
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_name'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_email'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['student_roll'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['semester'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action_btn">
                                                <a href="#" class="edit_btn"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="#" class="delete_btn"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

                <!-- add student form -->
                <div class="studenta_form_container hide" id="student_form">
                    <div class="student_add">
                        <div class="close_btn">
                            <i class="fa-regular fa-circle-xmark" onclick="student_closeBtn()"></i>
                        </div>
                        <h3>Add Student</h3>
                        <form action="" method="post">
                            <div class="fields">
                                <div class="input_field">
                                    <label>Name</label>
                                    <div class="input">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" name="student_name" placeholder="Enter student name"
                                            value="<?php echo $name ?>" required>
                                    </div>
                                    <span class='errors'><?php echo $name_error ?></span>
                                </div>
                                <div class="input_field">
                                    <label>Email</label>
                                    <div class="input">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="email" name="student_email" placeholder="Enter student email"
                                            value="<?php echo $email ?>" required>
                                    </div>
                                    <span class='errors'><?php echo $email_error ?></span>
                                </div>
                                <div class="input_field">
                                    <label>Roll No.</label>
                                    <div class="input">
                                        <input type="number" name="student_roll" placeholder="Enter student roll number"
                                            value="<?php echo $roll ?>" required>
                                    </div>
                                    <span class='errors'><?php echo $roll_error ?></span>
                                </div>
                                <div class="input_field">
                                    <label>Faculty</label>
                                    <div class="input">
                                        <select name="faculty" required>
                                            <option selected disabled>Select faculty</option>
                                            <option>CSIT</option>
                                            <option>BCA</option>
                                            <option>BBM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input_field">
                                    <label>Semester</label>
                                    <div class="input">
                                        <select name="semester" required>
                                            <option selected disabled>Select semester</option>
                                            <option>One</option>
                                            <option>Two</option>
                                            <option>Three</option>
                                            <option>Four</option>
                                            <option>Five</option>
                                            <option>Six</option>
                                            <option>Seven</option>
                                            <option>Eight</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="submit_btn">
                                <button type="submit" name="student_add">Add Now</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!-- appication section -->
            <div class="application_container hide">
                applications
            </div>

            <!-- teacher section -->
            <div class="teacher_container hide">
                <h3>Teacher Details</h3>
                <div class="add_btn">
                    <button onclick="addTeacher()">Add Teacher</button>
                </div>
                <div class="teacher_details">
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            //retriving teacher data form teacher table
                            $teacher_query = "SELECT * FROM teacher";
                            $teacher_data = mysqli_query($conn, $teacher_query);
                            if (mysqli_num_rows($teacher_data) > 0) {
                                while ($row_teacher = mysqli_fetch_assoc($teacher_data)) {
                                    // echo $row_teacher['teacher_name'];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_data">
                                                <?php echo $row_teacher['teacher_name'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="teacher_data">
                                                <?php echo $row_teacher['teacher_email'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action_btn">
                                                <a href="#" class="edit_btn"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="#" class="delete_btn"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- add teacher form -->
                <div class="teacher_form hide">
                    <div class="close_btn">
                        <i class="fa-regular fa-circle-xmark" onclick="closeTeacherForm()"></i>
                    </div>
                    <h3>Add Teacher Form</h3>
                    <form action="" method="post">
                        <div class="fields" id="fields_container">
                            <div class="input_field">
                                <label>Name</label>
                                <div class="input">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="teacher_name" placeholder="Enter Teacher name"
                                        value="<?php echo $name ?>" required>
                                </div>
                                <span class='errors'><?php echo $name_error ?></span>
                            </div>
                            <div class="input_field">
                                <label>Email</label>
                                <div class="input">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" name="teacher_email" placeholder="Enter teacher email"
                                        value="<?php echo $email ?>" required>
                                </div>
                                <span class='errors'><?php echo $email_error ?></span>
                            </div>
                            <div class="input_field">
                                <label>Password</label>
                                <div class="input">
                                    <input type="password" name="teacher_password" placeholder="Enter password"
                                        value="<?php echo $pass ?>" required>
                                </div>
                                <span class='errors'><?php echo $pass_error ?></span>
                            </div>
                        </div>
                        <div class="submit_btn">
                            <button type="submit" name="teacher_add">Add Now</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- add admin section -->
            <div class="student_container hide" id="admin_container">
                <h3>Admin Details</h3>
                <div class="stuedent_details">
                    <div class="add_btn">
                        <button onclick="admin_formPopup()">Add Admin</button>
                    </div>
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- retriving student data form student table -->
                            <?php
                            $student_query = "SELECT * FROM admin";
                            $student_data = mysqli_query($conn, $student_query);
                            if (mysqli_num_rows($student_data) > 0) {
                                while ($row_student = mysqli_fetch_assoc(($student_data))) {
                                    //echo $row_student['student_name'];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="data">
                                                <?php echo $row_student['admin_name'] ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="action_btn">
                                                <a href="#" class="edit_btn"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="delete_admin.php?a_id=<?php echo $row_student['admin_id'] ?>"
                                                    class="delete_btn" onclick="return confirmDelete()"><i
                                                        class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

                <!-- add admin form -->
                <div class="studenta_form_container hide" id="admin_form">
                    <div class="student_add">
                        <div class="close_btn">
                            <i class="fa-regular fa-circle-xmark" onclick="closeBtn()"></i>
                        </div>
                        <h3>Add Admin</h3>
                        <form action="" method="post">
                            <div class="admin_fields">
                                <div class="input_field">
                                    <label>Name</label>
                                    <div class="input">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" name="admin_name" placeholder="Enter name"
                                            value="<?php echo $name ?>" required>
                                    </div>
                                    <span class='errors'><?php echo $name_error ?></span>
                                </div>

                                <div class="input_field">
                                    <label>Password</label>
                                    <div class="input">
                                        <input type="password" name="admin_password" placeholder="Enter password"
                                            value="<?php echo $password ?>" id="admin_password" required>
                                        <a href="#" class="eyeopen hide"><i class="fa-solid fa-eye"
                                                onclick="eyeOpen()"></i></a>
                                        <a href="#" class="eyeclose"><i class="fa-solid fa-eye-slash"
                                                onclick="eyeClose()"></i></a>
                                    </div>
                                    <span class='errors'><?php echo $password_error ?></span>
                                </div>
                            </div>
                            <div class="submit_btn">
                                <button type="submit" name="admin_add">Add Now</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    </div>
    <script>
        //studnet data popop bca csit bbm
        function bcaStudent() {
            document.querySelector(".bca").classList.remove("hide");
            document.querySelector(".csit").classList.add("hide");
            document.querySelector(".bbm").classList.add("hide");
            document.querySelector("#BCA").classList.add("faculty_active");
            document.querySelector("#CSIT").classList.remove("faculty_active");
            document.querySelector("#BBM").classList.remove("faculty_active");
        }
        function csitStudent() {
            document.querySelector(".bca").classList.add("hide");
            document.querySelector(".csit").classList.remove("hide");
            document.querySelector(".bbm").classList.add("hide");
            document.querySelector("#CSIT").classList.add("faculty_active");
            document.querySelector("#BCA").classList.remove("faculty_active");
            document.querySelector("#BBM").classList.remove("faculty_active");
        }
        function bbmStudent() {
            document.querySelector(".bca").classList.add("hide");
            document.querySelector(".csit").classList.add("hide");
            document.querySelector(".bbm").classList.remove("hide");
            document.querySelector("#CSIT").classList.remove("faculty_active");
            document.querySelector("#BCA").classList.remove("faculty_active");
            document.querySelector("#BBM").classList.add("faculty_active");
        }
    </script>
    <script>
        //side bar menu popup
        function studentInfo() {
            document.querySelector("#student").classList.add('active');
            document.querySelector(".student_container").classList.remove('hide');
            document.querySelector("#dashboard").classList.remove('active');
            document.querySelector("#application").classList.remove('active');
            document.querySelector("#teacher").classList.remove('active');
            document.querySelector("#admin").classList.remove('active');
            document.querySelector(".dashboard_container").classList.add('hide');
            document.querySelector(".application_container").classList.add('hide');
            document.querySelector(".teacher_container").classList.add('hide');
            document.querySelector("#admin_container").classList.add('hide');
        }
        function dashboardInfo() {
            document.querySelector("#student").classList.remove('active');
            document.querySelector(".student_container").classList.add('hide');
            document.querySelector("#dashboard").classList.add('active');
            document.querySelector("#application").classList.remove('active');
            document.querySelector("#teacher").classList.remove('active');
            document.querySelector("#admin").classList.remove('active');
            document.querySelector(".dashboard_container").classList.remove('hide');
            document.querySelector(".application_container").classList.add('hide');
            document.querySelector(".teacher_container").classList.add('hide');
            document.querySelector("#admin_container").classList.add('hide');
        }
        function applicationInfo() {
            document.querySelector("#student").classList.remove('active');
            document.querySelector(".student_container").classList.add('hide');
            document.querySelector("#dashboard").classList.remove('active');
            document.querySelector("#application").classList.add('active');
            document.querySelector("#teacher").classList.remove('active');
            document.querySelector("#admin").classList.remove('active');
            document.querySelector(".dashboard_container").classList.add('hide');
            document.querySelector(".application_container").classList.remove('hide');
            document.querySelector(".teacher_container").classList.add('hide');
            document.querySelector("#admin_container").classList.add('hide');
        }
        function teacherInfo() {
            document.querySelector("#student").classList.remove('active');
            document.querySelector(".student_container").classList.add('hide');
            document.querySelector("#dashboard").classList.remove('active');
            document.querySelector("#application").classList.remove('active');
            document.querySelector("#teacher").classList.add('active');
            document.querySelector("#admin").classList.remove('active');
            document.querySelector(".dashboard_container").classList.add('hide');
            document.querySelector(".application_container").classList.add('hide');
            document.querySelector(".teacher_container").classList.remove('hide');
            document.querySelector("#admin_container").classList.add('hide');
        }
        function adminInfo() {
            document.querySelector("#student").classList.remove('active');
            document.querySelector(".student_container").classList.add('hide');
            document.querySelector("#dashboard").classList.remove('active');
            document.querySelector("#application").classList.remove('active');
            document.querySelector("#teacher").classList.remove('active');
            document.querySelector("#admin").classList.add('active');
            document.querySelector(".dashboard_container").classList.add('hide');
            document.querySelector(".application_container").classList.add('hide');
            document.querySelector(".teacher_container").classList.add('hide');
            document.querySelector("#admin_container").classList.remove('hide');
        }

        // add teacher form popup
        function addTeacher() {
            document.querySelector(".teacher_form").classList.remove("hide");
        }
        function closeTeacherForm() {
            document.querySelector(".teacher_form").classList.add("hide");
        }
    </script>
    <script>
        //close btn add studnet form
        function student_closeBtn() {
            document.querySelector('#student_form').classList.add('hide');
        }
        //form popup
        function formPopup() {
            document.querySelector('#student_form').classList.remove('hide');
        }
        //admin form 
        function admin_formPopup() {
            document.querySelector('#admin_form').classList.remove('hide');
        }
        //close btn add admin form
        function closeBtn() {
            document.querySelector('#admin_form').classList.add('hide');
        }

        //admin delete confirmation
        function confirmDelete() {
            return confirm('Are you sure, you want to delete the admin.');
        }

        //admin form password hide show
        function eyeClose() {
            document.querySelector(".eyeclose").classList.add("hide");
            document.querySelector(".eyeopen").classList.remove("hide");
            document.querySelector("#admin_password").type = "text";
        }
        function eyeOpen() {
            document.querySelector(".eyeclose").classList.remove("hide");
            document.querySelector(".eyeopen").classList.add("hide");
            document.querySelector("#admin_password").type = "password";
        }
    </script>
</body>

</html>