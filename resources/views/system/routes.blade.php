@extends('layouts.dt')
@section('title', 'Routes')
@section('page-title', 'Manage Routes')
@section('widget-title', 'Manage Routes')
@section('widget-desc', 'Manage All the System Routes')
@section('table-title', 'Routes')

@push('js')
    <script src="{{ URL::asset('my_js/system/routes.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/dashboard') }}"> Home</a></li>
    <li>System</li>
    <li>Routes</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
        <a data-toggle="modal" href="#add-route" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
            <i class="fa fa-plus"></i> Add Route
        </a>

        <a data-toggle="modal" href="#edit-route" id="edit-route-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
            <i class="fa fa-edit"></i> Edit Route
        </a>

        <a data-toggle="modal" id="delete-route-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
            <i class="fa fa-trash"></i> Delete Route(s)
        </a>

        <a data-toggle="modal" id="refresh-dt" class="btn btn-info btn-sm header-btn hidden-mobile">
            <i class="fa fa-refresh"></i> Refresh
        </a>
    {{--</span>--}}
@endsection

@section('content')
    @section('table-id', '#routes')

    <div class="alert alert-success" style="display: none;" id="success">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Route has been added!
    </div>

    <div class="alert alert-success" style="display: none;" id="ed-success">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Route has been updated!
    </div>

    <div class="alert alert-warning" style="display: none" id="warnings">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Warnings!</strong>
        <ul></ul>
    </div>

    <table id="routes" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Route#</th>
                <th>Route Name</th>
                <th>url</th>
                <th>Parent Route</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="add-route" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Route
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-route-form" class="smart-form" action="{{ url('add-route') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="route_name">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">URL</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="url">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Parent</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <select name="parent" id="add-parent" class="form-control" style="width: 100%"></select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
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
    <!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="edit-route" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Update Route
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-route-form" class="smart-form" action="{{ url('edit-route') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="route_name" id="route_name">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">URL</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="url" id="url">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Parent</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="parent" id="parent" class="form-control" style="width: 100%">
                                                <option value="">--No Parent--</option>
                                                @if(count($proutes))
                                                    @foreach($proutes as $proute)
                                                        <option value="{{ $proute->id }}">{{ $proute->route_name }}</option>
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

                        {{--hidden fields--}}
                        <input type="hidden" id="edit_id" name="edit_id"/>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Changes
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
    <!-- /.modal -->
@endsection