@extends('layouts/admin/app')

@section('content')
    
<div class="container-fluid px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Chat berichten (Maand)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nieuwe accounts (Maand)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class='row'>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evenementen aangemaakt</h6>

                    <!-- Button trigger modal -->
                    <a role="button" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-calendar-alt fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Jadatumbereikperiodetijdseenheid</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="fromDate">Van</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="fromDate">
                                    
                                    <label for="toDate">Tot</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="toDate">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                    <button type="button" onclick="updateChart()" class="btn btn-primary" data-dismiss="modal">Uitvoeren</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="events" height="100px"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evenementen Hittemap</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="map"></div>
                    <script>
                        var map;

                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {
                                    lat: -34.397,
                                    lng: 150.644
                                },
                                zoom: 8
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&callback=initMap" async defer></script>
                    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABXHNxtjF9xQGsLuyHcptcKd4lKv6XYak&callback=initMap" async defer></script> -->

                </div>
            </div>
        </div>


    </div>
</div>

<script>
    var ctx = document.getElementById('events');
    var chart = new Chart(ctx, {
        type: 'line',
        data: getEventData(null, null),
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    function getEventData(fromDate, toDate) {
        var plotLabels = [];
        var plotData = [];

        $.ajax({
            url: "{{ route('admin_charts_events') }}",
            method: 'POST',
            async: false,
            data: {
                fromDate: fromDate,
                toDate: toDate,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                data.forEach(function(item) {
                    plotLabels.push(item.month + " " + item.year);
                    plotData.push(item.totalEvents);
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

        return {
            labels: plotLabels,
            datasets: [{
                data: plotData,
                borderColor: `rgba(25, 93, 230, 1)`
            }]
        };
    }

    function updateChart() {
        var fromDate = document.getElementById("fromDate").value; 
        var toDate = document.getElementById("toDate").value; 
        chart.data = getEventData(fromDate, toDate);
        chart.update();
    };
</script>

@endsection