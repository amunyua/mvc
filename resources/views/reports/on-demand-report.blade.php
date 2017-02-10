@extends('layouts.dt')
@section('title', 'On Demand Report')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Reports</li>
    <li>On Demand Report</li>
@endsection
@section('widget-title', 'Transaction Report')
@section('widget-desc', 'General Report')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
    {{--<i class="fa fa-plus"></i> Create Transaction--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
    <div class="widget-body-toolbar">

        <div class="row">

            <div class="col-sm-4">
                <form method="post" action="{{ url('filter_report') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="driver_id" required class="form-control">
                            <option value="">Select Driver</option>
                            @if(count($drivers))
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->firstname.' '.$driver->sirname.' '.$driver->middlename  }}</option>
                                    @endforeach
                                @endif

                        </select>
                        {{--<input class="form-control" type="text" placeholder="Type invoice number or date...">--}}
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <form method="post" action="{{ url('filter_report') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input required class="form-control m-wrap m-ctrl-medium  date_range" type="text" name="date_range" placeholder="Select a date range to search...">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <table class="table table-striped table-bordered table-hover " width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle</th>
            <th>Date</th>
            <th>Driver</th>
            <th>Conductor</th>
            <th>Total Coll.</th>
            <th>Total Trips</th>
            <th>Total Expenses</th>
            <th>Bank Expected</th>
            <th>Actual Banked</th>
            <th>Variance</th>
            <th>Fuel Ratio</th>
        </tr>
        </thead>
        <tbody>
        @if(count($reports))
            <?php $total_amount_col = 0;
                    $total_trips = 0;
                    $total_expenses = 0;
                    $total_expected=0;
                    $total_banked = 0;
                    $total_variance = 0;
                    $variance_t = 0
            ?>
            @foreach($reports as $report)
                <?php $bank_details = \Illuminate\Support\Facades\DB::table('daily_bank_accumulations')
                    ->where('transaction_id',$report->id)->first();
                    $vehicle_plates = \App\Bus::find($report->bus_id);
                    $driver = \App\Masterfile::find($report->driver_id);
                    $conductor = \App\Masterfile::find($report->conductor_id);
                    $total_amount_col = $total_amount_col + $report->total_amount_collected;
                    $total_trips = $total_trips + $report->total_trips;
                    $expense = \Illuminate\Support\Facades\DB::table('daily_expenses')
                            ->select(\Illuminate\Support\Facades\DB::raw('sum(amount) as total_expenses'))
                            ->where('transaction_id',$report->id)->first();
                    $total_expenses = $total_expenses + $expense->total_expenses;


                        //get the fuel ratio
                    //first we get the expense if where code = FUEL
                    $name = \Illuminate\Support\Facades\DB::table('expenses')
                            ->select('id')
                            ->where('code','FUEL')->first();
                    //now since we have the expense id, we can get the amount of fuel consumed on a specific day
                    $fuel_amount = \Illuminate\Support\Facades\DB::table('daily_expenses')
                        ->select(\Illuminate\Support\Facades\DB::raw('amount'))
                        ->where([
                                ['transaction_id',$report->id],
                                ['expense_id',$name->id]
                            ])
                        ->first();
                    //now ew have the amount of fuel consumed on that day
                        //to get the ratio we devide this amount by the number of trips
                    $fuel_ratio = $fuel_amount->amount/$report->total_trips;
                    $total_expected=0;
                    $total_banked = $total_banked  + $bank_details->actual_banked ;
                    $total_variance = 0;
                    $t_C = $report->total_amount_collected;
                    $e = $expense->total_expenses;
                    $e_b = $t_C - $e;
                    $variance = $e_b - $bank_details->actual_banked;
                    $variance_t = $variance_t + $variance;
                    ?>
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $vehicle_plates->number_plate }}</td>
                    <td>{{ date('d M Y',$report->transaction_date) }}</td>
                    <td>{{ $driver->surname.' '.$driver->firstname.' '.$driver->middlename }}</td>
                    <td>{{ $conductor->surname.' '.$conductor->firstname.' '.$conductor->middlename }}</td>
                    <td><?php echo number_format($report->total_amount_collected,2) ?></td>
                    <td>{{ $report->total_trips }}</td>
                    <td>{{  number_format($expense->total_expenses,2) }}</td>
                    <td>{{ number_format($t_C - $e,2) }}</td>
                    <td>{{ number_format($bank_details->actual_banked,2) }}</td>
                    <td>{{ number_format($variance,2) }}</td>
                    <td>{{ number_format($fuel_ratio,2) }}</td>
                </tr>
            @endforeach
                <tr>

                    <td colspan="5" style="text-align:right;font-weight:bold;font-style: italic">Totals:</td>
                    <td style="font-weight:bold">{{ number_format($total_amount_col,2) }}</td>
                    <td style="font-weight:bold">{{ $total_trips }}</td>
                    <td style="font-weight:bold">{{ number_format($total_expenses,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($total_amount_col - $total_expenses,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($total_banked,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($variance_t,2) }}</td>
                    <td style="font-weight:bold"></td>

                </tr>
                <tr>
                    <td colspan="12" style="text-align:right;font-weight:bold"> []</td>
                    {{--<td colspan="2" style="text-align:right;font-weight:bold"></td>--}}
                </tr>
            @endif
        </tbody>
    </table>
    <button class="btn btn-block btn-success di" onclick="window.print();">Print</button>
@endsection

