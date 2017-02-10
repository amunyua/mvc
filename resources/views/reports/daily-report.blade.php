@extends('layouts.dt')
@section('title', 'Reservations')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Bookings</li>
    <li>Reservation Details</li>
@endsection
@section('widget-title', 'Booking Reservation Details')
@section('widget-desc', '')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
        {{--<i class="fa fa-plus"></i> Create Transaction--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Booking reference</th>
            <th>Date</th>
            <th>Night Stops</th>
        </tr>
        </thead>
       <tbody>
       @if(count($bookings))
           @foreach($bookings as $booking)
               <?php
                $stop = \App\NightStops::where('id',$booking->night_stops)->first()->name;
               ?>
       <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->booking_id }}</td>
            <td>{{ date('D M Y',strtotime($booking->day)) }}</td>
            <td>{{ $stop }}</td>
       </tr>
           @endforeach
           @endif
       </tbody>
    </table>
@endsection

