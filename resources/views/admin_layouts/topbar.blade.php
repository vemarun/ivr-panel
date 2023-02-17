<div class="logo-container">
    <a href="../" class="logo">
        <img src="../assets/images/logo.png" height="50" alt="Arun" />
    </a>
    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<!-- start: search & user box -->
<div class="header-right">

    {{-- <form action="pages-search-results.html" class="search nav-form">
        <div class="input-group input-search">
            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form> --}}

    <span class="separator"></span>

    <ul class="notifications">
        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                {{-- <span class="badge">3</span> --}}
            </a>

            <div class="dropdown-menu notification-menu large">
                <div class="notification-title">
                    <span class="pull-right label label-default">3</span>
                    UserID
                </div>


            </div>
        </li>

        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge">1</span>
            </a>

            <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                    <span class="pull-right label label-default">1</span>
                    Alerts
                </div>

                <div class="content">
                    <ul>
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fa fa-signal bg-success"></i>
                                </div>
                                <span class="title">Test</span>
                                <span class="message">26/01/2019</span>
                            </a>
                        </li>
                    </ul>

                    <hr />

                    <div class="text-right">
                        <a href="#" class="view-more">View All</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                <span class="name">{{Auth::user()->username}}</span>
                <span class="role">Admin</span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
                <li>
                    <a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
                </li>
                {{-- <li>
                    <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                </li> --}}
                <li>
                    <a role="menuitem" tabindex="-1" href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end: search & user box -->
