@extends('layouts.dt')
@section('title', 'Supplier Invoice')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Reports</li>
    <li><a href="{{ url('invoices') }}">All invoices</a> </li>
@endsection
@section('widget-title', 'Supplier Report')
@section('widget-desc', 'Supplier Report')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
    {{--<i class="fa fa-plus"></i> Create Transaction--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th colspan="2" rowspan="3" style="text-align: center; font-size: 20px">
                <?php
                    if(!empty($reports[0]->supplier_id)){
                        $supplier = \App\Supplier::find($reports[0]->supplier_id);
                        echo $supplier->supplier_name.'<br>';
                        $vehicle = \App\Bus::find($reports[0]->vehicle_id);
                        echo $vehicle->number_plate.'<br>';
                        echo date('D M Y',strtotime($reports[0]->transaction_date));
                    }
                ?>
            </th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>Product</th>
                <th>Amount</th>
            </tr>
            @if(count($reports))
                <?php $total_amount = 0 ;?>
                @foreach($reports as $report)
                    <?php
                        $item = \App\SupplierEntity::find($report->item_id);
                        $total_amount = $total_amount + $report->amount ?>
                    <tr>
                       <td>{{ $item->item_name }}</td>
                       <td>{{ number_format($report->amount,2) }}</td>
                    </tr>
                    @endforeach
                @endif
            <tr>
                <td style="font-weight: bold;">Totals</td>
                <td style="font-weight: bold">{{ (isset($total_amount))? number_format($total_amount,2): '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;font-weight:bold"> []</td>
            </tr>
        </tbody>
    </table>
@endsection

