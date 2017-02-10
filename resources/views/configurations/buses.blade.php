@extends('layouts.dt')
@section('title', 'All buses')
@section('widget-title', 'Manage Buses')
@section('widget-desc', 'All Buses')

@section('button')
    <button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
        <i class="fa fa-plus"></i> Add Bus
    </button>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Number plate</th>
            <th>Alias</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($buses))
        @foreach($buses as $bus)
        <tr>
        <td>{{ $bus->id }}</td>
        <td>{{ $bus->number_plate }}</td>
        <td>{{ $bus->alias_name }}</td>
        <td><?php echo ($bus->status == 1)? '<span class="label label-success"> Active </span>':'<span class="label label-danger">Blocked</span>' ?></td>
        <td><a href="#edit-bus" class="btn btn-warning btn-xs edit-bus-btn" action="{{ url('edit-bus/'.$bus->id) }}" data-toggle="modal" edit-id="{{ $bus->id }}">edit </a> </td>
        <td> <a href="#delete-bus-modal" class="btn btn-danger btn-xs del_bus-btn" action="{{ url('delete-bus/'.$bus->id) }}" data-toggle="modal" del-id="{{ $bus->id }}">Delete </a> </td>
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
                        Add Bus
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('add-bus') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Number Plate</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" value="{{ old('number_plate') }}" name="number_plate" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Alias Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" value="{{ old('alias_name') }}" name="alias_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Owner</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="owner_id" class="form-control">
                                                <option value="1">Select Owner</option>
                                                        @if(count($owners))
                                                            @foreach($owners as $owner)
                                                                <option value="{{ $owner->id }}">{{ $owner->firstname.' '.$owner->surname }}</option>
                                                                @endforeach
                                                            @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>




                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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

    {{--modal for edit--}}
    <div class="modal fade" id="edit-bus" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Bus
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-bus-form" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Number Plate</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" id="number-plate" value="{{ old('number_plate') }}" name="number_plate" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Alias Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" id="alias_name" value="{{ old('alias_name') }}" name="alias_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Owner</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="owner_id" id="owner_id" class="form-control">
                                                <option value="1">Select Owner</option>
                                                @if(count($owners))
                                                    @foreach($owners as $owner)
                                                        <option value="{{ $owner->id }}">{{ $owner->firstname.' '.$owner->surname }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>




                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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

    <div class="modal fade" id="delete-bus-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-bus-form" class="smart-form"  method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this bus?
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
<script src="{{ URL::asset('my_js/configurations/buses.js') }}"></script>
@endpush