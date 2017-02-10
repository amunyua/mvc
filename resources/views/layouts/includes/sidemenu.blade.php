<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="{{ URL::asset('img/avatars/sunny.png') }}" alt="me" class="online" />
                <span>
                    <?php
//                    $user = \App\User::auth();
                    $user = \Illuminate\Support\Facades\Auth::user();
                    ?>
                    {{ $user->name }}
                </span>
                <i class="fa fa-angle-down"></i>
            </a>
        </span>
    </div>
    <!-- end user info -->

    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->

        <?php
            $smenu = new \App\Http\Controllers\MenuController;
            $smenu->loadSideMenu(NULL);
        ?>
        {{--<ul>--}}
            {{--<li>--}}
                {{--<a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>--}}
                {{--<ul>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/dashboard') }}" title="Dashboard"><span class="menu-item-parent">Analytics Dashboard</span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="top-menu-invisible">--}}
                {{--<a href="#"><i class="fa fa-lg fa-fw fa-cube txt-color-blue"></i> <span class="menu-item-parent">Registration</span></a>--}}
                {{--<ul>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('add-masterfile') }}" title="Add Masterfile"><i class="fa fa-lg fa-fw fa-plus"></i> <span class="menu-item-parent">Add Masterfile</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('all-masterfiles') }}" title="All Masterfiles"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">All Masterfiles</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('all-students') }}" title="All Masterfiles"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Students</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('all-teachers') }}" title="All Masterfiles"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Teachers</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('all-guardians') }}" title="All Masterfiles"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Guardians</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('all-ss') }}" title="All Masterfiles"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Subordinate Staff</span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#" title="Form Class"><i class="fa fa-lg fa-fw fa-list txt-color-blue"></i> <span class="menu-item-parent">Class</span></a>--}}
                {{--<ul>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('class') }}" title="Manage Forms"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Manage Class</span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="top-menu-invisible">--}}
                {{--<a href="#"><i class="fa fa-lg fa-fw fa-book txt-color-blue"></i> <span class="menu-item-parent">Academics</span></a>--}}
                {{--<ul>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('subject') }}" title="subjects"><i class="fa fa-lg fa-fw fa-pencil"></i> <span class="menu-item-parent">subjects</span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="top-menu-invisible">--}}
                {{--<a href="#"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">System</span></a>--}}
                {{--<ul>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('routes') }}" title="Routes"><i class="fa fa-lg fa-fw fa-pencil"></i> <span class="menu-item-parent">Routes</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="">--}}
                        {{--<a href="{{ url('menu') }}" title="Routes"><i class="fa fa-lg fa-fw fa-list-ul"></i> <span class="menu-item-parent">Menu</span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </nav>


    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

@push('js')
    {{--<script>--}}
        {{--$.ajax({--}}
            {{--url: 'get-theme',--}}
            {{--type: 'GET',--}}
            {{--dataType: 'json',--}}
            {{--success: function (data) {--}}
                {{--$('body').removeAttr('class').addClass(data.theme);--}}
                {{--$('input[value="'+data.theme+'"').attr('checked', 'checked');--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
@endpush