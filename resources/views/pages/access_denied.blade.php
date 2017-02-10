@extends('layouts.pages_layout')
@section('title', 'Access Denied')
@section('page-title', 'Access Denied')
@section('error-code', 'Error 403')

@section('breadcrumb')
    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li><li>Access Denied</li>
@endsection

@section('content')
    <h2 class="font-xl"><strong><i class="fa fa-fw fa-warning fa-lg text-warning"></i> Access Denied!</strong></h2>
    <br />
    <p class="lead">
        You have been denied access to this page, please contact the Administrator.
    </p>
    {{--<p class="font-md">--}}
    {{--<b>... That didn't work on you? Dang. May we suggest a search, then?</b>--}}
    {{--</p>--}}
    {{--<br>--}}
    {{--<div class="error-search well well-lg padding-10">--}}
    {{--<div class="input-group">--}}
    {{--<input class="form-control input-lg" type="text" placeholder="let's try this again" id="search-error">--}}
    {{--<span class="input-group-addon"><i class="fa fa-fw fa-lg fa-search"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="row">

        <div class="col-sm-12">
            <ul class="list-inline">
                <li>
                    &nbsp;<a href="{{ url('/dashboard') }}">Dashboard</a>&nbsp;
                </li>
                {{--<li>--}}
                {{--.--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--&nbsp;<a href="javascript:void(0);">Inbox (14)</a>&nbsp;--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--.--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--&nbsp;<a href="javascript:void(0);">Calendar</a>&nbsp;--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--.--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--&nbsp;<a href="javascript:void(0);">Gallery</a>&nbsp;--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--.--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--&nbsp;<a href="javascript:void(0);">My Profile</a>&nbsp;--}}
                {{--</li>--}}
            </ul>
        </div>

    </div>
@endsection