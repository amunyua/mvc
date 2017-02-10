<br>
<h3><strong>Step 1 </strong> - Basic Information</h3>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="role" class="form-control" id="role">
                    <option value="">Choose Role</option>
                    <option value="Client">Client</option>
                    <option value="Dependant">Dependant</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-6 person">
        <div class="form-group" style="display: none" id="dependant">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="depends_on" class="form-control">
                    <option value="">Choose client</option>
                    @if (count($dependants))
                        @foreach($dependants as $dependant)
                            <option value="{{ $dependant->id }}">{{ $dependant->surname.' '.$dependant->firstname.' '.$dependant->middlename }}</option>
                            @endforeach
                        @endif
                </select>
            </div>
        </div>

    </div>
</div>

<div class="row person">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <input class="form-control" placeholder="Surname" type="text" autocomplete="off" name="surname" id="lname" value="{{ old('surname') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <input class="form-control" placeholder="First Name" type="text" autocomplete="off" name="firstname" id="fname" value="{{ old('firstname') }}">
            </div>
        </div>
    </div>

</div>

<div class="row person">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <input class="form-control" placeholder="Middle Name" type="text" autocomplete="off" name="middlename" id="mname" value="{{ old('middlename') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Choose Gender</option>
                    <option value="Male" {{ (old('gender') == 'Male') ? 'selected': '' }}>Male</option>
                    <option value="Female" {{ (old('gender') == 'Female') ? 'selected': '' }}>Female</option>
                </select>
            </div>
        </div>
    </div>

</div>
<div class="row" >
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                <input class="form-control" placeholder="Email" type="text" autocomplete="off" name="email" id="email" value="{{ old('email') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <input class="form-control" placeholder="ID/Passport Number" autocomplete="off" type="number" name="id_no" id="adm_no" value="{{ old('id_no') }}">
            </div>
        </div>
    </div>
</div>
<div class="row" >

    <div class="col-sm-6">
        <div class="form-group" id="b_role" style="display: none">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="business_role" class="form-control" id="role">
                    <option value="">Choose Business Role</option>
                    <option value="driver">Driver</option>
                </select>
            </div>
        </div>
    </div>

</div>

