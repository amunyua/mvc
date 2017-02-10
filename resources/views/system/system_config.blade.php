@extends('layouts.form')
@section('title','Manage System Configuration')
@section('page-title','Manage System')
@section('page-title-small', 'Configuration')

@section('breadcrumb')
<li >
    <i class="fa fa-home"></i>
    <a href="{{ url('/home') }}">Home</a>
    <span class="icon-angle-right"></span>
</li>
<li>
    <a href="">System</a>
    <span class="icon-angle-right"></span>
</li>
<li><span>System Config</span></li>
@endsection

@section('widget-title', 'System Configurations')
@section('form-name', 'Manage System Configurations')

@section('content')
    <form action="{{ url('/sys-config') }}" method="post" id="order-form" class="smart-form" enctype="multipart/form-data">

        {{ csrf_field() }}
        @include('common.success')
        @include('common.warnings')
        @include('common.error')

        <header>Edit/Update System Configuration's</header>
        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-bank"></i>
                        <input type="text" name="company_name" value="{{ ($sys->company_name) }}" placeholder="Company Name" required/>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" value="{{ ($sys->email) }}" placeholder="Company Email" required/>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email_two" value="{{ ($sys->email_two) }}" placeholder="Company Email Two" required/>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="number" name="tel_one" value="{{ ($sys->tel_one) }}" placeholder="Company Telephone 1" required/>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="number" name="tel_two" value="{{ ($sys->tel_two) }}" placeholder="Company Telephone 2" required/>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="number" name="tel_three" value="{{ ($sys->tel_three) }}" placeholder="Company Telephone 3" required/>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-building"></i>
                        <input type="text" name="box_office" value="{{ ($sys->box_office) }}" placeholder="Company Box Office" required>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-building"></i>
                        <input type="text" name="physical_address" value="{{ ($sys->physical_address) }}" placeholder="Company Physical Address" required>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-money"></i>
                        <input type="number" name="paybill_no" value="{{ ($sys->paybill_no) }}" placeholder="Company Pay Bill Number" required>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-key"></i>
                        <input type="number" name="service_pin" value="{{ ($sys->service_pin) }}" placeholder="Company Service Pin" required>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <div class="row-fluid" style="margin-left: 20%">
                        <div class="span6">
                            {{--<label class="control-label">Profile Pic</label>--}}
                            <div class="controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                        <img src="{{ URL::asset(empty($sys->company_logo) ? 'img/avatars/item.png' : $sys->company_logo) }}" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                                    <div>
                                        <label class="btn btn-file"><span class="fileupload-new">Company Logo</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input class="span12" type="file" name="company_logo"/>
                                        </label>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </fieldset>

        <footer style="">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url('load-config') }}" class="btn btn-default">Reset</a>
        </footer>
    </form>
@endsection
