<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'KCI') }} | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('public/template/images/logo-icon.png') }}">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="{{ asset('public/template') }}/kci/style.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @yield('css')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                   <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{-- <i class="nav-icon fas fa-lock"></i> --}}
                            ចាកចេញ
                        </a>
                   </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    @if(\Notify::getData()->get()->count() > 0)
                        @include('layouts.notify')
                    @endif
                    @if (\Notify::getOverDue()->get()->count() > 0)
                        @include('layouts.overdue')
                    @endif
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <img src="{{ asset('public/template/images/logo-icon-light.png') }}"
                        alt="Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name', 'KCI') }}</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('public/template/images/captain-avatar.png') }}" class="img-circle elevation-2" alt="User">
                        </div>
                        <div class="info">
                            <a href="{{ route("profile") }}" class="d-block">{{ auth()->user()->name }}</a>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{  route('dashboard') }}" class="nav-link @yield('dashboard')">
                                    <i class="nav-icon fas fa-dharmachakra"></i>
                                    <p class="__kh__">
                                        ទំព័រដើម
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{  route('clients.index') }}" class="nav-link @yield('client')">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p class="__kh__">
                                        អតិថិជន
                                    </p>
                                </a>
                            </li>
                            
                            <li class="nav-header">ប្រតិបត្តិការណ៍កម្ចី</li>

                            <li class="nav-item">
                                <a href="{{ route('loans.index') }}" class="nav-link @yield('loans')">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>
                                        ផ្តល់កម្ចី
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('collection.index') }}" class="nav-link @yield('loans.collection')">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>
                                        តារាងប្រមូលប្រាក់
                                    </p>
                                    @if(\Notify::getNavData()->get()->count() > 0)
                                    <span class="right badge badge-danger">
                                        {{ \Notify::getNavData()->get()->count() }}
                                    </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('collection.overdue') }}" class="nav-link @yield('loans.overdue')">
                                    <i class="nav-icon fas fa-clock"></i>
                                    <p>
                                        អតិថិជនយឺត (ប្រមូល)
                                    </p>
                                    @if (\Notify::getNavOver()->get()->count() > 0)
                                    <span class="right badge badge-danger">
                                        {{ \Notify::getNavOver()->get()->count() }}
                                    </span>
                                    @endif
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('collection.return') }}" 
                                        class="nav-link @yield('loans.collection.return')">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>
                                        សងត្រឡប់
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("history.finish") }}" 
                                        class="nav-link @yield('loans.history.finish')">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        អតិថិជនបង់ផ្តាច់
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("history.late") }}" 
                                        class="nav-link @yield('loans.history.late')">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        ប្រវត្តិអតិថិជនយឺត
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview @yield('bank.open')">
                                <a href="#" class="nav-link @yield('bank.active')">
                                    <i class="nav-icon fas fa-poll"></i>
                                    <p>
                                        ធនាគារ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('bank.index') }}" class="nav-link @yield('cash.in.bank')">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>របាយការណ៍ហិរញ្ញវត្ថុ</p>
                                        </a>
                                    </li>

                                    @php
                                        $to = \Carbon\Carbon::now()->endOfMonth()->toDateString();
                                        $from = \Carbon\Carbon::now()->startOfMonth()->toDateString();
                                    @endphp

                                    <li class="nav-item">
                                        <a href="{{ route('receive', ['from' => $from, 'to' => $to]) }}" class="nav-link @yield('cash.transection')">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>របាយការណ៍ទទួលប្រាក់</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('bank.install') }}" class="nav-link @yield('cash.in.install')">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>ដើមទុន</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>        


                            <li class="nav-header">ផ្សេងៗ</li>

                            <li class="nav-item">
                                <a href="{{  route('v2.another.index') }}" class="nav-link @yield('v2.other')">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>
                                        កម្ចីដៃគូរ
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{  route('v2.others.loan.index') }}" class="nav-link @yield('v2.other.loans')">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>
                                        កម្ចីផ្សេងៗ
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview @yield('local.open')">
                                <a href="#" class="nav-link @yield('local.active')">
                                    <i class="nav-icon fas fa-map"></i>
                                    <p>
                                        ព័ត៌មានទីតាំង
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('provinces.index') }}" class="nav-link @yield('local.province')">
                                            <i class="fas fa-map-marker-alt nav-icon"></i>
                                            <p>ខេត្ត</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('districts.index') }}" class="nav-link @yield('local.district')">
                                            <i class="fas fa-map-marker-alt nav-icon"></i>
                                            <p class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('communes.index') }}" class="nav-link @yield('local.commune')">
                                            <i class="fas fa-map-marker-alt nav-icon"></i>
                                            <p class="__kh__">ឃុំ/សង្កាត់</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('villages.index') }}" class="nav-link @yield('local.village')">
                                            <i class="fas fa-map-marker-alt nav-icon"></i>
                                            <p class="__kh__">ភូមិ</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{  route('holiday.index', [ 'quest'=> now()->format('Y') ]) }}" class="nav-link @yield('holiday')">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        ថ្ងៃឈប់សម្រាក
                                    </p>
                                </a>
                            </li>
                            
                            @can('auth.admin')
                            <li class="nav-item">
                                <a href="{{  route("auth.index") }}" class="nav-link @yield('auth')">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Authentication
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{  route("backup.index") }}" class="nav-link @yield('backup')">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Backup
                                    </p>
                                </a>
                            </li>
                            @endcan
                            {{-- <li class="nav-header">Authentication</li> --}}
                            
                            {{-- <li class="nav-item"> --}}
                               
                                <form id="logout-form" action="{{ route('logout') }}" 
                                    method="POST" style="display: none;"> @csrf
                                </form>
                            {{-- </li> --}}
                        </ul>
                    </nav>
                </div>
            </aside>

            @yield('content')
            
            <footer class="main-footer no-print">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.0.4
                </div>
                <strong>Copyright &copy; 2020 <a href="https://fb.me/khmer.code.integrity" target="_blank">kci</a>.</strong> All rights reserved.
            </footer>
        </div>
        <script src="{{ asset('public/template') }}/plugins/jquery/jquery.min.js"></script>
        <script src="{{ asset('public/template') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="{{ asset('public/template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('public/template') }}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{ asset('public/template') }}/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{{ asset('public/template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

        <script src="{{ asset('public/template') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="{{ asset('public/template') }}/plugins/toastr/toastr.min.js"></script>
        <script src="{{ asset('public/template') }}/dist/js/adminlte.min.js"></script>
        <script src="{{ asset('public/template') }}/dist/js/demo.js"></script>
        @yield('js')
        
    </body>
</html>
