@extends('layouts.dt')
@section('title', 'Daily Accounts')
@section('widget-title', 'Manage Account')
@section('widget-desc', 'All Transactions')

@section('button')
    <button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
        <i class="fa fa-plus"></i> Create Transaction
    </button>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Driver</th>
            <th>Trips</th>
            <th>Total Coll</th>
            <th>View Report</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($daily_trans))
            @foreach($daily_trans as $daily_tran)
                <?php
                $driver = \App\Masterfile::find($daily_tran->driver_id);
                ?>
                <tr>
                    <td>{{ $daily_tran->id }}</td>
                    <td>{{ date('d M Y',$daily_tran->transaction_date) }}</td>
                    <td>{{ $driver->surname.' '.$driver->firstname.' '.$driver->middlename }}</td>
                    <td>{{ $daily_tran->total_trips }}</td>
                    <td>{{ $daily_tran->total_amount_collected }}</td>
                    <td><a href="{{ url('view-report/'.$daily_tran->id) }}" class="btn btn-xs btn-success">View report</a></td>
                    <td><a action="{{ url('delete-transaction/'.$daily_tran->id) }}" data-toggle="modal" data-target="#delete-transaction" class="btn btn-xs btn-danger delete-btn">Delete </a></td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <div class="modal fade" id="add-user-role" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Record Transaction
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('/store-transaction') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Vehicle</strong></label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="vehicle" required  class="form-control">
                                                @if(count($buses)){
                                                    @foreach($buses as $bus)
                                                        <option value="">Please Select a bus</option>
                                                        <option value="{{ $bus->id }}">{{ $bus->number_plate }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </label>
                                    </div>

                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Date</strong></label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="date" required name="transaction_date" value="{{ date('Y-m-d') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Driver</strong></label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="driver_id" required class="form-control">
                                                <option value="">Please Select a driver</option>
                                                @if(count($drivers)){
                                            @foreach($drivers as $driver)
                                                    <option value="{{ $driver->id }}">{{ $driver->firstname.' '.$driver->middlename }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Conductor</strong></label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="conductor" required class="form-control">
                                                <option value="">Please Select conductor</option>
                                                @if(count($conductors)){
                                                @foreach($conductors as $conductor)
                                                    <option value="{{ $conductor->id }}">{{ $conductor->firstname.' '.$conductor->sirname }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Trips</strong></label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="total_trips" value="{{ old('total_trips') }}" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Total collected</strong></label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="total_amount_collected" value="{{ old('total_amount_collected') }}" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>



                            @if(count($expenses))
                                @foreach($expenses as $expense)
                                    <section>
                                        <div class="row">
                                            <label class="label col col-2"><strong> {{ $expense->expense_name }} </strong></label>
                                            <div class="col col-10">
                                                <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                                    <input type="number" required name="{{ $expense->id }}" value="{{ old($expense->id) }}" autocomplete="off">
                                                </label>
                                            </div>
                                        </div>

                                    </section>
                                    @endforeach
                                @endif

                            <section>
                                <div class="row">
                                    <label class="label col col-2"><strong>Actual Banked</strong></label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="actual_banked" value="{{ old('actual_banked') }}" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>


                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    {{--modal for delete--}}

    <div class="modal fade" id="delete-transaction" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete transaction
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-transaction-form" class="smart-form"  method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this Transaction?
                                    </p>
                                </div>
                            </section>

                            {{ method_field('DELETE') }}

                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('js')
<script src="{{ URL::asset('my_js/accounts/accounts.js') }}"></script>
@endpush