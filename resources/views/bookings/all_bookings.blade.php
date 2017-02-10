@extends('layouts.dt')
@section('title', 'Bookings')
@section('widget-title', 'Bookings')
@section('widget-desc', 'All Bookings')

@section('button')

    <ul class="list-inline list-unstyled pull-right">
        <li>
            <a type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
                <i class="fa fa-plus"></i> Create Booking
            </a>
        </li>
        {{--<li>--}}
        {{--<a data-toggle="modal" href="#edit-route" id="edit-masterfile-btn" class="btn btn-warning btn-sm header-btn  pull-right ">--}}
        {{--<i class="fa fa-edit"></i> Edit Supplier--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a data-toggle="modal" href="#delete-supplier" id="edit-route-btn" class="btn btn-danger btn-sm header-btn pull-right ">--}}
        {{--<i class="fa fa-edit"></i> Delete supplier--}}
        {{--</a>--}}
        {{--</li>--}}
    </ul>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Driver</th>
            <th>Booking Source</th>
            <th>Start Date</th>
            <th>View Details</th>
        </tr>
        </thead>
        <tbody>
        @if(count($bookings))
            @foreach($bookings as $booking)
                <?php
                $client = \App\Masterfile::where('id',$booking->client)->first();
                $driver= \App\Masterfile::where('id',$booking->driver)->first();
                $sources = \App\booking_sources::where('id',$booking->booking_source)->first();
//                print_r($sources);die;
                ?>
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ (!empty($client))? $client->surname.' '.$client->firstname.' '.$client->middlename : '' }}</td>
                    <td>{{ (!empty($driver))? $driver->surname.' '.$driver->firstname.' '.$driver->middlename : '' }}</td>
                    <td>{{ (!empty($sources))? $sources->source_name : '' }}</td>
                    <td>{{ date('D M Y',strtotime($booking->start_date)) }}</td>
                    <td><a href="{{ url('view-booking/'.$booking->id) }}" class="btn btn-success btn-xs ">View Details</a></td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection

{{--@section('modals')--}}
    {{--<div class="modal fade" id="add-user-role" role="dialog" >--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">--}}
                        {{--&times;--}}
                    {{--</button>--}}
                    {{--<h4 class="modal-title">--}}
                        {{--Add Supplier--}}
                    {{--</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body no-padding">--}}

                    {{--<form id="add-menu-form" class="smart-form" action="{{ url('store-supplier') }}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<fieldset>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Supplier Name</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="supplier_name" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Supplier Role</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input">--}}
                                            {{--<select name="role" required class="form-control">--}}
                                                {{--<option value="Garage">Garage</option>--}}
                                            {{--</select>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Code</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="code" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Registration Number</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="number"  name="registration_number" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Phone Number</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="number" required name="phone_number" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">City</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="city" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Physical Location</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="physical_location" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}





                        {{--</fieldset>--}}

                        {{--<footer>--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-save"></i> Save--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">--}}
                                {{--<i class="fa fa-remove"></i> Cancel--}}
                            {{--</button>--}}

                        {{--</footer>--}}
                    {{--</form>--}}


                {{--</div>--}}

            {{--</div><!-- /.modal-content -->--}}
        {{--</div><!-- /.modal-dialog -->--}}
    {{--</div>--}}

    {{--modal for edit--}}
    {{--<div class="modal fade" id="edit-supplier" role="dialog" >--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">--}}
                        {{--&times;--}}
                    {{--</button>--}}
                    {{--<h4 class="modal-title">--}}
                        {{--Edit Supplier--}}
                    {{--</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body no-padding">--}}

                    {{--<form id="edit-supplier-form" class="smart-form"  method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<fieldset>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Supplier Name</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" id="supplier-name" required name="supplier_name" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Supplier Role</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input">--}}
                                            {{--<select name="role" required class="form-control">--}}
                                                {{--<option value="Garage">Garage</option>--}}
                                            {{--</select>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Code</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" id="supp-code" required name="code" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Registration Number</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" id="registration_number"  name="registration_number" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Phone Number</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="number" required name="phone_number" id="phone_number" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">City</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="city" id="city" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Physical Location</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input"> <i class="icon-append fa fa-keyboard-o"></i>--}}
                                            {{--<input type="text" required name="physical_location" id="physical_location" autocomplete="off">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="label col col-2">Status</label>--}}
                                    {{--<div class="col col-10">--}}
                                        {{--<label class="input">--}}
                                            {{--<select name="status" class="form-control" id="supp-status">--}}
                                                {{--<option value="1">Active</option>--}}
                                                {{--<option value="0">Inactive</option>--}}
                                            {{--</select>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</section>--}}





                        {{--</fieldset>--}}

                        {{--<footer>--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-save"></i> Save--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">--}}
                                {{--<i class="fa fa-remove"></i> Cancel--}}
                            {{--</button>--}}

                        {{--</footer>--}}
                    {{--</form>--}}


                {{--</div>--}}

            {{--</div><!-- /.modal-content -->--}}
        {{--</div><!-- /.modal-dialog -->--}}
    {{--</div>--}}

    {{--modal for delete--}}

    {{--<div class="modal fade" id="delete-supplier" role="dialog">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">--}}
                        {{--&times;--}}
                    {{--</button>--}}
                    {{--<h4 class="modal-title">--}}
                        {{--Delete Supplier--}}
                    {{--</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body no-padding">--}}

                    {{--<form id="delete-supplier-form" class="smart-form"  method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<fieldset>--}}
                            {{--<section>--}}
                                {{--<div class="row">--}}
                                    {{--<p class="p col col-10">--}}
                                        {{--Are you sure you want to delete this supplier?--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</section>--}}

                            {{--{{ method_field('DELETE') }}--}}

                        {{--</fieldset>--}}

                        {{--<footer>--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-save"></i> Yes--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-danger" data-dismiss="modal">--}}
                                {{--<i class="fa fa-remove"></i> Cancel--}}
                            {{--</button>--}}

                        {{--</footer>--}}
                    {{--</form>--}}


                {{--</div>--}}

            {{--</div><!-- /.modal-content -->--}}
        {{--</div><!-- /.modal-dialog -->--}}
    {{--</div>--}}
{{--@endsection--}}

@push('js')
{{--<script src="{{ URL::asset('my_js/supplier/all_suppliers.js') }}"></script>--}}
@endpush