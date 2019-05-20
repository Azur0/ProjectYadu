@extends('layouts/admin/app')

@section('content')

<div class="container-fluid px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{__('charts.charts_title')}}</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{__('charts.amount_chatmessages')}}</div>
                            <div id="chatmessages" class="h5 mb-0 font-weight-bold text-gray-800">{{__('charts.loading')}}</div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('charts.amount_new_accounts')}}</div>
                            <div id="newAccounts" class="h5 mb-0 font-weight-bold text-gray-800">{{__('charts.loading')}}</div>
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
                    <h6 class="m-0 font-weight-bold text-primary">{{__('charts.amount_total_events')}}</h6>

                    <!-- Button trigger modal -->
                    <a role="button" data-toggle="modal" data-target="#eventModal">
                        <i class="fas fa-calendar-alt fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventModalLabel">{{__('charts.time_range')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="fromDate">{{__('charts.from')}}</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="fromDate">

                                    <label for="toDate">{{__('charts.till')}}</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="toDate">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('charts.close')}}</button>
                                    <button type="button" onclick="updateEventChart()" class="btn btn-primary" data-dismiss="modal">{{__('charts.execute')}}</button>
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
                    <h6 class="m-0 font-weight-bold text-primary">{{__('charts.shared_events')}}</h6>

                    <!-- Button trigger modal -->
                    <a role="button" data-toggle="modal" data-target="#shareModal">
                        <i class="fas fa-calendar-alt fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="shareModalLabel">{{__('charts.time_range')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="fromDate">{{__('charts.from')}}</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="fromShareDate">

                                    <label for="toDate">{{__('charts.till')}}</label>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('today')) }}" id="toShareDate">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('charts.close')}}</button>
                                    <button type="button" onclick="updateShareChart()" class="btn btn-primary" data-dismiss="modal">{{__('charts.execute')}}</button>
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
                    <h6 class="m-0 font-weight-bold text-primary">{{__('charts.event_categories')}}</h6>
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
                    <h6 class="m-0 font-weight-bold text-primary">{{__('charts.event_heatmap')}}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="map" style="min-height: 220px" class="h-100 rounded"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        updateAccountsCreated(null,null);
        updateChatmessagesSend(null,null);

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
                        plotLabels.push(item.date);
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

        function updateChatmessagesSend(fromDate, toDate){
            $.ajax({
                url: "{{ route('admin_charts_chatmessages') }}",
                method: 'POST',
                async: true,
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById("chatmessages").innerHTML = data.messageData.messageCount;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }

        function updateAccountsCreated(fromDate, toDate){

            document.getElementById("newAccounts").innerHTML = "{{__('charts.loading')}}";

            $.ajax({
                url: "{{ route('admin_charts_accounts_created') }}",
                method: 'POST',
                async: true,
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById("newAccounts").innerHTML = data.accountData.accountCount;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
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
                    data.shareData.forEach(function(item) {
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
                    backgroundColor: getColors(plotLabels.length),
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
            data: getCategoryData(null, null),
            options: {
                maintainAspectRatio: true
            }
        });

        function getCategoryData(fromDate, toDate) {
            var plotLabels = [];
            var plotData = [];

            $.ajax({
                url: "{{ route('admin_charts_categories') }}",
                method: 'POST',
                async: false,
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    data.categoryData.forEach(function(item) {
                        plotLabels.push(item.category);
                        plotData.push(item.count);
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
                    backgroundColor: getColors(plotLabels.length),
                    data: plotData
                }]
            };
        }

        function getColors(amount) {
            var colors = [];

            var colorstep = 360 / amount;
            var i;
            for (i = 0; i < amount; i++) {
                colors.push('hsl(' + Math.floor(colorstep * i) + ', 68%, 50%)');
                console.log('hsl(' + Math.floor(colorstep * i) + ', 68%, 50%)');
            }
            console.log(colors);
            return colors;
        }
    </script>


    <script>
        var map, heatmap;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6.7,
                center: {
                    lat: 52,
                    lng: 5.8
                }
            });

            heatmap = new google.maps.visualization.HeatmapLayer({
                data: getPoints(null, null),
                map: map,
                opacity: 0.5,
                radius: 20
            });
        }

        // Heatmap data
        function getPoints(fromDate, toDate) {
            var plotLatLng = [];

            $.ajax({
                url: "{{ route('admin_charts_locations') }}",
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
                        plotLatLng.push(new google.maps.LatLng(item.lat, item.lng));
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            return plotLatLng;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&libraries=visualization&callback=initMap" async defer></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABXHNxtjF9xQGsLuyHcptcKd4lKv6XYak&libraries=visualization&callback=initMap" async defer></script> -->



    @endsection