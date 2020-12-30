<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="https://teologia.umg.edu.gt/img/logo_origin.png">
    <title>HOTEL | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link href="css/template.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> <!-- Google Font -->
  </head>

  <body class="hold-transition skin-red sidebar-mini">
    <div id="app">
      <div class="wrapper">
        <!-- Cabecera -->
        <header class="main-header">
          <!-- Logo -->
        <a href="/" class="logo">
            <span class="logo-mini"><b>UMG</b></span>
          </a>
          <!-- Fin logo -->

          <!-- "Cabecera" barra de navegación -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">4</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 4 messages</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <li><!-- start message -->
                          <a href="#">
                            <div class="pull-left">
                              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              Support Team
                              <small><i class="fa fa-clock-o"></i> 5 mins</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                        <!-- end message -->
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              AdminLTE Design Team
                              <small><i class="fa fa-clock-o"></i> 2 hours</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              Developers
                              <small><i class="fa fa-clock-o"></i> Today</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              Sales Department
                              <small><i class="fa fa-clock-o"></i> Yesterday</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              Reviewers
                              <small><i class="fa fa-clock-o"></i> 2 days</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="footer"><a href="#">See All Messages</a></li>
                  </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">10</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 10 notifications</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <li>
                          <a href="#">
                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                            page and may cause design problems
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="fa fa-users text-red"></i> 5 new members joined
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="fa fa-user text-red"></i> You changed your username
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                  </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger">9</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 9 tasks</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <li><!-- Task item -->
                          <a href="#">
                            <h3>
                              Design some buttons
                              <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                              </div>
                            </div>
                          </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                          <a href="#">
                            <h3>
                              Create a nice theme
                              <small class="pull-right">40%</small>
                            </h3>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">40% Complete</span>
                              </div>
                            </div>
                          </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                          <a href="#">
                            <h3>
                              Some task I need to do
                              <small class="pull-right">60%</small>
                            </h3>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                          <a href="#">
                            <h3>
                              Make beautiful transitions
                              <small class="pull-right">80%</small>
                            </h3>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">80% Complete</span>
                              </div>
                            </div>
                          </a>
                        </li>
                        <!-- end task item -->
                      </ul>
                    </li>
                    <li class="footer">
                      <a href="#">View all tasks</a>
                    </li>
                  </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="img/Hotel.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{Auth::user()->name}} </span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="img/Hotel.jpg" class="img-circle" alt="User Image">
                        <p>
                            <span class="d-md-down-none">{{Auth::user()->name}} </span>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        @if(Auth::user()->id_rol == 1)
                          <div class="pull-left">
                            <a href="#" class="btn btn-block btn-info">Perfil</a>
                          </div>
                        @elseif(Auth::user()->id_rol == 2)
                          <div class="pull-left">
                            <a href="#" class="btn btn-block btn-info">Perfil</a>
                          </div>
                        @endif
                              
                        <div class="pull-right">
                          <a href="#" class="btn btn-block btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
  
                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">@csrf</form>
                        </div>
                      </li>
                    </ul>
                  </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- Fin "Cabecera" barra de navegación -->
        </header>
        <!-- Fin cabecera -->

        @if(Auth::check())
          @if(Auth::user()->id_rol == 1)
            @include('Template.SidebarAdministrador')
          @elseif(Auth::user()->id_rol == 2)
            @include('Template.Sidebar')
          @elseif(Auth::user()->id_rol == 3)
            @include('Template.SidebarGuest')
          @endif
        @endif
        <!-- "Columna derecha" Barra de navegación -->
        <!-- Fin "Columna derecha" Barra de navegación -->

        <!-- Contenido de la página -->
        <div class="content-wrapper" style="min-height: 916.3px;">
          <!-- Contenido principal -->
          @yield('content')
          <!-- Fin contenido principal -->
        </div>
        <!-- Fin contenido de la página -->

        <!-- Footer -->
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <div class="small text-center text-muted">Derechos Reservados &copy; 2019 - HOTEL ROYAL</div>
        </footer>
        <!-- Fin footer -->

        <!-- Barra lateral para control de colores -->
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">
          <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
          </div>
        </aside>
        <!-- Fin barra lateral para control de colores -->
      </div>
    </div>
    <script src="js/app.js"></script>
    <script src="js/template.js"></script>
  </body>
</html>
