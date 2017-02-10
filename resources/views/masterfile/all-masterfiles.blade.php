@extends('layouts.dt')
@section('title', 'Masterfiles')
@section('widget-title', 'Manage Masterfiles')
@section('widget-desc', 'All Masterfiles')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>MasterFiles</li>
    <li>All Masterfiles</li>
@endsection

@section('button')
    {{--<ul class="list-inline list-unstyled pull-right">--}}
    {{--<li>--}}
    {{--<a data-toggle="modal" href="#edit-route" id="edit-masterfile-btn" class="btn btn-warning btn-sm header-btn  pull-right ">--}}
        {{--<i class="fa fa-edit"></i> Edit masterfile--}}
    {{--</a>--}}
    {{--</li>--}}
        {{--<li>--}}
            {{--<a data-toggle="modal" href="#edit-route" id="edit-route-btn" class="btn btn-danger btn-sm header-btn pull-right ">--}}
                {{--<i class="fa fa-edit"></i> Delete masterfile--}}
            {{--</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
    @endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="masterfiles" class="table table-striped table-bordered table-hover " width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>ID no</th>
            <th>Business Role</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Physical Addres</th>
            <th>City</th>
            <th>Postal Address</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @if(count($all_masterfiles))
                @foreach($all_masterfiles as $masterfile)
                    <?php $contact = \App\Contact::where('masterfile_id',$masterfile->id)->first(); ?>
                    <tr>
                        <th>{{ $masterfile->id }}</th>
                        <th>{{ $masterfile->sirname.' '.$masterfile->firstname.' '.$masterfile->middlename }}</th>
                        <th>{{ $masterfile->id_no }}</th>
                        <th>{{ $masterfile->user_role }}</th>
                        <th>{{ (!empty($contact->phone_number))? $contact->phone_number:''  }}</th>
                        <th>{{ (!empty($contact->email))? $contact->email:''  }}</th>
                        <th>{{ (!empty($contact->physical_address))? $contact->physical_address:''  }}</th>
                        <th>{{ (!empty($contact->city))? $contact->city:''  }}</th>
                        <th>{{ (!empty($contact->postal_address))? $contact->postal_address:''  }}</th>
                        <th><a href="#delete-masterfile" action="{{ url('delete-masterfile/'.$masterfile->id ) }}" class="btn btn-danger btn-xs delete-masterfile-btn" id="" data-toggle="modal">Delete</a> </th>
                    </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
@endsection
@push('js')
<script src="{{ URL::asset('my_js/masterfile/all_masterfiles.js') }}"></script>
@endpush

@section('modals')
    <div class="modal fade" id="delete-masterfile" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Masterfile
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-masterfile-form" class="smart-form"  method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this Masterfile?
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

