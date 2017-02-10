<br>
<h3><strong>Step 1 </strong> - Basic Details</h3>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="client" class="form-control">
                    <option value="">Select Client</option>
                    @if(count($clients))
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{ $client->surname.' '.$client->firstname.' '.$client->middlename }}</option>
                            @endforeach
                        @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-6 person">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="booking_source" class="form-control" >
                    <option value="">Choose Booking Source</option>
                    @if(count($sources))
                        @foreach($sources as $source)
                            <option value="{{$source->id}}">{{ $source->source_name.' - '.$source->country }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="driver" class="form-control" id="client">
                    <option value="">Choose Driver</option>
                    @if(count($drivers))
                        @foreach($drivers as $driver)
                        @endforeach
                            <option value="{{$driver->id}}">{{ $driver->surname.' '.$driver->firstname.' '.$driver->middlename }}</option>
                    @endif
                </select>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="control-label col-sm-2">Start Date</div>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <input type="date" name="start_date" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-sm-6 person">
            <div class="form-group">
                <div class="control-label col-sm-2">End Date</div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                    <input type="date" name="end_date" class="form-control" placeholder="end date">
                </div>
            </div>
        </div>
</div>



