<!-- *************************************************************
 *****************************************************************
 ***                                                            **
 ***        Woolworths Electronic Ink Control System            **
 ***           Copyright (C) 2021, Vector Systems               **
 ***                   All Rights Reserved                      **
 ***                                                            **
 *****************************************************************
 ************************************************************* -->
 <!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Woolworths eInk - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('vendor1/css/poppins.css')}}"> <!-- Google Poppins Font -->

    <!-- FontAwesome -->
    <!-- NOTE: Add fonts from 'https://github.com/FortAwesome/Font-Awesome/tree/master/webfonts' -->
    <link rel="stylesheet" href="{{asset('vendor1/css/fontawesome.css')}}"> <!-- 5.15.3, uses 'fas' -->

    <link rel="stylesheet" href="{{asset('vendor1/css/bootstrap.min.css')}}"> <!-- Infamous bootstrap stylesheet -->
    <link rel="stylesheet" href="{{asset('vendor1/css/style.css')}}"> <!-- Main stylesheet -->

    <link rel="icon" type="image/x-icon" href="{{asset('vendor1/images/barcode_icon.ico')}}">
    <style>
        #footer-text {
            padding-right: 0;
			margin-bottom: 0px;
        }
		
        @media screen and (max-width: 975px) {
            #footer-text{
                padding-right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><img src="{{asset('vendor1/images/logo.png')}}" alt="Home"><a class="logo"><span>Electronic Ink Control System</span></a>
                </h1>

                <!-- https://fontawesome.com/icons/ -->
                <ul class="list-unstyled components mb-5">
                    <li><a href="{{url('/home')}}"><span class="fa fa-list mr-3"></span>Overview</a></li>
                    <li><a href="{{url('/tag')}}"><span class="fas fa-tag mr-3"></span>Tags</a></li>
                    <li><a href="{{url('/schedule')}}"><span class="far fa-calendar-plus mr-3"></span>Schedule</a></li>
                    <li><a href="{{url('/notices')}}"><span class="fa fa-exclamation-triangle mr-3"></span>Notices</a></li>
                    <li><a href="{{url('/settings')}}"><span class="fa fa-cog mr-3"></span>Settings</a></li>
                    <li><a href="{{('/support')}}"><span class="fa fa-question-circle mr-3"></span>Support</a></li>
                    <li class="active"><a href="{{url('/about')}}"><span class="fa fa-user mr-3 fa-active"></span>About</a></li>
					<!--<li><a><span>&nbsp;</span></a></li>-->
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fas fa-sign-out-alt mr-3"></span>Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>

                <!--<div class="mb-5">-->
                <h3 class="h6 mb-3">System Identification</h3>
                <div class="footer">
                    <p>WEINK-ABC-123-DEF-456-HIJ</p>
                </div>
                <!--<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<div class="icon"><span class="icon-paper-plane"></span></div>
							<input type="text" class="form-control" placeholder="Enter Email Address">
						</div>
					</form>-->
                <!--</div>-->
                <br />
                <h3 class="h6 mb-3">Store Location</h3>
                <div class="footer">
                    <p>Shop M1/799 Richmond Rd, Colebee, NSW, 2761</p>
					<br />
                </div>
            </div>
        </nav>

        @yield('content')


        <div class="footer_white_bar">
            <p>&nbsp;</p>
        </div>
        <div class="footer_copyright">
            <p id="footer-text">Copyright (&copy;) Woolworths Group Limited 2021. All Rights Reserved.</p>
        </div>

        <!-- do not move these to the header -->
        <!-- if you do the sidebar won't toggle -->
        <script type="text/javascript" src="{{asset('vendor1/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('vendor1/js/popper.js')}}"></script>
        <script src="{{asset('vendor1/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendor1/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('vendor1/js/main.js')}}"></script>
</body>

</html>