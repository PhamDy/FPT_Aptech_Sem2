<?php
session_start();

    include 'Manager.php';

    $Manager = new Manager();

    date_default_timezone_set('Asia/Ho_Chi_Minh');

    if (isset($_GET['id'])) {
        $employeesId = $_GET['id'];
        $scoreData  = $Manager->getScore($employeesId);

        $scoreDataPercent = [];

        foreach ($scoreData as $score) {
            $percent = ($score / 23) * 100;
            $scoreDataPercent[] = $percent;
        }



    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Performance</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas#performanceChart {
            max-width: 500px;
            width: 80%;
            height: 40%;
        }
    </style>
</head>
<body>
<h2>Employee Performance Overview</h2>
<canvas id="performanceChart" width="800" height="400"></canvas>

<script>
    // Kiểm tra xem dữ liệu scoreData và scoreDataPercent có tồn tại không trước khi sử dụng
    <?php if (isset($scoreData) && isset($scoreDataPercent)) { ?>
    // Dữ liệu hiệu suất của nhân viên
    var scoreData = <?php echo json_encode($scoreData); ?>; // Chuyển đổi mảng PHP thành mảng JavaScript
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Tạo mảng các tháng để sử dụng làm nhãn trục x
    var labels = [];
    for (var i = 1; i <= months.length; i++) {
        labels.push(months[i - 1]);
    }

    // Dữ liệu hiệu suất của nhân viên
    var performanceData = {
        labels: labels,
        datasets: [
            {
                label: 'Score',
                data: <?php echo json_encode($scoreDataPercent); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
        ]
    };

    // Tùy chỉnh cài đặt biểu đồ
    var chartOptions = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Vẽ biểu đồ
    var ctx = document.getElementById('performanceChart').getContext('2d');
    var performanceChart = new Chart(ctx, {
        type: 'bar',
        data: performanceData,
        options: chartOptions
    });
    <?php } ?>
</script>
</body>
</html>
