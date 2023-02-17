<!-- GLOBAL MAINLY STYLES-->
<link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="assets/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
<link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
<link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet" />
<link href="assets/vendors/toastr/toastr.min.css" rel="stylesheet" />
<link href="assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<!-- PLUGINS STYLES-->
<link href="assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
<!-- THEME STYLES-->
<link href="assets/css/main.min.css" rel="stylesheet" />

<link href="assets/vendors/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="assets/vendors/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">

<link href="assets/css/style.css" rel="stylesheet">
<!--spop for notifications-->
<link href="assets/vendors/spop/spop.min.css" rel="stylesheet">
<!-- PAGE LEVEL STYLES-->

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a href="/dashboard">
                    <img src="assets/img/call.png">
                </a>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li data-toggle="tooltip" data-placement="bottom" title="Toggle side bar">
                        <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </li>
                    <li class="timeout-toggler" data-toggle="tooltip" data-placement="bottom" title="Manage Source Number">
                        <a class="nav-link toolbar-icon" href="/manage-source"><i class="fa fa-tasks" aria-hidden="true"></i></a>
                    </li>
                    {{-- <li class="dropdown dropdown-inbox" data-toggle="tooltip"  title="Dial Strategy">
                        <a class="nav-link  toolbar-icon" href="/manage-dial-strategy"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                        </a>

                    </li> --}}
                    <li class="dropdown dropdown-inbox" data-toggle="tooltip" data-placement="bottom" title="Manage Agents">
                        <a class="nav-link  toolbar-icon" href="/manage-agents"><i class="fa fa-user-secret" aria-hidden="true"></i>
                        </a>

                    </li>
                    <li class="dropdown dropdown-notification" data-toggle="tooltip" data-placement="bottom" title="Call Reports">
                        <a class="nav-link dropdown-toggle toolbar-icon" href="/in-call-report"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>

                    </li>
                    <li class="dropdown dropdown-notification" data-toggle="tooltip" data-placement="bottom" title="Phonebook">
                        <a class="nav-link dropdown-toggle toolbar-icon" href="/phonebook"><i class="fa fa-address-book" aria-hidden="true"></i></a>

                    </li>
                    <li class="dropdown dropdown-notification" data-toggle="tooltip" data-placement="bottom" title="Log out">
                        @if(Session::has('impersonate')=='true')
                        <a href="/impersonate/leave">Log out from {{Auth::user()->username}} panel</a>
                        @endif
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar"><b style="color:#DD6A39">{{Auth::user()->username}}</b> 
                    <li class="dropdown dropdown-inbox" data-toggle="tooltip" data-placement="bottom" title="ID">
                        <a class="nav-link toolbar-icon" href="#"><i class="fa fa-address-card" aria-hidden="true"  title="ID"></i>
						<span class="envelope-badge">{{Auth::user()->id}}</span>
						</a>
                    </li>

                    <li class="dropdown dropdown-inbox"  data-toggle="tooltip" data-placement="bottom" title="IVR Credit">
                            <a class="nav-link toolbar-icon" href="#"><i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="envelope-badge show_sms_credit">{{Auth::user()->ivr_credit}}</span>
                            </a>
                            
                        </li>


                    <li class="dropdown dropdown-inbox"  data-toggle="tooltip" data-placement="bottom" title="SMS Credit">
                        <a class="nav-link toolbar-icon" href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
                        <span class="envelope-badge show_sms_credit">{{Auth::user()->sms_credit}}</span>
						</a>
						
                    </li>

                    <li class="dropdown dropdown-user" data-toggle="tooltip" data-placement="bottom" title="Manage Profile">
                        <a class="nav-link dropdown-toggle link " data-toggle="dropdown">
                            <img src="assets/img/users/admin-image.png" alt="image" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu profile">
                            <div class="dropdown-arrow"></div>

                            <div class="admin-menu-features">
                                <a class="admin-features-item" href="/manageprofile" title="Manage Profile"><i class="ti-user"></i>
                                </a>
                                <a class="admin-features-item" href="#"><i class="ti-support" title="Support"></i>
                                </a>
                                <a class="admin-features-item" href="/change-password"><i class="fa fa-key" title="Change Password"></i>
                                </a>
                            </div>
                            <div class="admin-menu-content">

                                <div class="d-flex justify-content-between mt-2">
                                    <a class="d-flex align-items-center" href="/logout">Logout<i class="ti-shift-right ml-2 font-20" title="logout"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
