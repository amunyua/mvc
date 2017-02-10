@extends('layouts.nestable')
@section('title', 'Menu')
@section('widget-title', '<i class="fa fa-list fa-fw "></i> Manage Menu')
@section('widget-desc', 'Manage the sidemenu')

@push('js')
    <script src="{{ URL::asset('my_js/system/menu.js') }}"></script>
@endpush

@section('content')
    <div id="nestable-menu">
        <button type="button" class="btn btn-default" data-action="expand-all">
            Expand All
        </button>
        <button type="button" class="btn btn-default" data-action="collapse-all">
            Collapse All
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-menu">
            <i class="fa fa-plus"></i> Add Menu
        </button>

        <button type="button" class="btn btn-success" id="save_menu_changes">
            <i class="fa fa-save"></i> Save
        </button>

        <button type="button" class="btn btn-danger" id="delete_menu_item">
            <i class="fa fa-trash"></i> Delete
        </button>
    </div>
    @include('common.warnings')
    @include('common.success')
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <h6>Side Menu</h6>
            <div class="dd" id="nestable3">
                <?php
                    $mn = new \App\Http\Controllers\MenuController;
                    $mn->getMenu($parent = NULL);
                ?>
            </div>
        </div>
    </div>
    <form id="arrange_menu" action="arrange-menu" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="menu_data" id="nestable2-output" rows="3" class="form-control font-md"/>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="add-menu" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Menu Item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('add-menu') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Route</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <select name="route" id="route" class="live_search" style="width: 100%;">
                                                <option value="">--Choose Route--</option>
                                                @if(count($routes)))
                                                    @foreach($routes as $route)
                                                        <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Fa Icon</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <select name="fa_icon" class="live_search" style="width: 100%;">
                                                <option value="">--Choose Icon--</option>
                                                @if(count($fas))
                                                    @foreach($fas as $fa)
                                                        <option value="{{ $fa->icon_name }}">{{ $fa->icon_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Parent</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <select name="parent_menu" class="live_search" style="width: 100%;">
                                                <option value="">--Choose Parent Menu--</option>
                                                @if(count($menus))
                                                    @foreach($menus as $menu)
                                                        <?php
                                                            $route_name = \App\Route::find($menu->route_id)->route_name;
                                                        ?>
                                                        <option value="{{ $menu->id }}">{{ $route_name }}</option>
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
    <!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="edit-menu" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Update Menu Item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('edit-menu') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Route</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="route" id="route" class="form-control">
                                                <option value="">--Choose Route--</option>
                                                @if(count($routes)))
                                                @foreach($routes as $route)
                                                    <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Fa Icon</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="fa_icon" id="fa_icon" class="form-control">
                                                <option value="">--Choose Icon--</option>
                                                @if(count($fas))
                                                    @foreach($fas as $fa)
                                                        <option value="{{ $fa->icon_name }}">{{ $fa->icon_name }}</option>
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
@endsection