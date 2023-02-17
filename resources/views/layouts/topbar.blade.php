<div class="logo-container">
    <a href="../" class="logo">
        <img src="assets/images/logo.png" height="50" alt="Arun" />
    </a>
    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<!-- start: search & user box -->
<div class="header-right">

    <span class="separator"></span>

    <ul class="notifications">
        <li style="max-width:250px">
                <div class="input-group div_session_source_number">
                        <input class="form-control" readonly value="DID : {{session('source_number')}}">
                        <span class="input-group-btn">
                            <button class="btn btn-default edit_session_source_number" type="button"><i class="fa fa-edit"></i></button>
                        </span>
                </div>
                <select name="session_source_number" class="form_control" style="display:none">
                    <option selected disabled>Change Session Source Number</option>
                </select>
        </li>
    </ul>

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                <img src="assets/images/!logged-user.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.png" />
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                <span class="name">{{Auth::user()->username}}</span>
                <span class="role">UserID {{Auth::user()->id}}</span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
                {{-- <li>
                    <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                </li> --}}
                <li>
                    <a role="menuitem" tabindex="-1" href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end: search & user box -->
