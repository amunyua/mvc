<br>
<h3><strong>Step 3 </strong> - Other Details</h3>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list
                fa-fw"></i></span>
                <select name="form" class="form-control">
                    <option value="">--Select Form--</option>
                    @if(count($forms))
                        @foreach($forms as $form)
                            <option value="{{ $form->id }}">{{ $form->class_name }}</option>
                        @endforeach
                    @endif
                </select>

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list
                fa-fw"></i></span>
                <select name="stream" id="stream" class="form-control">
                    <option value="">--Choose Stream--</option>
                    @if(count($streams))
                        @foreach($streams as $stream)
                            <option value="{{ $stream->id }}">{{ $stream->stream_name }}</option>
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
                <span class="input-group-addon"><i class="fa fa-keyboard-o
                fa-fw"></i></span>
                <input class="form-control" placeholder="KRA PIN" type="text" name="kra_pin" id="kra_pin" value="{{ old('stream') }}" disabled>

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-keyboard-o
                fa-fw"></i></span>
                <input class="form-control" placeholder="NHIF No" type="text" name="nhif_no" id="nhif_no" value="{{ old('nhif_no') }}" disabled>

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-keyboard-o
                fa-fw"></i></span>
                <input class="form-control" placeholder="NSSF No" type="text" name="nssf_no" id="nssf_no" value="{{ old('nssf_no') }}" disabled>

            </div>
        </div>
    </div>
</div>