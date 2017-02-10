@extends('layouts.dt')
@section('title', 'User Roles')
@section('widget-title', 'Manage User Roles')
@section('widget-desc', 'System Roles')

@section('button')
    <ul class="list-inline pull-right">
        <li>
            <button class="btn btn-primary btn-sm header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
                <i class="fa fa-plus"></i> Add User Role
            </button>
        </li>
        <li>
            <button class="btn btn-info btn-sm header-btn hidden-mobile" id="allocate-routes-view"  data-target="#allocate-routes">
                <i class="fa fa-paperclip"></i> Allocate Routes
            </button>
        </li>
    </ul>
@endsection

@section('content')
    @include('layouts.includes._messages')
    @section('table-id', '#dt_basic')
    <table id="dt_basic" class="table table-striped table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Role Name</th>
            <th>Role code</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($mfs))
            @foreach($mfs as $mf)
                <tr>
                    <td>{{ $mf->id }}</td>
                    <td>{{ $mf->role_name }}</td>
                    <td>{{ $mf->role_code }}</td>
                    <td><?php echo ($mf->status == 0)? '<span class="btn btn-success btn-xs "> Active </span>':'<span class="label label-danger">Blocked</span>' ?></td>
                    <td><a href="#edit-role-modal" edit-id="{{ $mf->id }}" action="{{ url('edit-user-role/'.$mf->id) }}" data-toggle="modal" class="btn btn-success btn-xs edit-role-btn">Edit</a> </td>

                    <td> <a href="#delete-user-role" class="btn btn-danger btn-xs del_role" data-toggle="modal" del-id="{{ $mf->id }}">Delete </a> </td>
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
                        Add User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('add-user-role') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_name" value="{{ old('role_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_code" value="{{ old('role_code') }}">
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

    {{--modal for delete--}}
    <div class="modal fade" id="delete-user-role" role="dialog">
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

                    <form id="delete-role" class="smart-form" action="{{ url('delete-user-role') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this role?
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


    {{--modal for edit--}}
    <div class="modal fade" id="edit-role-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-userrole-form" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_name" id="role_name" >
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_code" id="role_code">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control" id="status">
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

    {{--modal for allocation--}}
    <div class="modal fade" id="allocate-routes" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Allocate Routes to <b>{{ strtoupper('Administrator') }}</b>
                    </h4>
                </div>
                <div class="modal-body" style="height: 520px; overflow-y: scroll;">
                    {{ csrf_field() }}
                    <table id="routes-for-allocation" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Route</th>
                                <th>Parent</th>
                                <td><input type="checkbox" id="check-all" class="custom_checkbox"/></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($routes))
                                @foreach($routes as $route)
                                    @php
                                        $parent_route = \App\Route::find($route->parent_route)->route_name;
                                    @endphp
                                    <tr>
                                        <td>{{ $route->route_name }}</td>
                                        <td>{{ $parent_route }}</td>
                                        <td><input type="checkbox" class="attach custom_checkbox" value="{{ $route->id }}" role-id=""/></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @endsection

@push('js')
<script src="{{ URL::asset('custom_js/user_manager/user_roles.js') }}"></script>
@endpush