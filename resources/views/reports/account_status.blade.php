@extends('layouts.dt')
@section('title', 'Balance Sheet')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Reports</li>
    <li>On Demand Report</li>
@endsection
@section('widget-title', 'Account Status')
@section('widget-desc', 'Balance sheet')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
    {{--<i class="fa fa-plus"></i> Create Transaction--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
    {{--<div class="widget-body-toolbar">--}}

        {{--<div class="row">--}}

            {{--<div class="col-sm-4">--}}
                {{--<form method="post" action="{{ url('filter_report') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="input-group">--}}
                        {{--<select name="driver_id" required class="form-control">--}}
                            {{--<option value="">Select Driver</option>--}}
                            {{--@if(count($drivers))--}}
                                {{--@foreach($drivers as $driver)--}}
                                    {{--<option value="{{ $driver->id }}">{{ $driver->firstname.' '.$driver->sirname.' '.$driver->middlename  }}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}

                        {{--</select>--}}
                        {{--<input class="form-control" type="text" placeholder="Type invoice number or date...">--}}
                        {{--<div class="input-group-btn">--}}
                            {{--<button class="btn btn-default" type="submit">--}}
                                {{--<i class="fa fa-search"></i> Search--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<form method="post" action="{{ url('filter_report') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="input-group">--}}
                        {{--<input required class="form-control m-wrap m-ctrl-medium  date_range" type="text" name="date_range" placeholder="Select a date range to search...">--}}
                        {{--<div class="input-group-btn">--}}
                            {{--<button class="btn btn-default" type="submit">--}}
                                {{--<i class="fa fa-search"></i> Search--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}
    <table class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle</th>
            <th>Date</th>
            {{--<th>Details</th>--}}
            <th>Description</th>
            <th>Debit</th>
            <th>Credit</th>

        </tr>
        </thead>
        <tbody>
            @if(count($journals))
                <?php $total_credit = 0; $total_debit =0; ?>
                @foreach($journals as $journal)
                    <?php
                        $vehicle = \App\Bus::find($journal->bus_id);
//                            print_r($vehicle);
                        if ($journal->dr_cr == 'DB'){
                            $total_debit = $total_debit + $journal->amount;
                        }elseif ($journal->dr_cr == 'CR'){
                            $total_credit = $total_credit + $journal->amount;
                        }
                    ?>
                    <tr>
                        <td>{{ $journal->id }}</td>
                        <td>{{ (!empty($vehicle->number_plate))? $vehicle->number_plate: '' }}</td>
                        <td>{{ $journal->journal_date }}</td>
                        {{--<td>{{(!empty($journal->bill_id))? $journal->bill_id : '<a class="btn btn-xs btn-success" href="'.url('/view-report/'.$journal->daily_transaction_id).'">View details</a>' }}</td>--}}
                        <td>{{ $journal->particulars }}</td>
                        <td>{{ ($journal->dr_cr == 'DB')? '-'.$journal->amount : '' }}</td>
                        <td>{{ ($journal->dr_cr == 'CR')? $journal->amount : '' }}</td>
                    </tr>
                    @endforeach
                <tr>
                    <th colspan="4" style="text-align: right">Totals</th>
                    <th><?php echo '- '.number_format($total_debit,2) ?></th>
                    <th>{{  number_format($total_credit,2) }}</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: right">Runnig Ballance</th>
                    <th>{{ number_format(($total_credit - $total_debit),2) }}</th>
                </tr>
            @endif
        </tbody>
    </table>
@endsection

