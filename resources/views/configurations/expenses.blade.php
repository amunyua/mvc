@extends('layouts.dt')
@section('title', 'Expenses')
@section('widget-title', 'Manage Expenses')
@section('widget-desc', 'Daily Expenses')

@section('button')
    <button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-expense">
        <i class="fa fa-plus"></i> Add Expense
    </button>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Expense</th>
            <th>Code</th>
            <th>Amount</th>
            <th>Amount Type</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($expenses))
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->expense_name }}</td>
                    <td>{{ $expense->code }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->amount_type }}</td>
                    <td><?php echo ($expense->status == 1)? '<span class="label label-success"> Active </span>':'<span class="label label-danger">Inactive</span>' ?></td>

                    <td> <a href="#edit-expense-modal" class="btn btn-warning btn-xs edit-expense-btn" action="{{ url('/edit-expense/'.$expense->id) }}" data-toggle="modal" edit-id="{{ $expense->id }}">Edit </a> </td>
                    <td> <a href="#delete-expense" class="btn btn-danger btn-xs delete-expense-btn"  action="{{ url('/delete-expense/'.$expense->id) }}" data-toggle="modal" del-id="{{ $expense->id }}">Delete </a> </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <div class="modal fade" id="add-expense" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add An Expense
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('add-expense') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Expense</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="expense_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Expense Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="amount" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount Type</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="amount_type" required class="form-control">
                                                <option value="Fixed">Fixed</option>
                                                <option value="Custom">Custom</option>
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
                                            <select name="status" required class="form-control">
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
    <div class="modal fade" id="edit-expense-modal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit Expense Entry
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-expense-form" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Expense</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required id="expense_name" name="expense_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Expense Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" id="code" required name="code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="amount" id="amount" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Amount Type</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="amount_type" id="amount_type" required class="form-control">
                                                <option value="Fixed">Fixed</option>
                                                <option value="Custom">Custom</option>
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
                                            <select name="status" id="status" required class="form-control">
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

    <div class="modal fade" id="delete-expense" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Expense Entry
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-expense-form" class="smart-form" method="post">
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
@endsection

@push('js')
<script src="{{ URL::asset('my_js/configurations/expenses.js') }}"></script>
@endpush