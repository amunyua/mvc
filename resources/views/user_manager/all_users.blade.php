@extends('layouts.dt')
@section('title', 'All Users')
@section('widget-title', 'Manage User Roles')
@section('widget-desc', 'All Users')

@section('button')

@endsection

@section('content')
@include('layouts.includes._messages')
{{--@section('table-id', '#dt_basic')--}}
{{ csrf_field() }}
<div id="feedback"></div>
<table id="dt_basic" class="table table-striped table-hover" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role Name</th>
        <th>Status</th>
        <th>Block/Unblock</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @if(count($mfs))
    @foreach($mfs as $mf)
    <tr>
        <td>{{ $mf->id }}</td>
        <td>{{ $mf->name }}</td>
        <td>{{ $mf->role_name }}</td>
        <td><?php echo ($mf->status == 1)? '<span class="badge bg-color-green"> Active </span>':'<span class="badge">Blocked!</span>' ?></td>
        <td>
            @if($mf->status)
                <button class="btn btn-xs btn-danger block-btn" user-id="{{ $mf->user_id }}"><i class="fa fa-close"></i> Block</button></td>
            @else
                <button class="btn btn-xs btn-success unblock-btn" user-id="{{ $mf->user_id }}"><i class="fa fa-check"></i> Unblock</button></td>
            @endif
        <td> <a href="{{ url('delete-user/'.$mf->user_id) }}" class="btn btn-danger btn-xs delete_user" data-toggle="modal" del-id="{{ $mf->user_id }}"><i class="fa fa-trash-o"></i> Delete </a> </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>
@endsection

@push('js')
    <script src="{{ URL::asset('my_js/user_manager/user_manager.js') }}"></script>
@endpush