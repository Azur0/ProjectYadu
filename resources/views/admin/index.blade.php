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
    <div class='row mb-3'>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evenementen aangemaakt</h6>

                    <!-- Button trigger modal -->
                    <a role="button" data-toggle="modal" data-target="#eventModal">
                        <i class="fas fa-calendar-alt fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventModalLabel">Jadatumbereikperiodetijdseenheid</h5>
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
                                    <button type="button" onclick="updateEventChart()" class="btn btn-primary" data-dismiss="modal">Uitvoeren</button>
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
                    <h6 class="m-0 font-weight-bold text-primary">Delen</h6>

                    <!-- Button trigger modal -->
                    <a role="button" data-toggle="modal" data-target="#shareModal">
                        <i class="fas fa-calendar-alt fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="shareModalLabel">Jadatumbereikperiodetijdseenheid</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="fromDate">Van</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="fromShareDate">

                                    <label for="toDate">Tot</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="toShareDate">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                    <button type="button" onclick="updateShareChart()" class="btn btn-primary" data-dismiss="modal">Uitvoeren</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="shares" height="220px"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class='row mb-3'>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Categorien</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="categories" height="220px"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evenementen</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var eventChart = new Chart(document.getElementById('events'), {
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

        function updateEventChart() {
            var fromDate = document.getElementById("fromDate").value;
            var toDate = document.getElementById("toDate").value;
            eventChart.data = getEventData(fromDate, toDate);
            eventChart.update();
        };

        //ShareChart
        var shareChart = new Chart(document.getElementById("shares"), {
            type: 'doughnut',
            data: getShareData(null, null),
            options: {
                maintainAspectRatio: true
            }
        });

        function getShareData(fromDate, toDate) {
            var plotLabels = [];
            var plotData = [];

            $.ajax({
                url: "{{ route('admin_charts_shares') }}",
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
                        plotLabels.push(item.platform);
                        plotData.push(item.shareCount);
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
                    backgroundColor: ['#256eff', '#8c16b7', '#b2b2b2', '#ff495c', '#3ddc97'], //TODO: Change colors
                    data: plotData
                }]
            };
        }

        function updateShareChart() {
            var fromDate = document.getElementById("fromShareDate").value;
            var toDate = document.getElementById("toShareDate").value;
            shareChart.data = getShareData(fromDate, toDate);
            shareChart.update();
        };

        //CategoriesChart
        var categoriesChart = new Chart(document.getElementById("categories"), {
            type: 'doughnut',
            data: getShareData(null, null),
            options: {
                maintainAspectRatio: true
            }
        });
    </script>


    <script>
        var map, heatmap;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6.5,
                center: {
                    lat: 52,
                    lng: 5.8
                }
            });

            heatmap = new google.maps.visualization.HeatmapLayer({
                data: getPoints(),
                map: map,
                opacity: 0.5,
                radius: 20
            });
        }

        // Heatmap data: 500 Points
        function getPoints() {
            return [
                new google.maps.LatLng(51.70594, 5.3195),
                new google.maps.LatLng(51.71636, 5.35611),
                new google.maps.LatLng(53.17316, 6.60374),
                new google.maps.LatLng(53.05563, 4.79603),
                new google.maps.LatLng(52.51405, 6.08675),
                new google.maps.LatLng(51.65118, 5.46722),
                new google.maps.LatLng(52.36537, 4.88569),
                new google.maps.LatLng(52.36537, 4.88569),
                new google.maps.LatLng(51.92046, 4.47919),
                new google.maps.LatLng(51.589, 4.77809),
                new google.maps.LatLng(51.688549, 5.28745),
                new google.maps.LatLng(51.69019, 5.30195),
            ];
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&libraries=visualization&callback=initMap" async defer></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABXHNxtjF9xQGsLuyHcptcKd4lKv6XYak&libraries=visualization&callback=initMap" async defer></script> -->



    @endsection