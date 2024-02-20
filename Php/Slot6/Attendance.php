<?php
    session_start();
    //     Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include 'Manager.php';

    $Manager = new Manager();

    date_default_timezone_set('Asia/Ho_Chi_Minh');
//    $check_time = strtotime('22:00:00');
//    $current_time = time();
    $workdate = date('Y-m-d');
    $TimeNow = date('H:i:s');
    $user_id = $_SESSION['user_id'];
    $year = date('Y');
    $month = date('m');

    // Xử lý khi có dữ liệu POST được gửi lên từ form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['session']) && $_POST['session'] === 'morning') {
        $start_time = $TimeNow;

        if ($Manager->checkMorningAttendance($user_id, $workdate)) {
            $error_message1 = "You took roll call this morning";
        } else {
            $attendance = true;
            // Kiểm tra xem start_time có trước 8 giờ sáng không
            $start_time_timestamp = strtotime($start_time);
            $eight_am_timestamp = strtotime('08:00:00');
            $late = ($start_time_timestamp > $eight_am_timestamp) ? true : false;
            $attendance1 = $Manager->attendanceEmployeeMorning($user_id, $workdate, $start_time, $late, $attendance);
            $message1 = "Attendance morning successful";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['session']) && $_POST['session'] === 'afternoon') {
        if ($Manager->checkAfternoonAttendance($user_id, $workdate)) {
            $error_message2 = "You took roll call this afternoon or did not take attendance in the morning";
        } else {
            $end_time = $TimeNow;
            // Kiểm tra xem start_time có trước 17 giờ chiều không
            $start_time_timestamp = strtotime($end_time);
            $eight_am_timestamp = strtotime('17:00:00');
            $leave_early = ($start_time_timestamp < $eight_am_timestamp) ? true : false;
            $attendance2 = $Manager->attendanceEmployeeAftermnoon($user_id, $end_time, $leave_early, $workdate);


            // Tính điểm
            $scoreLate = 0.2 * $Manager->countLate();
            $scoreLeaveEarly = 0.2 * $Manager->countLeaveEarly();
            $dayWorking = $Manager->countAttendance2();
            $dayOff = $Manager->countAttendance0();
            $scoreWorkHalf = 0.5 * $Manager->countAttendance1();

            if ($dayOff == 0) {
                $score = 22 - $scoreLate - $scoreLeaveEarly - $dayOff + $scoreWorkHalf + 1;
            } else {
                $score = 22 - $scoreLate - $scoreLeaveEarly - $dayOff + $scoreWorkHalf;
            }

            $savePerforman = $Manager->addPerformanceEmployee($user_id, $year, $month, $dayOff, $dayWorking, $scoreWorkHalf);
            $message2 = "Attendance afternoon successful";

        }
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the main page after a successful login.</p>

    <a href="logout.php" class="btn btn-danger">Logout</a>

    <br>

    <?php
    if (isset($error_message1)) {
        echo '<div class="alert alert-danger">' .$error_message1 . '</div>';
    }
    ?>

    <br>

    <?php
    if (isset($message1)) {
        echo '<div class="alert alert-success">' .$message1 . '</div>';
    }
    ?>

    <br>

    <br>

    <?php
    if (isset($error_message2)) {
        echo '<div class="alert alert-danger">' .$error_message2 . '</div>';
    }
    ?>

    <br>

    <?php
    if (isset($message2)) {
        echo '<div class="alert alert-success">' .$message2 . '</div>';
    }
    ?>

    <br>



    <div class="container mt-5">
        <h2 class="text-center mb-4">Attendance</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-between"> <!-- Thêm d-flex và justify-content-between -->
                    <form method="post" action="">
                        <!-- Nút điểm danh buổi sáng -->
                        <input type="hidden" name="employee_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="session" value="morning">
                        <button type="submit" class="btn btn-primary mr-3">Attendance morning</button>
                    </form>

                    <form method="post" action="">
                        <!-- Nút điểm danh buổi chiều -->
                        <input type="hidden" name="employee_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="session" value="afternoon">
                        <button type="submit" class="btn btn-success">Attendance afternoon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>



