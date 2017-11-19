@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        <canvas id="myChart" width="400" height="300"></canvas>
    </div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        var url = '{{ route('users.chart', ['user' => auth()->user()->id]) }}';

        $.get(url, function (res) {
            console.log(res);

            createDayCoutChart(res.items.days, res.items.counts);
        }, 'json');


    });

    function createDayCoutChart(days, counts)
    {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: 'finished',
                    data: counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }


</script>

@endsection