@extends('layouts.dt')
@section('title', 'Audit Trail')
@section('widget-title', 'General Audit Trail')
@section('widget-desc', 'User Actions')

@section('button')
@endsection

@section('content')
    @include('layouts.includes._messages')

    <table id="audit-trails" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Action Name</th>
            <th>Action Time</th>
            <th>Session Id</th>
            <th>User Name</th>
        </tr>
        </thead>
        <tbody>
            {{--@if(count($audit_trails))--}}
                {{--@foreach($audit_trails as $audit_trail)--}}
                    {{--<tr>--}}
                        {{--<td>{{ $audit_trail->id }}</td>--}}
                        {{--<td>{{ $audit_trail->action_name }}</td>--}}
                        {{--<td>{{ $audit_trail->created_at }}</td>--}}
                        {{--<td>{{ $audit_trail->session_id }}</td>--}}
                        {{--<td>{{ $audit_trail->user_name }}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--@endif--}}
        </tbody>
    </table>
@endsection

@push('js')
<script src="{{ URL::asset('custom_js/user_manager/audit-trails.js') }}"></script>
@endpush