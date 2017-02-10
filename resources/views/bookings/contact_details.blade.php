<br>
<h3><strong>Step 2 </strong> - Reservation Details</h3>

<div class="row booking-d" >
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
            <select name="night_stops[]" class="form-control">
                <option value="">Select Stop</option>
                @if(count($night_stops))
                    @foreach($night_stops as $night_stop)
                        <option value="{{$night_stop->id}}">{{ $night_stop->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile-phone fa-fw"></i></span>
                <input class="form-control" placeholder="Mobile Number" autocomplete="off" type="date" name="days[]"  value="{{ old('date') }}">
            </div>
        </div>
    </div>


</div>
<div id="added"></div>
<div class="row" id="add-booking-div">
    <div class="col-sm-12">
            <input type="button" class="btn btn-success" value="Click to add a booking raw" id="add-book" style="width:100%">
    </div>
</div>
