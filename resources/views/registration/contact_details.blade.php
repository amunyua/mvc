<br>
<h3><strong>Step 2 </strong> - Contact Details</h3>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile-phone fa-fw"></i></span>
                <input class="form-control" placeholder="Mobile Number" autocomplete="off" type="number" name="phone_number" id="phone_number" value="{{ old('phone_no') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                <input class="form-control" placeholder="City/Town" autocomplete="off" type="text" name="city" id="city" value="{{ old('city') }}">
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                <input class="form-control" placeholder="Postal Address" autocomplete="off" type="text" name="postal_address" id="postal_address" value="{{ old('postal_address') }}">
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-keyboard-o fa-fw"></i></span>
                <input class="form-control" type="name" name="physical_address" autocomplete="off" placeholder="Physical Address">
            </div>
        </div>
    </div>
</div>