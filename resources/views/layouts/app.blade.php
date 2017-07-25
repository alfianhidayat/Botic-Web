<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@php
    use Illuminate\Support\Facades\Auth;
    $id_role = Auth::user()->id_role;
    if($id_role!=null){
        if($id_role==2||$id_role==3){
@endphp


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="icon" href="{!! asset('image/bjnapp-logo.png') !!}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/sb-admin-2.css')}}">

    {{--SWEETALERT--}}
    <script src="{{asset('bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bower_components/sweetalert2/dist/sweetalert2.min.css')}}">

    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    {{--END SWEETALERT--}}

<!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


    <!-- DataTables CSS -->
    <link href="{{asset('vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">
    {{--<script src="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}"></script>--}}

    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-gmaps-latlon-picker.css')}}"/>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user()->id_role==3)

                    <li>
                        <a href="/superadmin">
                            Data Admin
                        </a>
                    </li>
                    @endif

                        @if(Auth::user()->id_role==2)
                            <li>
                                <a href="/admin">
                                    Data User
                                </a>
                            </li>
                        @endif
                    <li>
                        <a href="http://wisatabojonegoro.com/">
                            Web Wisata
                        </a>
                    </li>
                    <li>
                        {{--                        <a href="{{ URL::to('http://www.dinbudpar.bojonegorokab.go.id') }}">--}}
                        <a href="http://dinbudpar.bojonegorokab.go.id/">
                            Web Dinas
                        </a>
                    </li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        {{--                        <li><a href="{{ route('login') }}">Login</a></li>--}}
                        {{--                        <li><a href="{{ route('register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{URL::to('editProfile')}}">Edit Profile</a>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>


                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{URL::to('home')}}"><i class="fa fa-dashboard fa-fw"></i> Menu Utama</a>
                    </li>
                    {{--                    {{dd($menus)}}--}}


                    @for($i=0;$i<count($menus);$i++)
                        {{--$menus[$i]['original_filename']--}}
                        {{--@if($i>11)--}}
                        <li>
                            <a href="{{URL::to('showMenu/'.$menus[$i]['id'])}}"><i
                                        class="fa fa-{{$menus[$i]['icon']}} fa-fw"></i> {{$menus[$i]['menu']}}</a>
                        </li>
                        {{--@endif--}}
                    @endfor

                    <li>
                        <a href="{{URL::to('help')}}"><i class="fa fa-info-circle fa-fw"></i> Bantuan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <div class="panel-footer text-center">
        &copy; Dinas Kebudayaan & Pariwisata Bojonegoro | 2017
    </div>
</div>
<!-- jQuery -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
@include('sweet::alert')
<script src="{{asset('js/sb-admin-2.js')}}"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- DataTables JavaScript -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}

<!-- Custom Theme JavaScript -->

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
@yield('script')
{{--@section('script')--}}
{{--<script>--}}
    {{--$(document).ready(function () {--}}

        {{--var t = $('#dataTables-example').DataTable({--}}
            {{--"columnDefs": [{--}}
                {{--"searchable": false,--}}
                {{--"orderable": false,--}}
                {{--"pagingType": "full_numbers",--}}
                {{--"targets": 0--}}
            {{--}],--}}
            {{--"order": [[1, 'asc']],--}}
            {{--responsive: true--}}
        {{--});--}}

        {{--t.on('order.dt search.dt', function () {--}}
            {{--t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {--}}
                {{--cell.innerHTML = i + 1;--}}
            {{--});--}}
        {{--}).draw();--}}

        {{--$(".gllpLatlonPicker").each(function () {--}}
            {{--$obj = $(document).gMapsLatLonPicker();--}}

            {{--$obj.params.strings.markerText = "Drag this Marker (example edit)";--}}

            {{--$obj.params.displayError = function (message) {--}}
                {{--console.log("MAPS ERROR: " + message); // instead of alert()--}}
            {{--};--}}

            {{--$obj.init($(this));--}}
        {{--});--}}

        {{--$(document).on('change','#dateField',function () {--}}
            {{--console.log("hmm it's changed");--}}
        {{--});--}}
    {{--});--}}


{{--</script>--}}
{{--@endsection--}}
<script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkDSAlkb23u606YO23TezU84YDzYXEat8"></script>
<script>
    $.gMapsLatLonPickerNoAutoInit = 1;
</script>
<script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>

</body>
@php
    }else{
    view('auth/login');
    Auth::logout();
    }
    }else{
    view('login');
    }

@endphp
</html>
