<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$settings->companyname}}</title>

     
        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>

        <link rel="icon" href="/images/icon.png" type="image/png"/>
        <link rel="shortcut icon" href="/images/icon.png" type="image/png"/>
        <!-- CSS files -->
        <link href="/dist/css/tabler.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="/dist/css/demo.min.css" rel="stylesheet"/>

        <script src="/js/jquery.min.js"></script>
        <style>
          #hideMe {
            -webkit-animation: cssAnimation 5s forwards; 
            animation: cssAnimation 5s forwards;
            position: fixed;
                    right: 0;
                    margin-top:80px;
        }
        @keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
        @-webkit-keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
         </style>


        @livewireStyles

        <!-- Scripts -->
        <script src="/js/alpine.js" defer></script>
    </head>
    <body class="antialiased">
        <div class="page">
          <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a href="/dashboard" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                <img src="/storage/uploads/{{$settings->logo}}"  style="margin-top: -5px;" alt="{{$settings->companyname}}" class="navbar-brand-image">
              </a>
              <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown d-none d-md-flex mr-3">
                  <a href="#" class="nav-link px-0" data-toggle="dropdown" tabindex="-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="badge bg-"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                    <div class="card">
                      <div class="card-body">
                       No Notifications
                      </div>
                    </div>
                  </div>
                </div>
                <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                    <span class="avatar avatar-rounded" style="background-image: url({{ Auth::user()->profile_photo_url }}); margin:0px 10px 0px 10px;"></span>
                    
                    <div class="d-none d-xl-block pl-2">
                      <div>{{ Auth::user()->name }}</div>
                      <div class="mt-1 small text-muted">{{ Auth::user()->email }} </div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                   
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                      Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M7 12h14l-3 -3m0 6l3 -3" /></svg>
                                            {{ __('Logout') }}
                                        </a>
                
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                  </div>
                </div>
              </div>
              <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                  <ul class="navbar-nav">
                    
                    <li class="nav-item  @if(Request::is('clients')){{ 'active' }}@endif dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        <span class="nav-link-title">
                          Clients
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="/clients" >
                           Client Manager
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="/client/add" >
                           Add New Client
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>

                    
                    <li class="nav-item  @if(Request::is('invoices')){{ 'active' }}@endif">
                      <a class="nav-link" href="/invoices" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                        </span>
                        <span class="nav-link-title">
                          Invoices
                        </span>
                      </a>
                    </li>

                    <li class="nav-item  @if(Request::is('quotes')){{ 'active' }}@endif">
                      <a class="nav-link" href="/quotes" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="16" width="3" height="5" rx="1" /><path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z" /><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3" /></svg>
                        </span>
                        <span class="nav-link-title">
                          Quotation
                        </span>
                      </a>
                    </li>

                    <li class="nav-item  @if(Request::is('projects')){{ 'active' }}@endif">
                      <a class="nav-link" href="/projects" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="6" rx="1" /><rect x="4" y="14" width="6" height="6" rx="1" /><rect x="14" y="14" width="6" height="6" rx="1" /><line x1="14" y1="7" x2="20" y2="7" /><line x1="17" y1="4" x2="17" y2="10" /></svg>
                        </span>
                        <span class="nav-link-title">
                          Projects
                        </span>
                      </a>
                    </li>
                  
                    @if(Auth::user()->usertype==1)
                    <li class="nav-item  @if(Request::is('lead')){{ 'active' }}@endif dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                        </span>
                        <span class="nav-link-title">
                         Admin Panel
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="{{route('listofadmins')}}" >
                           Admin Manager
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{route('adminsettings')}}" >
                          Settings
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>
                    @endif

                  </ul>
                  <div class="ml-md-auto pl-md-4 py-2 py-md-0 mr-md-4 order-first order-md-last flex-grow-1 flex-md-grow-0">
                   
                  </div>
                </div>
              </div>
            </div>
          </header>


    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
          
          
          <div class="content">
            <div class="container-xl d-flex flex-column justify-content-center">
            <!-- Page Content -->
            <main>
              @yield('content')
            </main>
          </div>
          </div>
        </div>
        @stack('modals')

        @livewireScripts
        @if (\Session::has('success'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-green">Success</span>
                       {!! \Session::get('success') !!}
                  
            </div>
          </div>
          @endif 
          
          @if (\Session::has('warning'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-yellow">Warning</span>
                       {!! \Session::get('warning') !!}
                  
            </div>
          </div>
          @endif 

          @if (\Session::has('danger'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-red">Error</span>
                       {!! \Session::get('danger') !!}
                  
            </div>
          </div>
          @endif 

        

        </div>

        <footer class="footer footer-transparent">
            <div class="container">
              <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ml-lg-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                   <a href="https://docs.coderprokit.com/" target="_blank" class="link-secondary">Documentation</a> 
                 
                    
                  </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                  Copyright © {{ date('Y') }}
                  <a href="." class="link-secondary">{{$settings->companyname}}</a>. 
                  All rights reserved.
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
  
      <!-- Libs JS -->
      <script src="/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="/dist/libs/jquery/dist/jquery.slim.min.js"></script>
      <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="/dist/libs/jqvmap/dist/jquery.vmap.min.js"></script>
      <script src="/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="/dist/libs/peity/jquery.peity.min.js"></script>
      <!-- Tabler Core -->
      <script src="/dist/js/tabler.min.js"></script>
  
     
      <script>
        document.body.style.display = "block"
      </script>
          <script src="/dist/libs/selectize/dist/js/standalone/selectize.min.js"></script>
          <script src="/dist/libs/flatpickr/dist/flatpickr.min.js"></script>
          <script src="/dist/libs/flatpickr/dist/plugins/rangePlugin.js"></script>
          <script src="/dist/libs/nouislider/distribute/nouislider.min.js"></script>
  
    </body>
</html>
