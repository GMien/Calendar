<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Calendar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    @php ($days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'])
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-6 viewport_height">
                    <div class="container p-5 mt-5 align-items-center justify-content-center">
                        <h2>Calendar</h2>
                        <h5 class="subtitle mt-4">Event</h5>
                        <input type="text" class="form-control" id="event_title" placeholder="Event title">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5 class="subtitle">From</h5>
                                <input type="date" id="start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <h5 class="subtitle">To</h5>
                                <input type="date" id="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            @for ($i = 0; $i < count($days); $i++)
                              <div class="form-check mr-2">
                              <input type="checkbox" class="form-check-input" value="{{ $i }}" id="day_{{ $i }}">
                              <label class="form-check-label" for="exampleCheck1">{{ $days[$i] }}</label>
                              </div>
                            @endfor
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary" onclick="addEvent(); return false;">Save</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 viewport_height">
                    <div class="p-5 mt-5 d-flex align-items-center justify-content-center">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    var SITEURL;
    var selectedday = [];
    var totaldays = {!! json_encode($days) !!};
    $(document).ready(function() {
        SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       renderCalendar();
    });
</script>
<script src="{{ asset('js/main/main.js') }}"></script>
</body>
</html>