@extends('layouts.dt')
@section('title', 'Suppliers Items')
@section('widget-title', 'Manage Supplier Items')
@section('widget-desc', 'All Supplier items')

@section('button')
    <button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
        <i class="fa fa-plus"></i> Add item
    </button>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Supplier </th>
            <th>Amount</th>
            <th>status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @if(count($supplier_items))
                @foreach($supplier_items as $supplier_item)
                    <?php $supplier = \App\Supplier::find($supplier_item->supplier_id) ?>
                    <tr>
                        <td>{{ $supplier_item->id }}</td>
                        <td>{{ $supplier_item->item_name }}</td>
                        <td>{{ $supplier_item->item_code }}</td>
                        <td>{{ (!empty($supplier->supplier_name))? $supplier->supplier_name: '' }}</td>
                        <td>{{ $supplier_item->amount }}</td>
                        <td>{{ ($supplier_item->status == 1)? 'Active':'Inactive' }}</td>
                        <td><a href="#edit-supplier-modal" data-toggle="modal" edit-id="{{ $supplier_item->id }}" action="{{ url('edit-sup-e/'.$supplier_item->id) }}" class="btn btn-warning btn-xs edit-s-p">edit</a> </td>
                        <td><a href="#delete-supplier-i" data-toggle="modal" action="{{ url('delete-sup-e/'.$supplier_item->id) }}" class="btn btn-danger btn-xs delete-s-p">Delete</a> </td>
                    </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <div class="modal fade" id="add-user-role" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('store-supplier-item') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="supplier_id" required class="form-control">
                                                <option value="">select supplier</option>
                                                @if(count($suppliers))
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Item Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required value="{{ old('item_name') }}" name="item_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>



                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required value="{{ old('item_code') }}"name="item_code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" value="{{ old('amount') }}"  name="amount" autocomplete="off">
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

    <div class="modal fade" id="edit-supplier-modal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit supplier item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-supplier-entity-form" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="supplier_id" id="supplier-e-id" required class="form-control">
                                                <option value="">select supplier</option>
                                                @if(count($suppliers))
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Item Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" id="s-item_name" required value="{{ old('item_name') }}" name="item_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>



                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" id="s-item-code" required value="{{ old('item_code') }}"name="item_code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" id="s-item-amount" value="{{ old('amount') }}"  name="amount" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <select name="status" id="i-status" class="form-control">
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

    <div class="modal fade" id="delete-supplier-i" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Supplier item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-supp-item" class="smart-form" action="{{ url('delete-user-role') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this supplier item?
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
<script src="{{ URL::asset('my_js/supplier/supplier-entity.js') }}"></script>
@endpush