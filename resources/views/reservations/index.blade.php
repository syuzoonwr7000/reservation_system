@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('予約可能日一覧') }}</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ __(session('error')) }}</div>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('reservations.create') }}" class="btn btn-outline-info">{{ __('予約枠追加') }}</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<style>
    .fc-day[data-reservable="0"] {
        background-color: #eee !important;
        cursor: not-allowed;
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                @foreach($reservations as $reservation)
                {
                    title: '{{ $reservation->start_time->format('G:i') }}',
                    start: '{{ $reservation->start_time }}',
                    end: '{{ $reservation->end_time }}',
                    url: '{{ route('reservations.show', $reservation->id) }}',
                    reservable: '{{ $reservation->reservable }}'
                },
                @endforeach
            ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: '今日',
                month: '月',
                week: '週',
                day: '日'
            },
            editable: false,
            eventLimit: true,
            displayEventTime: true,
            dayRender: function(date, cell) {
                var reservable = false;
                $('#calendar').fullCalendar('clientEvents', function(event) {
                    var eventStart = moment(event.start).startOf('day');
                    var eventEnd = moment(event.end).startOf('day');
                    var current = moment(date).startOf('day');
                    if (current.isBetween(eventStart, eventEnd) || current.isSame(eventStart) || current.isSame(eventEnd)) {
                        if (event.reservable == 1) {
                            reservable = true;
                            return false; // Break the loop
                        }
                    }
                });
                if (!reservable) {
                    $(cell).addClass('fc-day').attr('data-reservable', '0');
                }
            }
        });
    });
</script>
@stop
    