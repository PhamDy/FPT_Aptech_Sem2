@extends('layouts.app')

@section('content')

<style>
    canvas#performanceChart {
        max-width: 1200px;
        max-height: 800px;
    }
</style>


<h2>Employee Performance Overview of <b style="text-transform: uppercase; color: red;">{{ $name }}</b></h2>

<canvas id="performanceChart" width="800" height="400"></canvas>

<script>
    // Kiểm tra xem dữ liệu $performances có tồn tại không trước khi sử dụng
    @if (!empty($performances))
    // Dữ liệu hiệu suất của nhân viên
    var performances = @json($performances);

    // Tạo mảng các điểm số để sử dụng cho biểu đồ
    var scores = [];
    performances.forEach(function (performance) {
        // Chuyển đổi score thành phạm vi từ 0% đến 100%
        var normalizedScore = (performance.score / 23) * 100;
        scores.push(normalizedScore);
    });

    // Tạo mảng các tháng để sử dụng làm nhãn trục x
    var labels = [];
    for (var i = 1; i <= performances.length; i++) {
        labels.push('Month ' + i);
    }

    // Dữ liệu hiệu suất của nhân viên
    var performanceData = {
        labels: labels,
        datasets: [
            {
                label: 'Score',
                data: scores,
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
                    beginAtZero: true,
                    max: 100 // Đặt giá trị max của trục y là 100%
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
    @endif

</script>

@endsection
