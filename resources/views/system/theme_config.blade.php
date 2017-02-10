@extends('layouts.skins_layout')
@section('title', 'Theme Configurator')
@push('css')
    <style>
        input[type="radio"]{
            display:inline-block;
            width: 20px;
            height: 20px;
            margin:-1px 4px 0 0;
            vertical-align:middle;
        }
    </style>
@endpush

@push('js')
    <script>
        $('input[type="radio"]').on('click', function () {
            var theme = $(this).val();

            // ajax save
            $.ajax({
                url: 'theme-select/'+theme,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        $('body').removeAttr('class').addClass(theme);
                    }
                }
            });
        });
    </script>
@endpush
@section('breadcrumb')

@endsection

@section('content')
    <!-- row -->

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Glass</strong>" <input type="radio" name="theme" class="theme-select style-0" value="smart-style-5"/><br>
                    <small>Add the following class to body tag <code>.smart-style-5</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-glass.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Material Design</strong>" <sup>beta</sup> <input type="radio" name="theme" class="theme-select style-0" value="smart-style-6"/><br>
                    <small>Add the following class to body tag <code>.smart-style-6</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-material.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>

    </div>

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>PixelSmash</strong>" <input type="radio" name="theme" class="theme-select style-0" value="smart-style-4"/><br>
                    <small>Add the following class to body tag <code>.smart-style-4</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-pixel.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Dark Elegance</strong>" <input type="radio" name="theme" class="theme-select style-0" value="smart-style-1"/><br>
                    <small>Add the following class to body tag <code>.smart-style-1</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-dark.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>

    </div>

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Google</strong>" <input type="radio" name="theme" class="theme-select style-3" value="smart-style-0"/><br>
                    <small>Add the following class to body tag <code>.smart-style-3</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-google.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Ultra Light</strong>" <input type="radio" name="theme" class="theme-select style-0" value="smart-style-2"/><br>
                    <small>Add the following class to body tag <code>.smart-style-2</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-ultralight.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>

    </div>
    <!-- end row -->

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-6">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Default</strong>" <input type="radio" name="theme" class="theme-select style-0" value="smart-style-0"/><br>
                    <small>Add the following class to body tag <code>.smart-style-0</code></small>
                </h5>
                <img src="{{ URL::asset('img/demo/layout-skins/skin-default.png') }}" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;">
            </div>
        </div>
        <div class="col-sm-6">
            <!-- your contents here -->

        </div>

    </div>
    <!-- end row -->
@endsection